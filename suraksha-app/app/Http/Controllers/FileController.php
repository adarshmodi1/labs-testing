<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\QuoteOption;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function quotePdf(QuoteOption $option)
    {
        abort_unless($option->pdf_path && Storage::disk('local')->exists($option->pdf_path), 404);
        return Storage::disk('local')->response($option->pdf_path);
    }

    public function claimFile(Claim $claim, int $i)
    {
        $f = ($claim->attachments ?? [])[$i] ?? null;
        abort_unless($f && Storage::disk('local')->exists($f['path']), 404);
        return Storage::disk('local')->response($f['path'], $f['name']);
    }
}
