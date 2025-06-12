<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrar_id',
        'amount',
        'note',
    ];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
