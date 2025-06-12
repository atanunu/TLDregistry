<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Dns\TopologyManager;
use App\Dns\Contracts\DnsProviderInterface;
class CreateSecondaryZone extends Command
{
    protected $signature='dns:create-secondary {provider} {zone} {masters*}';
    protected $description='Provision a secondary zone on the given provider';
    public function handle()
    {
        $providerKey=$this->argument('provider');
        $zone=$this->argument('zone');
        $masters=$this->argument('masters');
        $conf=config('dns.providers');
        if(!isset($conf[$providerKey])){ $this->error('Unknown provider'); return 1; }
        $driver=app($conf[$providerKey]);
        if(!$driver instanceof DnsProviderInterface){ $this->error('Invalid driver'); return 1; }
        $driver->createZone($zone,['masters'=>$masters]);
        $this->info("Secondary zone created on {$providerKey} for {$zone}");
        return 0;
    }
}
