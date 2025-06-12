<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
  public function up(){Schema::create('premium_labels',function(Blueprint $t){$t->id();$t->foreignId('tld_id')->constrained('tlds');$t->string('label');$t->decimal('fee',12,2);$t->string('currency',3);$t->string('status');$t->unique(['tld_id','label']);});}
  public function down(){Schema::dropIfExists('premium_labels');}
};
