<?php
namespace App\Registrar\Database\seeders;

use Illuminate\Database\Seeder;
use App\Registrar\Models\Registrar;
use App\Registrar\Models\RegistrarApiKey;
use App\Registrar\Models\RegistrarBalance;

class RegistrarSeeder extends Seeder
{
    public function run(): void
    {
        $reg = Registrar::create([
            'handle'=>'sandbox-001',
            'legal_name'=>'Sandbox Registrar, Inc.',
            'website'=>'https://sandbox-registrar.test',
            'status'=>'active',
            'credit_limit'=>5000,
        ]);

        RegistrarBalance::create([
            'registrar_id'=>$reg->id,
            'available'=>500,
            'credit_limit'=>5000
        ]);

        $reg->apiKeys()->createMany([
            ['label'=>'Live Key','key'=>'rgp_live_demo','secret'=>str_random(64)],
            ['label'=>'Test Key','key'=>'rgp_test_demo','secret'=>str_random(64)]
        ]);
    }
}
