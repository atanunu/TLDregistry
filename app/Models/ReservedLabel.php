<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tld_id',
        'label',
        'reason',
    ];

    public function tld()
    {
        return $this->belongsTo(Tld::class);
    }
}
