<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
    public function up(){Schema::create('dns_provider_logs',function(Blueprint $t){$t->id();$t->string('provider');$t->string('zone')->nullable();$t->string('action');$t->json('request')->nullable();$t->json('response')->nullable();$t->unsignedSmallInteger('http_code')->nullable();$t->timestamps();$t->index('created_at');});}
    public function down(){Schema::dropIfExists('dns_provider_logs');}
};
