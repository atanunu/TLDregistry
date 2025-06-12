<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrar_api_keys', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->string('label');
            $t->string('key')->unique();
            $t->string('secret');
            $t->json('ip_whitelist')->nullable();
            $t->json('scopes')->default(json_encode(['*']));
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrar_api_keys'); }
};
