<?php

if (! function_exists('inr')) {
    /** Indian digit grouping: ₹12,34,567 */
    function inr($amount, bool $symbol = true, int $decimals = 0): string
    {
        $amount = (float) $amount;
        $neg = $amount < 0;
        $amount = abs($amount);
        $whole = (string) floor($amount);
        $dec = $decimals ? '.' . str_pad((string) round(($amount - floor($amount)) * (10 ** $decimals)), $decimals, '0', STR_PAD_LEFT) : '';
        $last3 = substr($whole, -3);
        $rest = substr($whole, 0, -3);
        if ($rest !== '') {
            $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            $whole = $rest . ',' . $last3;
        }
        return ($neg ? '-' : '') . ($symbol ? '₹' : '') . $whole . $dec;
    }
}

if (! function_exists('inr_short')) {
    /** ₹1.25 Cr / ₹12.4 L / ₹85,000 */
    function inr_short($amount): string
    {
        $a = (float) $amount;
        if (abs($a) >= 1e7) return '₹' . rtrim(rtrim(number_format($a / 1e7, 2), '0'), '.') . ' Cr';
        if (abs($a) >= 1e5) return '₹' . rtrim(rtrim(number_format($a / 1e5, 1), '0'), '.') . ' L';
        return inr($a);
    }
}

if (! function_exists('fy_start')) {
    /** Start of the Indian financial year (1 April). */
    function fy_start(): \Carbon\Carbon
    {
        $n = now();
        return \Carbon\Carbon::create($n->month >= 4 ? $n->year : $n->year - 1, 4, 1)->startOfDay();
    }
}

if (! function_exists('fy_label')) {
    function fy_label(): string
    {
        $s = fy_start();
        return 'FY ' . $s->format('y') . '–' . $s->copy()->addYear()->format('y');
    }
}

if (! function_exists('stage_class')) {
    function stage_class(?string $stage): string
    {
        return match ($stage) {
            'Won', 'Renewed', 'Approved', 'Settled', 'Active', 'Certified', 'Passed' => 'ok',
            'Lost', 'Declined', 'Repudiated', 'Lapsed', 'Inactive', 'Failed' => 'bad',
            'Quotation', 'Quotes in', 'Quotes received', 'Sent to client', 'Client approved', 'Under assessment', 'Surveyor appointed' => 'info',
            'Meeting', 'Data received', 'Intimated to insurer', 'In training', 'Documents pending' => 'warn',
            default => 'muted',
        };
    }
}

if (! function_exists('days_label')) {
    /** "Today", "1 day", "12 days", "Expired 3 days ago" */
    function days_label(int $d, string $suffix = ''): string
    {
        if ($d < 0) return 'Expired ' . abs($d) . (abs($d) === 1 ? ' day' : ' days') . ' ago';
        if ($d === 0) return 'Today';
        return $d . ($d === 1 ? ' day' : ' days') . $suffix;
    }
}
