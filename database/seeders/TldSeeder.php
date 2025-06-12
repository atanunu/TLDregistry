<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Tld;
class TldSeeder extends Seeder{
  public function run(){
    collect(['ngo','ngo.ng','atanunu','del'])->each(fn($n)=>Tld::firstOrCreate(['name'=>$n],['type'=>'gTLD','status'=>'OPEN']));
  }
}
