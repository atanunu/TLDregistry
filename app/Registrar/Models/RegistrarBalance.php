<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrarBalance extends Model
{
    protected $fillable = ['registrar_id','available','credit_limit'];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }

    public function available()
    {
        return $this->available;
    }
}
