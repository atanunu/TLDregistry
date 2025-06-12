<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = ['registrar_id','severity','payload','reported_at'];

    protected $casts = [
        'payload' => 'array',
        'reported_at' => 'datetime'
    ];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
