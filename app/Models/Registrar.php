<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'api_key',
        'balance',
        'credit_limit',
        'status',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     |------------------------------------------------------------------*/

    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }

    /* -----------------------------------------------------------------
     |  Helpers
     |------------------------------------------------------------------*/

    /**
     * Credit the registrar’s balance and create a ledger row.
     */
    public function credit(float $amount, string $note = ''): void
    {
        $this->increment('balance', $amount);

        $this->ledger()->create([
            'amount' =>  $amount,
            'note'   =>  $note ?: 'Manual credit',
        ]);
    }
}
