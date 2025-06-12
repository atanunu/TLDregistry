<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('incidents', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->string('severity');
            $t->json('payload');
            $t->timestamp('reported_at')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('incidents'); }
};
