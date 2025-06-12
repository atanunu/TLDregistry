<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
  public function up(){Schema::table('tlds',function(Blueprint $t){$t->decimal('create_fee',12,2)->default(0);$t->decimal('renew_fee',12,2)->default(0);$t->decimal('restore_fee',12,2)->default(0);$t->string('currency',3)->default('USD');});}
  public function down(){Schema::table('tlds',function(Blueprint $t){$t->dropColumn(['create_fee','renew_fee','restore_fee','currency']);});}
};
