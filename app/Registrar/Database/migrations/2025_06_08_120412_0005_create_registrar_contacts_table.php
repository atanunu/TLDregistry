<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrar_contacts', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->enum('type',['admin','billing','tech','abuse']);
            $t->string('name');
            $t->string('email');
            $t->string('phone')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrar_contacts'); }
};
