<?php
namespace App\Registrar\Services;

use App\Registrar\Models\Registrar;
use App\Registrar\Models\ActivityLog;
use App\Registrar\Models\RegistrarBalance;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RegistrarService
{
    public function debit(Registrar $registrar, float $amount, string $reason): void
    {
        $balance = $registrar->balance()->lockForUpdate()->first();
        if (!$balance) {
            $balance = RegistrarBalance::create([
                'registrar_id'=>$registrar->id,
                'available'=>0,
                'credit_limit'=>0
            ]);
        }

        if (($balance->available - $amount) < -$balance->credit_limit) {
            throw new UnprocessableEntityHttpException('Insufficient credit');
        }

        $balance->available -= $amount;
        $balance->save();

        ActivityLog::log($registrar,'debit',[
            'amount'=>$amount,
            'reason'=>$reason
        ]);
    }

    public function credit(Registrar $registrar, float $amount, string $reason): void
    {
        $balance = $registrar->balance()->lockForUpdate()->firstOrFail();
        $balance->available += $amount;
        $balance->save();

        ActivityLog::log($registrar,'credit',[
            'amount'=>$amount,
            'reason'=>$reason
        ]);
    }
}
