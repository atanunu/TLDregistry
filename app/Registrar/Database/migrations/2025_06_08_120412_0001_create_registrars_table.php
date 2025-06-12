<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrars', function (Blueprint $t) {
            $t->id();
            $t->string('handle')->unique();
            $t->string('legal_name');
            $t->string('website')->nullable();
            $t->enum('status',['pending','active','suspended','terminated'])->default('pending');
            $t->json('allowed_tlds')->nullable();
            $t->unsignedDecimal('credit_limit',14,2)->default(0);
            // compliance fields
            $t->string('abuse_email')->nullable();
            $t->string('abuse_phone')->nullable();
            $t->timestamp('registrant_verify_deadline')->nullable();
            $t->boolean('is_data_retention_opt_out')->default(false);
            $t->boolean('is_essential_entity')->default(false);
            $t->string('incident_webhook_url')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrars'); }
};
