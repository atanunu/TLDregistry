<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrarContact extends Model
{
    protected $fillable = ['registrar_id','type','name','email','phone'];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
