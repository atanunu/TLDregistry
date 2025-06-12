<?php
namespace App\Registrar\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Domain;
use App\Services\Dns\DnsDriver;

class ScanCdsRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle(DnsDriver $dns): void
    {
        Domain::where('dnssec_auto', true)->chunkById(100, function ($domains) use ($dns) {
            foreach ($domains as $d) {
                $cds = dns_get_record("_ds.{$d->name}", DNS_CDS);
                if (!$cds) continue;

                $digests = collect($cds)->pluck('digest')->unique();
                if (!$digests->contains($d->ds_digest)) {
                    $d->ds_digest = $digests->first();
                    $d->save();
                    $dns->publishDS($d);
                }
            }
        });
    }
}
