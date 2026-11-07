<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Models\Setting;
use App\Services\QuoteReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function edit()
    {
        $key = QuoteReader::apiKey();
        return view('settings.edit', [
            'masked' => $key ? substr($key, 0, 10) . '…' . substr($key, -4) : null,
            'model' => QuoteReader::model(),
            'insurers' => Insurer::withCount(['policies' => fn ($q) => $q->where('status', 'Active')])->orderBy('short_name')->get(),
        ]);
    }

    public function update(Request $r)
    {
        $data = $r->validate(['anthropic_api_key' => 'nullable|string|max:300', 'anthropic_model' => 'required|string|max:80', 'clear_key' => 'nullable|boolean']);
        if ($r->boolean('clear_key')) Setting::put('anthropic_api_key', null);
        elseif (! empty($data['anthropic_api_key'])) Setting::put('anthropic_api_key', trim($data['anthropic_api_key']));
        Setting::put('anthropic_model', trim($data['anthropic_model']));
        return back()->with('ok', 'Settings saved.');
    }

    public function test()
    {
        $key = QuoteReader::apiKey();
        if (! $key) return back()->with('bad', 'No API key saved yet.');
        try {
            $res = Http::withHeaders(['x-api-key' => $key, 'anthropic-version' => '2023-06-01'])->timeout(30)
                ->post('https://api.anthropic.com/v1/messages', ['model' => QuoteReader::model(), 'max_tokens' => 10, 'messages' => [['role' => 'user', 'content' => 'Reply with OK']]]);
        } catch (\Throwable $e) {
            return back()->with('bad', 'Could not reach the AI service: ' . $e->getMessage());
        }
        return $res->successful()
            ? back()->with('ok', 'Connected. AI quote reading is ready (' . QuoteReader::model() . ').')
            : back()->with('bad', 'The AI service said: ' . ($res->json('error.message') ?? $res->status()));
    }
}
