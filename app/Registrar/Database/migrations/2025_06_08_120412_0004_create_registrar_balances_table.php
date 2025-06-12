<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrar_balances', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->decimal('available',14,2)->default(0);
            $t->decimal('credit_limit',14,2)->default(0);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrar_balances'); }
};
