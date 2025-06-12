<?php
namespace App\Registrar\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Registrar\Models\Incident;
use Illuminate\Support\Facades\Http;

class DispatchIncidents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Incident::whereNull('reported_at')
            ->whereHas('registrar', function ($q) {
                $q->where('is_essential_entity', true);
            })->chunkById(100, function ($incidents) {
                foreach ($incidents as $incident) {
                    Http::retry(3, 100)
                        ->post($incident->registrar->incident_webhook_url, $incident->payload);
                    $incident->reported_at = now();
                    $incident->save();
                }
            });
    }
}
