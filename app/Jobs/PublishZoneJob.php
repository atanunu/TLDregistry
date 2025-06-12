<?php
namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Zone;
use App\Dns\TopologyManager;
use App\Dns\Contracts\DnsProviderInterface;
class PublishZoneJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable;
    public function __construct(private Zone $zone, private array $records){}
    public function handle(TopologyManager $tm): void
    {
        $set=$tm->driversFor($this->zone);
        $set->primary()->pushRecords($this->zone->name,$this->records);
        foreach($set->secondary() as $sec){$sec->syncFromPrimary($this->zone,$set->primary());}
    }
}
