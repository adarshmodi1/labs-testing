<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posps', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('name');
            $t->string('phone');
            $t->string('email')->nullable();
            $t->string('pan', 10)->nullable();
            $t->string('city');
            $t->string('qualification')->nullable();
            $t->unsignedTinyInteger('training_hours')->default(0);
            $t->string('exam_status')->default('Not taken'); // Not taken, Passed, Failed
            $t->string('certificate_no')->nullable();
            $t->date('certified_on')->nullable();
            $t->string('status')->default('Applied'); // Applied, In training, Certified, Active, Inactive
            $t->string('bank_name')->nullable();
            $t->string('account_last4', 4)->nullable();
            $t->foreignId('rm_id')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamps();
        });

        Schema::create('insurers', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('short_name');
            $t->string('category'); // Private general, Public sector general, Standalone health, Life
            $t->string('api_status')->default('To request'); // Partner API confirmed, Likely, To request, Email / portal
            $t->string('colour', 7)->default('#13315C');
            $t->timestamps();
        });

        Schema::create('clients', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('group_name')->nullable();
            $t->string('segment'); // Large corporate, SME, HNI, Retail
            $t->string('industry')->nullable();
            $t->string('city');
            $t->string('state')->default('West Bengal');
            $t->string('gstin', 15)->nullable();
            $t->string('contact_person');
            $t->string('contact_designation')->nullable();
            $t->string('phone');
            $t->string('email');
            $t->foreignId('rm_id')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('posp_id')->nullable()->constrained('posps')->nullOnDelete();
            $t->date('client_since')->nullable();
            $t->timestamps();
        });

        Schema::create('customer_users', function (Blueprint $t) {
            $t->id();
            $t->foreignId('client_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->rememberToken();
            $t->timestamp('last_login_at')->nullable();
            $t->timestamps();
        });

        Schema::create('policies', function (Blueprint $t) {
            $t->id();
            $t->foreignId('client_id')->constrained()->cascadeOnDelete();
            $t->foreignId('insurer_id')->constrained();
            $t->foreignId('rm_id')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('posp_id')->nullable()->constrained('posps')->nullOnDelete();
            $t->string('line'); // line of business
            $t->string('policy_no');
            $t->decimal('sum_insured', 16, 2);
            $t->decimal('premium', 14, 2); // net premium, before GST
            $t->decimal('gst', 14, 2);
            $t->decimal('commission_rate', 5, 2); // %
            $t->date('start_date');
            $t->date('end_date');
            $t->string('status')->default('Active'); // Active, Renewed, Lapsed, Cancelled
            $t->string('risk_location')->nullable();
            $t->foreignId('renewed_from_id')->nullable()->constrained('policies')->nullOnDelete();
            $t->timestamps();
        });

        Schema::create('leads', function (Blueprint $t) {
            $t->id();
            $t->string('company');
            $t->string('contact_person');
            $t->string('phone');
            $t->string('email')->nullable();
            $t->string('city');
            $t->string('industry')->nullable();
            $t->string('segment');
            $t->string('source'); // Referral, Existing client, Website, WhatsApp, Event, POSP, Cold call
            $t->string('lines'); // comma separated lines of business
            $t->decimal('expected_premium', 14, 2)->default(0);
            $t->string('stage')->default('New'); // New, Contacted, Meeting, Quotation, Won, Lost
            $t->string('lost_reason')->nullable();
            $t->date('next_follow_up')->nullable();
            $t->foreignId('rm_id')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('posp_id')->nullable()->constrained('posps')->nullOnDelete();
            $t->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $t->text('notes')->nullable();
            $t->timestamps();
        });

        Schema::create('lead_activities', function (Blueprint $t) {
            $t->id();
            $t->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->string('type'); // Call, Meeting, Email, WhatsApp, Note, Stage change
            $t->text('note');
            $t->timestamps();
        });

        Schema::create('renewals', function (Blueprint $t) {
            $t->id();
            $t->foreignId('policy_id')->unique()->constrained()->cascadeOnDelete();
            $t->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('stage')->default('Not started'); // Not started, Data requested, Data received, Quotes in, Client approved, Renewed, Lost
            $t->string('lost_reason')->nullable();
            $t->decimal('renewed_premium', 14, 2)->nullable();
            $t->date('next_action_on')->nullable();
            $t->text('notes')->nullable();
            $t->timestamps();
        });

        Schema::create('quotations', function (Blueprint $t) {
            $t->id();
            $t->string('ref')->unique();
            $t->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('renewal_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('rm_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('prospect_name'); // client or lead company name
            $t->string('line');
            $t->decimal('sum_insured', 16, 2)->nullable();
            $t->decimal('current_premium', 14, 2)->nullable(); // for renewals: expiring premium
            $t->string('status')->default('Draft'); // Draft, Requested, Quotes received, Sent to client, Approved, Declined
            $t->text('requirement')->nullable();
            $t->text('recommendation_note')->nullable();
            $t->foreignId('approved_option_id')->nullable();
            $t->timestamp('sent_at')->nullable();
            $t->timestamp('approved_at')->nullable();
            $t->string('approved_by')->nullable();
            $t->timestamps();
        });

        Schema::create('quote_options', function (Blueprint $t) {
            $t->id();
            $t->foreignId('quotation_id')->constrained()->cascadeOnDelete();
            $t->foreignId('insurer_id')->constrained();
            $t->string('option_label')->nullable(); // e.g. "Option B - higher deductible"
            $t->decimal('premium', 14, 2);
            $t->decimal('gst', 14, 2)->default(0);
            $t->decimal('sum_insured', 16, 2)->nullable();
            $t->string('deductible')->nullable();
            $t->text('key_covers')->nullable();
            $t->text('exclusions')->nullable();
            $t->date('valid_until')->nullable();
            $t->boolean('is_recommended')->default(false);
            $t->boolean('show_to_client')->default(true);
            $t->string('source')->default('Manual'); // Manual, AI
            $t->string('pdf_path')->nullable();
            $t->json('ai_meta')->nullable();
            $t->timestamps();
        });

        Schema::create('claims', function (Blueprint $t) {
            $t->id();
            $t->string('ref')->unique();
            $t->foreignId('client_id')->constrained()->cascadeOnDelete();
            $t->foreignId('policy_id')->constrained()->cascadeOnDelete();
            $t->foreignId('handler_id')->nullable()->constrained('users')->nullOnDelete();
            $t->date('loss_date');
            $t->string('loss_type');
            $t->text('description');
            $t->string('loss_location')->nullable();
            $t->decimal('estimated_amount', 14, 2)->nullable();
            $t->decimal('settled_amount', 14, 2)->nullable();
            $t->string('insurer_claim_no')->nullable();
            $t->string('status')->default('Requested'); // Requested, Intimated to insurer, Surveyor appointed, Documents pending, Under assessment, Settled, Repudiated
            $t->string('raised_by')->default('Client'); // Client, Team
            $t->string('contact_name')->nullable();
            $t->string('contact_phone')->nullable();
            $t->json('attachments')->nullable();
            $t->timestamps();
        });

        Schema::create('claim_updates', function (Blueprint $t) {
            $t->id();
            $t->foreignId('claim_id')->constrained()->cascadeOnDelete();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->string('status');
            $t->text('note')->nullable();
            $t->boolean('visible_to_client')->default(true);
            $t->timestamps();
        });

        Schema::create('settings', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->text('value')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['settings', 'claim_updates', 'claims', 'quote_options', 'quotations', 'renewals', 'lead_activities', 'leads', 'policies', 'customer_users', 'clients', 'insurers', 'posps'] as $t) {
            Schema::dropIfExists($t);
        }
    }
};
