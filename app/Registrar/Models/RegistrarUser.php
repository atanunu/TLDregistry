<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegistrarUser extends Authenticatable
{
    protected $fillable = [
        'registrar_id','name','email','password','role'
    ];

    protected $hidden = ['password','remember_token'];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
