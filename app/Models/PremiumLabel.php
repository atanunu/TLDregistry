<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PremiumLabel extends Model{
    protected $fillable=['tld_id','label','fee','currency','status'];
    public $timestamps=false;
}
