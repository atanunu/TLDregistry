<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
  public function up(){Schema::create('reserved_labels',function(Blueprint $t){$t->id();$t->foreignId('tld_id')->constrained('tlds');$t->string('label');$t->string('status');$t->string('reason')->nullable();$t->unique(['tld_id','label']);});}
  public function down(){Schema::dropIfExists('reserved_labels');}
};
