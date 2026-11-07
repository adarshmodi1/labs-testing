<?php

namespace App\Services;

use App\Models\Insurer;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Reads an insurer's quotation PDF with Claude and returns the fields for a
 * quote option. Nothing is saved here: a person reviews the result first.
 */
class QuoteReader
{
    public const DEFAULT_MODEL = 'claude-sonnet-5-5';

    public static function apiKey(): ?string
    {
        $k = Setting::get('anthropic_api_key') ?: env('ANTHROPIC_API_KEY');
        return $k ? trim($k) : null;
    }

    public static function model(): string
    {
        return Setting::get('anthropic_model') ?: self::DEFAULT_MODEL;
    }

    public function read(string $pdfBinary, string $lineHint = ''): array
    {
        $key = self::apiKey();
        if (! $key) throw new RuntimeException('Add an Anthropic API key in Settings to use AI quote reading.');

        $insurers = Insurer::orderBy('short_name')->pluck('short_name')->implode(', ');
        $prompt = <<<TXT
You are reading an insurance quotation issued by an Indian insurer to a broker.
Extract the quote into JSON with exactly these keys:
- insurer_name: the insurer issuing the quote (one of: {$insurers}, or the name as printed)
- quote_reference: the insurer's quote number, or null
- line_of_business: e.g. Fire & Allied Perils, Group Mediclaim (GMC), Marine Cargo
- option_label: short label if the document offers a named option/plan, else null
- premium: net premium BEFORE GST in rupees, as a number (no commas, no symbol)
- gst: GST amount in rupees as a number; if only a total with 18% GST is given, work it out
- sum_insured: total sum insured in rupees as a number, or null
- deductible: the deductible/excess as printed (short text), or null
- key_covers: array of short strings, the main covers and add-ons included
- exclusions: array of short strings, notable exclusions or conditions
- valid_until: quote validity date as YYYY-MM-DD, or null
- confidence: object with "high", "medium" or "low" for each of insurer_name, premium, gst, sum_insured, deductible, valid_until
Amounts in lakh or crore must be converted to rupees (1 lakh = 100000, 1 crore = 10000000).
The broker expects this to be for: {$lineHint}.
Reply with the JSON object only.
TXT;

        $res = Http::withHeaders([
            'x-api-key' => $key,
            'anthropic-version' => '2023-06-01',
        ])->timeout(90)->post('https://api.anthropic.com/v1/messages', [
            'model' => self::model(),
            'max_tokens' => 2000,
            'messages' => [[
                'role' => 'user',
                'content' => [
                    ['type' => 'document', 'source' => ['type' => 'base64', 'media_type' => 'application/pdf', 'data' => base64_encode($pdfBinary)]],
                    ['type' => 'text', 'text' => $prompt],
                ],
            ]],
        ]);

        if (! $res->successful()) {
            $msg = $res->json('error.message') ?? $res->body();
            throw new RuntimeException('The AI service returned an error: ' . mb_strimwidth((string) $msg, 0, 240, '…'));
        }

        $text = collect($res->json('content', []))->where('type', 'text')->pluck('text')->implode("\n");
        if (! preg_match('/\{.*\}/s', $text, $m)) throw new RuntimeException('The AI reply did not contain the quote details. Try again or enter the quote by hand.');
        $data = json_decode($m[0], true);
        if (! is_array($data)) throw new RuntimeException('The AI reply could not be read. Try again or enter the quote by hand.');

        $data['insurer_id'] = $this->matchInsurer((string) ($data['insurer_name'] ?? ''));
        $data['usage'] = $res->json('usage');
        $data['model'] = self::model();
        return $data;
    }

    private function matchInsurer(string $name): ?int
    {
        if ($name === '') return null;
        $n = strtolower($name);
        foreach (Insurer::all() as $i) {
            $short = strtolower($i->short_name);
            $first = strtolower(explode(' ', $i->short_name)[0]);
            if (str_contains($n, $short) || str_contains(strtolower($i->name), $n) || (strlen($first) > 3 && str_contains($n, $first) && ! in_array($first, ['icici', 'hdfc', 'bajaj']))) return $i->id;
        }
        // disambiguate brands with general and life companies
        $map = ['lombard' => 'ICICI Lombard', 'prudential' => 'ICICI Pru Life', 'ergo' => 'HDFC ERGO', 'bajaj' => 'Bajaj General', 'reliance' => 'IndusInd General', 'digit' => 'Go Digit', 'aia' => 'Tata AIA'];
        foreach ($map as $k => $short) if (str_contains($n, $k)) return Insurer::where('short_name', $short)->value('id');
        return null;
    }
}
