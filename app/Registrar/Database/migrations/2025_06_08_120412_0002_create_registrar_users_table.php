<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrar_users', function (Blueprint $t) {
            $t->id();
            $t->foreignId('registrar_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->enum('role',['owner','billing','technical','support']);
            $t->rememberToken();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrar_users'); }
};
