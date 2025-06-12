<?php
namespace App\Registrar\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Registrar\Models\Registrar;

class VerifyRegistrantDeadline implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Registrar::where('status','pending')
            ->whereDate('registrant_verify_deadline','<', now())
            ->update(['status'=>'suspended']);
    }
}
