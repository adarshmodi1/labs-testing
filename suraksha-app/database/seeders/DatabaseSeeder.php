<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\ClaimUpdate;
use App\Models\Client;
use App\Models\CustomerUser;
use App\Models\Insurer;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\Policy;
use App\Models\Posp;
use App\Models\QuoteOption;
use App\Models\Quotation;
use App\Models\Renewal;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

/**
 * Invented sample data for the Suraksha prototype. No real client data.
 * Dates are relative to "today" so the demo always looks current.
 */
class DatabaseSeeder extends Seeder
{
    private array $insurers = [];
    private array $rms = [];
    private Carbon $today;

    public function run(): void
    {
        mt_srand(2026);
        $this->today = now()->startOfDay();

        $this->team();
        $this->insurerMaster();
        $posps = $this->posps();
        $clients = $this->clients($posps);
        $this->policiesAndRenewals($clients, $posps);
        $this->leads($posps);
        $this->quotations();
        $this->claims();
        $this->portalLogins();

        Setting::put('anthropic_model', 'claude-sonnet-5-5');
        Setting::put('company_name', 'Suraksha Insurance Brokers Pvt Ltd');
    }

    private function r(int $min, int $max): int { return mt_rand($min, $max); }
    private function pick(array $a) { return $a[mt_rand(0, count($a) - 1)]; }
    private function round(float $v, int $to = 100): float { return round($v / $to) * $to; }

    private function team(): void
    {
        User::create(['name' => 'Suraksha Admin', 'email' => 'admin@suraksha.demo', 'password' => 'Suraksha@2026', 'role' => 'admin', 'designation' => 'System administrator', 'can_login' => true, 'phone' => '9830000001', 'joined_on' => '2024-04-01']);
        $people = [
            ['Anirban Ghosh', 'business_head', 'Business Head', 0, '2015-06-01'],
            ['Priya Mehta', 'rm', 'Senior Relationship Manager', 24000000, '2018-08-16'],
            ['Arjun Kapoor', 'rm', 'Relationship Manager', 17500000, '2020-01-06'],
            ['Sneha Das', 'rm', 'Relationship Manager – Employee Benefits', 20000000, '2019-11-11'],
            ['Rohit Bose', 'rm', 'Relationship Manager', 30000000, '2022-03-01'],
            ['Moumita Sen', 'operations', 'Operations Executive', 0, '2021-07-19'],
            ['Debashis Roy', 'claims', 'Claims Executive', 0, '2023-02-13'],
            ['Kavita Agarwal', 'finance', 'Accounts Manager', 0, '2017-05-02'],
            ['Sourav Chatterjee', 'principal_officer', 'Principal Officer', 0, '2012-10-01'],
        ];
        foreach ($people as $i => [$n, $role, $des, $target, $joined]) {
            $u = User::create([
                'name' => $n, 'email' => strtolower(str_replace(' ', '.', $n)) . '@suraksha.demo', 'role' => $role,
                'designation' => $des, 'annual_target' => $target, 'phone' => '98300' . str_pad((string) (10021 + $i * 37), 5, '0', STR_PAD_LEFT),
                'joined_on' => $joined, 'can_login' => false,
            ]);
            if ($role === 'rm') $this->rms[] = $u->id;
        }
    }

    private function insurerMaster(): void
    {
        $list = [
            ['ICICI Lombard General Insurance', 'ICICI Lombard', 'Private general', 'Partner API confirmed', '#B5121B'],
            ['HDFC ERGO General Insurance', 'HDFC ERGO', 'Private general', 'Partner API confirmed', '#004C8F'],
            ['Bajaj General Insurance', 'Bajaj General', 'Private general', 'To request', '#0067B1'],
            ['Go Digit General Insurance', 'Go Digit', 'Private general', 'Likely', '#F4B400'],
            ['IndusInd General Insurance (formerly Reliance General)', 'IndusInd General', 'Private general', 'To request', '#8B1E3F'],
            ['Shriram General Insurance', 'Shriram General', 'Private general', 'To request', '#E2631B'],
            ['The New India Assurance Co.', 'New India', 'Public sector general', 'Email / portal', '#1F4E79'],
            ['National Insurance Co.', 'National Insurance', 'Public sector general', 'Email / portal', '#2E7D32'],
            ['Care Health Insurance', 'Care Health', 'Standalone health', 'To request', '#00A19A'],
            ['Niva Bupa Health Insurance', 'Niva Bupa', 'Standalone health', 'To request', '#3D2C8D'],
            ['Tata AIA Life Insurance', 'Tata AIA', 'Life', 'To request', '#1C2E6B'],
            ['ICICI Prudential Life Insurance', 'ICICI Pru Life', 'Life', 'Partner API confirmed', '#A6192E'],
        ];
        foreach ($list as [$n, $s, $c, $api, $col]) {
            $this->insurers[$s] = Insurer::create(['name' => $n, 'short_name' => $s, 'category' => $c, 'api_status' => $api, 'colour' => $col])->id;
        }
    }

    private function posps(): array
    {
        $names = [
            ['Subhankar Pal', 'Barasat'], ['Rina Mondal', 'Howrah'], ['Tapas Kundu', 'Dum Dum'], ['Ayesha Khatun', 'Park Circus'],
            ['Bikram Singh', 'Durgapur'], ['Moutushi Dey', 'Behala'], ['Sanjay Prasad', 'Asansol'], ['Pallabi Saha', 'Siliguri'],
            ['Imran Ali', 'Garden Reach'], ['Joydeep Halder', 'Sonarpur'], ['Neha Jaiswal', 'Salt Lake'], ['Arup Mitra', 'Chandannagar'],
        ];
        $statuses = ['Active', 'Active', 'Active', 'Active', 'Active', 'Active', 'Certified', 'Certified', 'In training', 'In training', 'Applied', 'Inactive'];
        $ids = [];
        foreach ($names as $i => [$n, $city]) {
            $st = $statuses[$i];
            $cert = in_array($st, ['Active', 'Certified', 'Inactive']);
            $ids[] = Posp::create([
                'code' => 'SUR-POSP-' . str_pad((string) ($i + 101), 4, '0', STR_PAD_LEFT), 'name' => $n,
                'phone' => '9' . $this->r(600000000, 899999999), 'email' => strtolower(str_replace(' ', '.', $n)) . '@gmail.com',
                'pan' => strtoupper(chr(65 + $i)) . 'BCPK' . $this->r(1000, 9999) . chr(70 + $i % 10), 'city' => $city,
                'qualification' => $this->pick(['Class 12', 'B.Com', 'BA', 'B.Sc', 'Class 12']),
                'training_hours' => $st === 'Applied' ? 0 : ($st === 'In training' ? $this->r(4, 12) : 15),
                'exam_status' => $cert ? 'Passed' : 'Not taken',
                'certificate_no' => $cert ? 'IRDAI/POSP/GI/' . $this->r(100000, 999999) : null,
                'certified_on' => $cert ? $this->today->copy()->subDays($this->r(60, 700)) : null,
                'status' => $st, 'bank_name' => $this->pick(['SBI', 'HDFC Bank', 'Axis Bank', 'Bank of Baroda', 'ICICI Bank']),
                'account_last4' => (string) $this->r(1000, 9999), 'rm_id' => $this->pick($this->rms),
            ])->id;
        }
        return $ids;
    }

    private function clients(array $posps): array
    {
        $corp = [
            ['Eastern Castings Pvt Ltd', 'Foundry & castings', 'Howrah', 'West Bengal', 'Large corporate', 'Rakesh Jalan', 'Director – Finance'],
            ['Kalinga Metals Ltd', 'Steel', 'Bhubaneswar', 'Odisha', 'Large corporate', 'Sitaram Mohanty', 'CFO'],
            ['Delta Agro Exports', 'Tea export', 'Siliguri', 'West Bengal', 'SME', 'Ankit Goenka', 'Partner'],
            ['Hillcrest Infra Projects Ltd', 'Construction', 'Kolkata', 'West Bengal', 'Large corporate', 'Sudip Basu', 'VP – Projects'],
            ['Northline Pharma Pvt Ltd', 'Pharmaceuticals', 'Kalyani', 'West Bengal', 'Large corporate', 'Dr. Meera Iyer', 'Head – Admin'],
            ['Gangasagar Logistics', 'Transport & logistics', 'Haldia', 'West Bengal', 'SME', 'Manoj Yadav', 'Proprietor'],
            ['Sundarban Seafoods Pvt Ltd', 'Seafood processing & export', 'Kolkata', 'West Bengal', 'SME', 'Partha Sarkar', 'Managing Director'],
            ['Dooars Valley Tea Estates Ltd', 'Tea plantation', 'Jalpaiguri', 'West Bengal', 'Large corporate', 'Vikram Kanoria', 'Executive Director'],
            ['Bengal Jute & Fibres Ltd', 'Jute mill', 'Hooghly', 'West Bengal', 'Large corporate', 'Arindam Mukherjee', 'GM – Commercial'],
            ['Hooghly Polymers Pvt Ltd', 'Plastics & packaging', 'Uluberia', 'West Bengal', 'SME', 'Sanjay Bagaria', 'Director'],
            ['Rajarhat Medicare Hospital', 'Hospital', 'Kolkata', 'West Bengal', 'Large corporate', 'Dr. Anindya Roy', 'CEO'],
            ['Jamshedpur Auto Components Ltd', 'Auto components', 'Jamshedpur', 'Jharkhand', 'Large corporate', 'Harpreet Sandhu', 'Plant Head'],
            ['Durgapur Alloys Pvt Ltd', 'Ferro alloys', 'Durgapur', 'West Bengal', 'SME', 'Nilesh Agarwal', 'Director'],
            ['Asansol Coke & Chemicals', 'Coke & chemicals', 'Asansol', 'West Bengal', 'SME', 'Bijoy Chakraborty', 'Partner'],
            ['Kharagpur Rice Mills', 'Food processing', 'Kharagpur', 'West Bengal', 'SME', 'Gopal Das', 'Proprietor'],
            ['Brahmaputra Plywood Industries', 'Wood products', 'Guwahati', 'Assam', 'SME', 'Ranjit Baruah', 'Managing Partner'],
            ['Ranchi Mining Services Ltd', 'Mining services', 'Ranchi', 'Jharkhand', 'Large corporate', 'Ajay Munda', 'COO'],
            ['Bantala Leather Exports', 'Leather goods export', 'Kolkata', 'West Bengal', 'SME', 'Mohd. Arif', 'Director'],
            ['Howrah Engineering Works', 'Fabrication', 'Howrah', 'West Bengal', 'SME', 'Tarun Pal', 'Proprietor'],
            ['Park Street Hospitality Pvt Ltd', 'Hotels & restaurants', 'Kolkata', 'West Bengal', 'SME', 'Ritika Khaitan', 'Director'],
            ['Burrabazar Textiles', 'Textile trading', 'Kolkata', 'West Bengal', 'SME', 'Pawan Saraogi', 'Partner'],
            ['Malda Mango Exporters', 'Fruit export', 'Malda', 'West Bengal', 'SME', 'Abdul Hakim', 'Partner'],
            ['Patna Cold Chain Pvt Ltd', 'Cold storage', 'Patna', 'Bihar', 'SME', 'Rajeev Sinha', 'Director'],
            ['Paradip Port Handling Ltd', 'Port services', 'Paradip', 'Odisha', 'Large corporate', 'Sanjib Panda', 'Head – Risk'],
            ['Salt Lake Software Services', 'IT services', 'Kolkata', 'West Bengal', 'SME', 'Kaushik Dutta', 'HR Head'],
            ['Shyam Steel Rolling Mills', 'Steel rolling', 'Durgapur', 'West Bengal', 'SME', 'Shyam Sundar Agarwal', 'Managing Director'],
            ['Konark Cement Ltd', 'Cement', 'Cuttack', 'Odisha', 'Large corporate', 'Bibhuti Nayak', 'CFO'],
            ['Teesta Hydro Constructions', 'Hydro power construction', 'Siliguri', 'West Bengal', 'Large corporate', 'Tenzing Bhutia', 'Project Director'],
            ['Chandni Electricals', 'Electrical trading', 'Kolkata', 'West Bengal', 'SME', 'Rahul Shaw', 'Proprietor'],
            ['Bhagirathi Solvent Extractions', 'Edible oil', 'Kolkata', 'West Bengal', 'SME', 'Prakash Bajoria', 'Director'],
            ['Eastern Diagnostics Network', 'Diagnostics chain', 'Kolkata', 'West Bengal', 'SME', 'Dr. Sharmila Ghosh', 'Founder'],
            ['Haldia Petrochem Traders', 'Petrochemical trading', 'Haldia', 'West Bengal', 'SME', 'Ashok Tiwari', 'Partner'],
            ['Vidyasagar Educational Trust', 'Education', 'Midnapore', 'West Bengal', 'SME', 'Prof. Amitava Ghosh', 'Secretary'],
            ['Kolkata Bus & Coach Builders', 'Vehicle body building', 'Kolkata', 'West Bengal', 'SME', 'Gurpreet Singh', 'Director'],
            ['Sonar Bangla Sweets Pvt Ltd', 'Food & retail', 'Kolkata', 'West Bengal', 'SME', 'Debjani Ganguly', 'Director'],
            ['Darjeeling Highland Resorts', 'Hospitality', 'Darjeeling', 'West Bengal', 'SME', 'Pema Lama', 'Owner'],
            ['Odisha Aluminium Extrusions', 'Aluminium', 'Angul', 'Odisha', 'SME', 'Rashmi Patnaik', 'Director'],
            ['Bihar Agro Warehousing', 'Warehousing', 'Muzaffarpur', 'Bihar', 'SME', 'Sunil Mishra', 'Proprietor'],
            ['Eastern Packaging Solutions', 'Corrugated packaging', 'Dankuni', 'West Bengal', 'SME', 'Vivek Kedia', 'Director'],
            ['Assam Valley Tea Co.', 'Tea plantation', 'Dibrugarh', 'Assam', 'Large corporate', 'Hemanta Gogoi', 'Estate Manager'],
            ['Calcutta Freight Forwarders', 'Freight forwarding', 'Kolkata', 'West Bengal', 'SME', 'Rajat Sen', 'Managing Partner'],
            ['Shantiniketan Handicrafts Co-op', 'Handicrafts export', 'Bolpur', 'West Bengal', 'SME', 'Mitali Bose', 'Secretary'],
        ];
        $hni = [
            ['Rajesh Jhunjhunwala', 'Kolkata'], ['Sunita Bagri', 'Kolkata'], ['Anupam Banerjee', 'Salt Lake'], ['Dr. Kaushik Basu', 'Kolkata'],
            ['Meenakshi Lodha', 'Kolkata'], ['Vivek Somani', 'Howrah'], ['Sharmistha Roy', 'New Town'], ['Ravi Shankar Gupta', 'Siliguri'],
            ['Farhan Qureshi', 'Kolkata'], ['Ishita Chatterjee', 'Behala'], ['Prosenjit Dutta', 'Dum Dum'], ['Nandini Agarwal', 'Ballygunge'],
            ['Subrata Mukherjee', 'Barasat'], ['Kiran Kejriwal', 'Alipore'], ['Tanmoy Bhattacharya', 'Durgapur'], ['Lata Jain', 'Kolkata'],
        ];
        $ids = [];
        foreach ($corp as $i => [$n, $ind, $city, $state, $seg, $cp, $des]) {
            $domain = strtolower(preg_replace('/[^a-z]/i', '', explode(' ', $n)[0] . (explode(' ', $n)[1] ?? ''))) . '.in';
            $ids[] = Client::create([
                'name' => $n, 'segment' => $seg, 'industry' => $ind, 'city' => $city, 'state' => $state,
                'gstin' => ['West Bengal' => '19', 'Odisha' => '21', 'Jharkhand' => '20', 'Bihar' => '10', 'Assam' => '18'][$state] . 'AA' . chr(65 + $i % 26) . 'CS' . $this->r(1000, 9999) . 'K1Z' . $this->r(1, 9),
                'contact_person' => $cp, 'contact_designation' => $des, 'phone' => '98' . $this->r(10000000, 99999999),
                'email' => strtolower(explode(' ', str_replace(['Dr. ', 'Prof. ', 'Mohd. '], '', $cp))[0]) . '@' . $domain,
                'rm_id' => $this->rms[$i % count($this->rms)],
                'group_name' => in_array($n, ['Dooars Valley Tea Estates Ltd', 'Assam Valley Tea Co.']) ? 'Kanoria Plantations Group' : (in_array($n, ['Durgapur Alloys Pvt Ltd', 'Shyam Steel Rolling Mills']) ? 'Shyam Agarwal Group' : null),
                'client_since' => $this->today->copy()->subYears($this->r(1, 15))->subDays($this->r(0, 300)),
            ])->id;
        }
        foreach ($hni as $i => [$n, $city]) {
            $seg = $i < 8 ? 'HNI' : 'Retail';
            $ids[] = Client::create([
                'name' => $n, 'segment' => $seg, 'industry' => null, 'city' => $city, 'state' => 'West Bengal',
                'contact_person' => $n, 'phone' => '9' . $this->r(700000000, 999999999),
                'email' => strtolower(str_replace(['Dr. ', ' '], ['', '.'], $n)) . '@gmail.com',
                'rm_id' => $this->rms[$i % count($this->rms)], 'posp_id' => $seg === 'Retail' ? $this->pick(array_slice($posps, 0, 6)) : null,
                'client_since' => $this->today->copy()->subYears($this->r(1, 8))->subDays($this->r(0, 300)),
            ])->id;
        }
        return $ids;
    }

    /** Premium range (₹), rate for sum insured, commission % and the insurers that write it. */
    private function lineSpec(string $line): array
    {
        $gen = ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General', 'New India', 'National Insurance', 'IndusInd General', 'Go Digit'];
        return match ($line) {
            'Fire & Allied Perils' => [150000, 2500000, 0.0012, 15, $gen],
            'Business Interruption' => [60000, 800000, 0.0015, 15, $gen],
            'Machinery Breakdown' => [40000, 500000, 0.0025, 15, $gen],
            'Contractors All Risk (CAR)' => [200000, 1500000, 0.002, 15, ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General', 'New India']],
            'Erection All Risk (EAR)' => [120000, 1000000, 0.0018, 15, ['ICICI Lombard', 'HDFC ERGO', 'New India', 'National Insurance']],
            'Marine Cargo' => [30000, 400000, 0.002, 15, $gen],
            'Marine Open Cover' => [100000, 1200000, 0.0008, 15, ['ICICI Lombard', 'HDFC ERGO', 'New India', 'Bajaj General']],
            'Public Liability' => [25000, 200000, 0.004, 15, $gen],
            'Product Liability' => [100000, 600000, 0.006, 17.5, ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General']],
            'Directors & Officers' => [150000, 800000, 0.008, 17.5, ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General']],
            "Workmen's Compensation" => [20000, 300000, 0.01, 15, ['ICICI Lombard', 'New India', 'National Insurance', 'Shriram General', 'Go Digit']],
            'Surety Bond' => [50000, 500000, 0.01, 12.5, ['Bajaj General', 'ICICI Lombard', 'New India']],
            'Trade Credit' => [200000, 1000000, 0.004, 12.5, ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General']],
            'Group Mediclaim (GMC)' => [300000, 4000000, 0.01, 7.5, ['Care Health', 'Niva Bupa', 'ICICI Lombard', 'HDFC ERGO', 'New India', 'Bajaj General']],
            'Group Term Life (GTL)' => [50000, 600000, 0.0012, 5, ['Tata AIA', 'ICICI Pru Life']],
            'Group Personal Accident' => [30000, 200000, 0.0006, 15, ['ICICI Lombard', 'HDFC ERGO', 'Bajaj General', 'Go Digit']],
            'Keyman Insurance' => [100000, 500000, 0.004, 15, ['Tata AIA', 'ICICI Pru Life']],
            'Term Life' => [15000, 80000, 0.0015, 15, ['Tata AIA', 'ICICI Pru Life']],
            'Motor - Commercial Fleet' => [100000, 1500000, 0.03, 15, ['ICICI Lombard', 'Shriram General', 'Go Digit', 'Bajaj General', 'IndusInd General', 'HDFC ERGO']],
            'Motor - Private Car' => [12000, 45000, 0.025, 15, ['ICICI Lombard', 'Go Digit', 'HDFC ERGO', 'Bajaj General', 'Shriram General', 'IndusInd General']],
            'Health - Family Floater' => [18000, 90000, 0.03, 15, ['Care Health', 'Niva Bupa', 'ICICI Lombard', 'HDFC ERGO']],
            default => [50000, 300000, 0.002, 15, $gen],
        };
    }

    private function linesFor(Client $c): array
    {
        if ($c->segment === 'HNI') return Arr::random(['Motor - Private Car', 'Health - Family Floater', 'Term Life', 'Fire & Allied Perils'], $this->r(2, 3));
        if ($c->segment === 'Retail') return Arr::random(['Motor - Private Car', 'Health - Family Floater', 'Term Life'], $this->r(1, 2));
        $ind = strtolower((string) $c->industry);
        $base = ['Fire & Allied Perils', 'Group Mediclaim (GMC)'];
        if (str_contains($ind, 'export') || str_contains($ind, 'trad') || str_contains($ind, 'freight') || str_contains($ind, 'tea')) $base[] = $this->pick(['Marine Cargo', 'Marine Open Cover']);
        if (str_contains($ind, 'construct') || str_contains($ind, 'hydro') || str_contains($ind, 'infra')) { $base[] = 'Contractors All Risk (CAR)'; $base[] = 'Surety Bond'; }
        if (preg_match('/steel|alloy|cement|foundry|mill|auto|metal|aluminium|coke|polymer|packag|fabric|jute|chemical|solvent/', $ind)) { $base[] = 'Machinery Breakdown'; $base[] = "Workmen's Compensation"; }
        if (preg_match('/transport|logistic|port|mining|bus/', $ind)) $base[] = 'Motor - Commercial Fleet';
        if (preg_match('/pharma|food|sweets|seafood/', $ind)) $base[] = 'Product Liability';
        if (preg_match('/hospital|hotel|hospitality|diagnost|education|resort/', $ind)) $base[] = 'Public Liability';
        if ($c->segment === 'Large corporate') { $base[] = $this->pick(['Directors & Officers', 'Business Interruption', 'Group Term Life (GTL)', 'Trade Credit']); $base[] = 'Group Personal Accident'; }
        if (str_contains($ind, 'cement') || str_contains($ind, 'steel') && $c->segment === 'Large corporate') $base[] = 'Erection All Risk (EAR)';
        if ($this->r(1, 4) === 1) $base[] = 'Keyman Insurance';
        return array_values(array_unique($base));
    }

    private function makePolicy(Client $c, string $line, Carbon $start, array $posps, string $status = 'Active', ?int $from = null, ?float $basePremium = null): Policy
    {
        [$min, $max, $rate, $comm, $ins] = $this->lineSpec($line);
        $scale = $c->segment === 'Large corporate' ? 1.0 : ($c->segment === 'SME' ? 0.45 : 1.0);
        $premium = $basePremium ?? $this->round(max($min, $this->r($min, $max) * $scale), 100);
        $ins = $this->pick($ins);
        $prefix = ['ICICI Lombard' => '4001/', 'HDFC ERGO' => '2999 ', 'Bajaj General' => 'OG-27-', 'Go Digit' => 'D', 'IndusInd General' => '1205', 'Shriram General' => '10003/', 'New India' => '5101', 'National Insurance' => '15020', 'Care Health' => '7342', 'Niva Bupa' => '31', 'Tata AIA' => 'U', 'ICICI Pru Life' => 'GP'][$ins];
        $isRetail = in_array($line, ['Motor - Private Car', 'Health - Family Floater', 'Term Life']);
        return Policy::create([
            'client_id' => $c->id, 'insurer_id' => $this->insurers[$ins], 'rm_id' => $c->rm_id,
            'posp_id' => $isRetail ? ($c->posp_id ?? ($this->r(1, 3) === 1 ? $this->pick(array_slice($posps, 0, 6)) : null)) : null,
            'line' => $line, 'policy_no' => $prefix . $this->r(10000000, 99999999) . '/' . $start->format('y'),
            'sum_insured' => $this->round($premium / $rate, 100000), 'premium' => $premium, 'gst' => round($premium * 0.18, 2),
            'commission_rate' => $comm, 'start_date' => $start, 'end_date' => $start->copy()->addYear()->subDay(), 'status' => $status,
            'risk_location' => $c->city . ', ' . $c->state, 'renewed_from_id' => $from,
        ]);
    }

    private function policiesAndRenewals(array $clientIds, array $posps): void
    {
        foreach (Client::whereIn('id', $clientIds)->get() as $c) {
            foreach ($this->linesFor($c) as $line) {
                // current policy: started between 300 days ago and 15 days ago -> expires in next ~350 days
                // bias a share to expire within the next 90 days for a busy renewal desk
                $offset = $this->r(1, 10) <= 3 ? $this->r(275, 364) : $this->r(3, 274);
                $start = $this->today->copy()->subDays($offset);
                $hadPrevious = $this->r(1, 10) <= 7;
                $prev = null;
                if ($hadPrevious) {
                    $prev = $this->makePolicy($c, $line, $start->copy()->subYear(), $posps, 'Renewed');
                }
                $p = $this->makePolicy($c, $line, $start, $posps, 'Active', $prev?->id, $prev ? $this->round((float) $prev->premium * (1 + $this->r(-12, 10) / 100)) : null);
                if ($prev) {
                    Renewal::create(['policy_id' => $prev->id, 'owner_id' => $c->rm_id, 'stage' => 'Renewed', 'renewed_premium' => $p->premium, 'notes' => 'Renewed with ' . $p->insurer->short_name . '.', 'created_at' => $start->copy()->subDays(60), 'updated_at' => $start]);
                }
            }
            // a few lost renewals in the last 6 months for a realistic retention figure
            if ($this->r(1, 9) === 1) {
                $line = $this->pick($this->linesFor($c));
                $old = $this->makePolicy($c, $line, $this->today->copy()->subDays($this->r(370, 540)), $posps, 'Lapsed');
                Renewal::create(['policy_id' => $old->id, 'owner_id' => $c->rm_id, 'stage' => 'Lost', 'lost_reason' => $this->pick(['Price – competitor quoted lower', 'Client moved to bank-led broker', 'Business closed this unit', 'Placed directly with insurer']), 'created_at' => $old->end_date->copy()->subDays(60), 'updated_at' => $old->end_date]);
            }
        }

        // open renewals for every active policy expiring within 120 days
        $notes = [
            'Not started' => [null, 'Expiring policy shared with RM.'],
            'Data requested' => ['Asked client for updated stock and sum insured values.', 'Proposal form and claim history requested on WhatsApp.', 'Employee data (GMC) requested from HR.'],
            'Data received' => ['Updated values received; RFQ to go out to 4 insurers.', 'HR shared member list – 412 lives.'],
            'Quotes in' => ['3 of 4 insurers quoted; New India awaited.', 'Quotes in – best is 8% below expiring.'],
            'Client approved' => ['Client approved; premium payment awaited.', 'Approved by CFO; cover note to be issued.'],
        ];
        foreach (Policy::where('status', 'Active')->whereBetween('end_date', [$this->today->copy()->subDays(5), $this->today->copy()->addDays(120)])->get() as $p) {
            $days = $p->daysToExpiry();
            $stageIdx = $days > 75 ? $this->r(0, 1) : ($days > 45 ? $this->r(0, 2) : ($days > 20 ? $this->r(1, 3) : $this->r(1, 4)));
            if ($this->r(1, 6) === 1) $stageIdx = max(0, $stageIdx - 2); // some lagging -> at risk
            $stage = Renewal::STAGES[$stageIdx];
            Renewal::create([
                'policy_id' => $p->id, 'owner_id' => $p->rm_id, 'stage' => $stage,
                'notes' => $this->pick($notes[$stage]), 'next_action_on' => $this->today->copy()->addDays($this->r(0, 6)),
            ]);
        }
    }

    private function leads(array $posps): void
    {
        $companies = [
            ['Orient Spun Pipes Pvt Ltd', 'Pipes manufacturing', 'Howrah', 'SME', 'Fire & Allied Perils, Machinery Breakdown', 450000],
            ['Barakar Coal Washeries', 'Mining services', 'Dhanbad', 'SME', "Workmen's Compensation, Motor - Commercial Fleet", 620000],
            ['Lakeview Diagnostics', 'Diagnostics chain', 'Kolkata', 'SME', 'Group Mediclaim (GMC), Public Liability', 380000],
            ['Mahananda Food Parks Ltd', 'Food processing', 'Siliguri', 'Large corporate', 'Fire & Allied Perils, Product Liability, Group Mediclaim (GMC)', 1850000],
            ['Ganges Riverfront Developers', 'Real estate', 'Kolkata', 'Large corporate', 'Contractors All Risk (CAR), Surety Bond', 2400000],
            ['Hindmotor Auto Parts', 'Auto components', 'Hindmotor', 'SME', 'Fire & Allied Perils, Group Mediclaim (GMC)', 520000],
            ['Bhubaneswar Smart Logistics', 'Warehousing', 'Bhubaneswar', 'SME', 'Fire & Allied Perils, Marine Cargo', 340000],
            ['Eastern Solar EPC Ltd', 'Solar EPC', 'Kolkata', 'Large corporate', 'Erection All Risk (EAR), Surety Bond, Marine Cargo', 2100000],
            ['Jorhat Tea Brokers', 'Tea trading', 'Jorhat', 'SME', 'Marine Open Cover', 260000],
            ['Raniganj Refractories', 'Refractories', 'Raniganj', 'SME', 'Fire & Allied Perils, Machinery Breakdown', 410000],
            ['Kolkata Fintech Labs', 'IT services', 'Kolkata', 'SME', 'Group Mediclaim (GMC), Directors & Officers', 720000],
            ['Sealdah Garments Exports', 'Garment export', 'Kolkata', 'SME', 'Marine Cargo, Trade Credit', 480000],
            ['Purulia Granite Works', 'Stone quarrying', 'Purulia', 'SME', "Workmen's Compensation, Machinery Breakdown", 180000],
            ['Tollygunge Film Studios', 'Media', 'Kolkata', 'SME', 'Fire & Allied Perils, Public Liability', 290000],
            ['Brahmani Steel Pvt Ltd', 'Steel', 'Rourkela', 'Large corporate', 'Fire & Allied Perils, Business Interruption, Group Mediclaim (GMC)', 3200000],
            ['New Town Co-working Spaces', 'Real estate services', 'New Town', 'SME', 'Fire & Allied Perils, Public Liability', 150000],
            ['Gaya Agro Mills', 'Flour mill', 'Gaya', 'SME', 'Fire & Allied Perils', 120000],
            ['Kalimpong Orchid Nurseries', 'Horticulture export', 'Kalimpong', 'SME', 'Marine Cargo', 90000],
            ['Digha Beach Resorts', 'Hospitality', 'Digha', 'SME', 'Fire & Allied Perils, Public Liability', 210000],
            ['Mayurbhanj Minerals', 'Mining', 'Baripada', 'Large corporate', "Workmen's Compensation, Motor - Commercial Fleet, Group Mediclaim (GMC)", 1650000],
            ['Hooghly Riverside Hospital', 'Hospital', 'Serampore', 'SME', 'Public Liability, Group Mediclaim (GMC)', 560000],
            ['Siliguri EV Motors', 'EV dealership', 'Siliguri', 'SME', 'Fire & Allied Perils, Motor - Commercial Fleet', 330000],
            ['Kharagpur Bearings Ltd', 'Engineering', 'Kharagpur', 'SME', 'Machinery Breakdown, Product Liability', 410000],
            ['Ballygunge Jewellers', 'Jewellery', 'Kolkata', 'SME', 'Fire & Allied Perils', 380000],
        ];
        $retail = [
            ['Arindam Saha', 'Barasat', 'Motor - Private Car', 18000], ['Pooja Sharma', 'Howrah', 'Health - Family Floater', 32000],
            ['Md. Salim', 'Park Circus', 'Health - Family Floater', 27000], ['Debolina Paul', 'Behala', 'Term Life', 22000],
            ['Sandeep Agarwal', 'Salt Lake', 'Motor - Private Car', 26000], ['Rupa Ghosh', 'Dum Dum', 'Health - Family Floater', 41000],
            ['Amit Prasad', 'Durgapur', 'Motor - Private Car', 15000], ['Tania Biswas', 'Sonarpur', 'Term Life', 18000],
        ];
        $stages = ['New', 'New', 'Contacted', 'Contacted', 'Contacted', 'Meeting', 'Meeting', 'Meeting', 'Quotation', 'Quotation', 'Quotation', 'Won', 'Won', 'Lost'];
        $users = User::pluck('id')->all();
        $make = function (array $attrs) use ($stages, $users) {
            $stage = $attrs['stage'] ?? $this->pick($stages);
            $lead = Lead::create($attrs + [
                'stage' => $stage, 'lost_reason' => $stage === 'Lost' ? $this->pick(['Budget – will revisit next year', 'Renewed with existing broker', 'Premium too high']) : null,
                'next_follow_up' => in_array($stage, ['Won', 'Lost']) ? null : $this->today->copy()->addDays($this->r(-4, 12)),
                'created_at' => $this->today->copy()->subDays($this->r(3, 120)),
            ]);
            $log = [
                ['Call', 'First call – shared Suraksha profile and asked for current policy schedule.'],
                ['Email', 'Received expiring policy copies and claim history for last 3 years.'],
                ['Meeting', 'Met at site; walked through plant and stores. Fire protection adequate; BI not covered today.'],
                ['WhatsApp', 'Sent document checklist for RFQ.'],
                ['Note', 'Decision maker is the CFO; renewal date drives timing.'],
            ];
            $n = ['New' => 1, 'Contacted' => 2, 'Meeting' => 3, 'Quotation' => 4, 'Won' => 5, 'Lost' => 3][$stage];
            for ($i = 0; $i < $n; $i++) {
                LeadActivity::create(['lead_id' => $lead->id, 'user_id' => $lead->rm_id ?? $this->pick($users), 'type' => $log[$i][0], 'note' => $log[$i][1], 'created_at' => $lead->created_at->copy()->addDays($i * $this->r(2, 6))]);
            }
            return $lead;
        };
        foreach ($companies as $i => [$co, $ind, $city, $seg, $lines, $exp]) {
            $make(['company' => $co, 'contact_person' => $this->pick(['Rahul', 'Sumit', 'Ananya', 'Sourav', 'Neha', 'Kunal', 'Shreya', 'Abhishek']) . ' ' . $this->pick(['Agarwal', 'Banerjee', 'Sinha', 'Mishra', 'Das', 'Jain', 'Ghosh', 'Patnaik']),
                'phone' => '98' . $this->r(10000000, 99999999), 'email' => 'info@' . strtolower(preg_replace('/[^a-z]/i', '', explode(' ', $co)[0])) . '.co.in', 'city' => $city, 'industry' => $ind, 'segment' => $seg,
                'source' => $this->pick(['Referral', 'Referral', 'Existing client', 'Website', 'Event', 'Cold call']), 'lines' => $lines, 'expected_premium' => $exp,
                'rm_id' => $this->rms[$i % count($this->rms)], 'notes' => 'Currently with ' . $this->pick(['a bank-led broker', 'direct insurer', 'a Mumbai broker', 'a local agent']) . '. Renewal due ' . $this->today->copy()->addDays($this->r(20, 200))->format('M Y') . '.']);
        }
        foreach ($retail as $i => [$n, $city, $line, $exp]) {
            $make(['company' => $n, 'contact_person' => $n, 'phone' => '9' . $this->r(700000000, 999999999), 'city' => $city, 'segment' => 'Retail', 'source' => $this->pick(['POSP', 'POSP', 'WhatsApp', 'Referral']),
                'lines' => $line, 'expected_premium' => $exp, 'rm_id' => $this->pick($this->rms), 'posp_id' => $this->pick(array_slice($posps, 0, 6))]);
        }
    }

    private function covers(string $line): array
    {
        return match (true) {
            str_contains($line, 'Fire') => [
                ['Fire, lightning, explosion', 'Riot, strike and malicious damage', 'Storm, flood, inundation (STFI)', 'Earthquake', 'Terrorism'],
                ['Earthquake excluded', 'Terrorism excluded', 'Spontaneous combustion covered'],
                ['5% of claim, min ₹25,000', '₹10,000 per claim', '5% of claim, min ₹50,000'],
            ],
            str_contains($line, 'GMC') || str_contains($line, 'Health') => [
                ['Room rent up to 1% of SI', 'Pre-existing diseases from day 1', 'Maternity ₹50,000', 'Day-care procedures', 'Ambulance ₹2,000'],
                ['No room-rent capping', 'Corporate buffer ₹10 lakh', 'Parents covered with 10% co-pay', 'OPD ₹5,000 per family'],
                ['Nil', '10% co-pay for parents', 'Nil'],
            ],
            str_contains($line, 'Marine') => [
                ['ICC (A) – all risks', 'War and SRCC', 'Inland transit to warehouse', 'Loading and unloading'],
                ['ICC (B)', 'Cover till final warehouse', 'Refrigeration breakdown'],
                ['0.5% of SI per consignment', '₹10,000 per claim', '1% of consignment value'],
            ],
            str_contains($line, 'Motor') => [
                ['Own damage', 'Third party', 'Zero depreciation', 'Engine protect', 'Roadside assistance'],
                ['Own damage', 'Third party', 'Consumables cover', 'Return to invoice'],
                ['Compulsory ₹1,000', 'Voluntary ₹2,500', 'Compulsory ₹2,000'],
            ],
            default => [
                ['Material damage', 'Third-party liability', 'Removal of debris', 'Escalation 10%'],
                ['Material damage', 'Maintenance period 12 months', 'Surrounding property'],
                ['₹1,00,000 per claim', '5% of claim, min ₹50,000', '₹25,000 per claim'],
            ],
        };
    }

    private function addOptions(Quotation $q, float $base, int $count, bool $markRecommended): void
    {
        [$coverA, $coverB, $deds] = $this->covers($q->line);
        [, , , , $ins] = $this->lineSpec($q->line);
        $ins = Arr::random($ins, min($count, count($ins)));
        $opts = [];
        foreach ((array) $ins as $i => $name) {
            $prem = $this->round($base * (1 + $this->r(-15, 12) / 100));
            $opts[] = QuoteOption::create([
                'quotation_id' => $q->id, 'insurer_id' => $this->insurers[$name], 'premium' => $prem, 'gst' => round($prem * 0.18, 2),
                'sum_insured' => $q->sum_insured, 'deductible' => $deds[$i % 3],
                'key_covers' => implode("\n", $i % 2 ? $coverB : $coverA),
                'exclusions' => implode("\n", Arr::random(['Wear and tear', 'Consequential loss', 'War and nuclear perils', 'Wilful negligence', 'Pre-existing damage'], 2)),
                'valid_until' => $this->today->copy()->addDays($this->r(10, 30)), 'source' => $i === 1 ? 'AI' : 'Manual',
            ]);
        }
        if ($markRecommended && $opts) {
            // recommend the second-cheapest when it has better covers, otherwise the cheapest
            usort($opts, fn ($a, $b) => $a->premium <=> $b->premium);
            $rec = $opts[min(1, count($opts) - 1)];
            // the recommended option carries the broader cover set, matching the recommendation note
            $rec->update(['is_recommended' => true, 'key_covers' => implode("\n", $coverA), 'deductible' => $deds[0]]);
        }
    }

    private function quotations(): void
    {
        // renewal quotations
        $renewals = Renewal::with('policy.client')->whereIn('stage', ['Quotes in', 'Client approved'])->get();
        foreach ($renewals as $r) {
            $p = $r->policy;
            $status = $r->stage === 'Client approved' ? 'Approved' : $this->pick(['Quotes received', 'Sent to client']);
            $q = Quotation::create([
                'ref' => Quotation::nextRef(), 'client_id' => $p->client_id, 'renewal_id' => $r->id, 'rm_id' => $p->rm_id,
                'prospect_name' => $p->client->name, 'line' => $p->line, 'sum_insured' => $p->sum_insured, 'current_premium' => $p->premium,
                'status' => $status, 'requirement' => 'Renewal of ' . $p->line . ' policy ' . $p->policy_no . ' expiring ' . $p->end_date->format('d M Y') . '. Same scope; check for better deductible.',
                'recommendation_note' => in_array($status, ['Sent to client', 'Approved']) ? 'Recommended option gives broader cover at a premium close to the lowest quote, and the insurer has settled this client\'s past claims quickly.' : null,
                'sent_at' => in_array($status, ['Sent to client', 'Approved']) ? $this->today->copy()->subDays($this->r(1, 6)) : null,
                'created_at' => $this->today->copy()->subDays($this->r(5, 20)),
            ]);
            $this->addOptions($q, (float) $p->premium, $this->r(3, 4), in_array($status, ['Sent to client', 'Approved']));
            if ($status === 'Approved') {
                $opt = $q->options()->where('is_recommended', true)->first() ?? $q->options()->first();
                $q->update(['approved_option_id' => $opt->id, 'approved_at' => $this->today->copy()->subDays($this->r(0, 3)), 'approved_by' => $p->client->contact_person]);
            }
        }
        // new business quotations from leads at Quotation / Won stage
        foreach (Lead::whereIn('stage', ['Quotation', 'Won'])->get() as $lead) {
            $line = $lead->linesArray()[0];
            [$min, $max, $rate] = $this->lineSpec($line);
            $base = max($min, min((float) $lead->expected_premium * 0.6, $max));
            $status = $lead->stage === 'Won' ? 'Approved' : $this->pick(['Requested', 'Quotes received', 'Quotes received']);
            $q = Quotation::create([
                'ref' => Quotation::nextRef(), 'lead_id' => $lead->id, 'rm_id' => $lead->rm_id, 'prospect_name' => $lead->company, 'line' => $line,
                'sum_insured' => $this->round($base / $rate, 100000), 'status' => $status,
                'requirement' => 'New business: ' . $line . ' for ' . $lead->company . ', ' . $lead->city . '.',
                'created_at' => $this->today->copy()->subDays($this->r(2, 25)),
            ]);
            if ($status !== 'Requested') $this->addOptions($q, $base, $this->r(2, 4), $status === 'Approved');
            if ($status === 'Approved') {
                $opt = $q->options()->where('is_recommended', true)->first();
                $q->update(['approved_option_id' => $opt->id, 'approved_at' => $this->today->copy()->subDays($this->r(1, 15)), 'approved_by' => $lead->contact_person]);
            }
        }
    }

    private function claims(): void
    {
        $descr = [
            'Fire' => 'Short-circuit fire in the finished goods store; part of stock and racking damaged.',
            'Flood / storm' => 'Water entered the ground-floor warehouse during heavy rain; packed stock wet.',
            'Burglary / theft' => 'Break-in at the site office; copper cable and two laptops stolen. FIR lodged.',
            'Machinery breakdown' => 'Main motor of the rolling mill burnt out; production stopped for 3 days.',
            'Transit damage' => 'Consignment received with crushed cartons; 40 cartons damaged in transit.',
            'Accident' => 'Truck WB-23 collided on NH-16 near Kolaghat; front cabin damaged.',
            'Hospitalisation' => 'Employee admitted for appendicitis surgery; cashless requested.',
            'Third-party injury' => 'Visitor slipped in the lobby and fractured a wrist.',
        ];
        $lineFor = ['Fire' => 'Fire', 'Flood / storm' => 'Fire', 'Burglary / theft' => 'Fire', 'Machinery breakdown' => 'Machinery', 'Transit damage' => 'Marine', 'Accident' => 'Motor', 'Hospitalisation' => 'GMC', 'Third-party injury' => 'Liability'];
        $flow = ['Requested', 'Intimated to insurer', 'Surveyor appointed', 'Documents pending', 'Under assessment', 'Settled'];
        $updateNotes = [
            'Requested' => 'Claim request received from client with photos.',
            'Intimated to insurer' => 'Intimated to insurer; claim number received.',
            'Surveyor appointed' => 'Surveyor appointed; site visit scheduled.',
            'Documents pending' => 'Surveyor asked for stock register, invoices and repair estimate.',
            'Under assessment' => 'All documents submitted; insurer assessing the loss.',
            'Settled' => 'Claim settled; amount credited to client account.',
            'Repudiated' => 'Insurer repudiated – loss falls under exclusion. Appeal being reviewed.',
        ];
        $handler = User::where('role', 'claims')->value('id');
        $n = 0;
        foreach ($descr as $type => $d) {
            for ($k = 0; $k < 2; $k++) {
                $policy = Policy::where('status', 'Active')->where('line', 'like', '%' . $lineFor[$type] . '%')->inRandomOrder()->first();
                if (! $policy) continue;
                $n++;
                $target = $n === 3 ? 'Repudiated' : $flow[$this->r(0, 5)];
                $est = $this->round((float) $policy->sum_insured * $this->r(2, 30) / 1000, 1000);
                $est = min($est, 4500000);
                $loss = $this->today->copy()->subDays($this->r(3, 110));
                $c = Claim::create([
                    'ref' => Claim::nextRef(), 'client_id' => $policy->client_id, 'policy_id' => $policy->id, 'handler_id' => $handler,
                    'loss_date' => $loss, 'loss_type' => $type, 'description' => $d, 'loss_location' => $policy->risk_location,
                    'estimated_amount' => $est, 'settled_amount' => $target === 'Settled' ? $this->round($est * $this->r(70, 95) / 100, 1000) : null,
                    'insurer_claim_no' => $target !== 'Requested' ? 'CL' . $this->r(10000000, 99999999) : null,
                    'status' => $target, 'raised_by' => $this->r(1, 2) === 1 ? 'Client' : 'Team', 'contact_name' => $policy->client->contact_person,
                    'contact_phone' => $policy->client->phone, 'created_at' => $loss->copy()->addDays(1),
                ]);
                $steps = $target === 'Repudiated' ? array_merge(array_slice($flow, 0, 5), ['Repudiated']) : array_slice($flow, 0, array_search($target, $flow) + 1);
                $last = null;
                foreach ($steps as $j => $s) {
                    $last = ClaimUpdate::create(['claim_id' => $c->id, 'user_id' => $j ? $handler : null, 'status' => $s, 'note' => $updateNotes[$s], 'created_at' => min($loss->copy()->addDays(1 + $j * $this->r(3, 9)), now())]);
                }
                $c->timestamps = false; $c->updated_at = $last->created_at; $c->save();
            }
        }
    }

    private function portalLogins(): void
    {
        $demo = Client::where('name', 'Eastern Castings Pvt Ltd')->first();
        CustomerUser::create(['client_id' => $demo->id, 'name' => 'Rakesh Jalan', 'email' => 'client@easterncastings.demo', 'password' => 'Client@2026']);

        // make sure the demo client has a quote waiting for approval and an open claim
        $policy = $demo->policies()->where('status', 'Active')->where('line', 'Fire & Allied Perils')->first() ?? $demo->policies()->where('status', 'Active')->first();
        $policy->update(['end_date' => $this->today->copy()->addDays(24), 'start_date' => $this->today->copy()->addDays(24)->subYear()->addDay()]);
        $ren = Renewal::firstOrCreate(['policy_id' => $policy->id], ['owner_id' => $policy->rm_id]);
        $ren->update(['stage' => 'Quotes in', 'notes' => 'Four insurers quoted; comparison sent to Mr. Jalan.']);
        Quotation::where('renewal_id', $ren->id)->delete();
        $q = Quotation::create([
            'ref' => Quotation::nextRef(), 'client_id' => $demo->id, 'renewal_id' => $ren->id, 'rm_id' => $policy->rm_id, 'prospect_name' => $demo->name,
            'line' => $policy->line, 'sum_insured' => $policy->sum_insured, 'current_premium' => $policy->premium, 'status' => 'Sent to client',
            'requirement' => 'Renewal of ' . $policy->line . ' for the Howrah foundry and finished goods store. Add earthquake cover this year.',
            'recommendation_note' => 'We recommend this option: it is not the cheapest, but it includes earthquake and terrorism cover with a lower deductible, which matters for your Howrah plant. The difference from the lowest quote is small.',
            'sent_at' => $this->today->copy()->subDay(),
        ]);
        $this->addOptions($q, (float) $policy->premium * 0.95, 4, true);

        $other = $demo->policies()->where('status', 'Active')->where('line', 'Machinery Breakdown')->first() ?? $policy;
        $c = Claim::create([
            'ref' => Claim::nextRef(), 'client_id' => $demo->id, 'policy_id' => $other->id, 'handler_id' => User::where('role', 'claims')->value('id'),
            'loss_date' => $this->today->copy()->subDays(12), 'loss_type' => 'Machinery breakdown', 'description' => 'Induction furnace transformer failed during the night shift; melting stopped.',
            'loss_location' => 'Unit 2, Dasnagar, Howrah', 'estimated_amount' => 850000, 'insurer_claim_no' => 'CL' . $this->r(10000000, 99999999),
            'status' => 'Surveyor appointed', 'raised_by' => 'Client', 'contact_name' => 'Rakesh Jalan', 'contact_phone' => $demo->phone, 'created_at' => $this->today->copy()->subDays(11),
        ]);
        foreach ([['Requested', 'Claim request received from client portal with 4 photos.', 11], ['Intimated to insurer', 'Intimated to insurer; claim number received.', 10], ['Surveyor appointed', 'Surveyor Mr. A. K. Sen appointed; visit on ' . $this->today->copy()->addDays(1)->format('d M') . '.', 3]] as [$s, $note, $ago]) {
            ClaimUpdate::create(['claim_id' => $c->id, 'status' => $s, 'note' => $note, 'created_at' => $this->today->copy()->subDays($ago)->setTime(11, 30)]);
        }
        $c->timestamps = false; $c->updated_at = $this->today->copy()->subDays(3)->setTime(11, 30); $c->save();
    }
}
