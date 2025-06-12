<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activity_logs', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->string('action');
            $t->json('payload')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('activity_logs'); }
};
