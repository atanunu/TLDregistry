<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tld extends Model{
    use SoftDeletes;
    protected $fillable=['name','type','status'];
    public function reservedLabels(){return $this->hasMany(ReservedLabel::class);}
    public function premiumLabels(){return $this->hasMany(PremiumLabel::class);}
}
