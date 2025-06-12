<?php
namespace Database\Factories;
use App\Models\Tld; use Illuminate\Database\Eloquent\Factories\Factory;
class TldFactory extends Factory{
  protected \$model=Tld::class;
  public function definition(){ return ['name'=>$this->faker->unique()->domainWord(),'type'=>'gTLD','status'=>'OPEN']; }
}
