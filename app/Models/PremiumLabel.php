<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tld_id',
        'label',
        'fee',
        'currency',
    ];

    public function tld()
    {
        return $this->belongsTo(Tld::class);
    }
}
