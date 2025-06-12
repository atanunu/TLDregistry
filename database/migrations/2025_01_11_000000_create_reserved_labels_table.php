<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reserved_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tld_id')
                  ->constrained('tlds')
                  ->cascadeOnDelete();
            $table->string('label');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->unique(['tld_id', 'label']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserved_labels');
    }
};
