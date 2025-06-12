<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ReservedLabel extends Model{
    protected $fillable=['tld_id','label','status','reason'];
    public $timestamps=false;
}
