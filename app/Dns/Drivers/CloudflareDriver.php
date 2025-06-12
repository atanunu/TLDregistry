<?php
namespace App\Dns\Drivers;
use App\Dns\Contracts\DnsProviderInterface;
use App\Dns\BaseRestDriver;
use App\Models\Zone;
/** Cloudflare Driver */
class CloudflareDriver implements DnsProviderInterface
{
    use BaseRestDriver;
    private const BASE='https://api.cloudflare.com/client/v4';
    public function __construct(private readonly string $token=''){$this->token=$this->token?:env('CLOUDFLARE_API_TOKEN');}
    public function createZone(string $zone, array $options=[]):mixed{/* TODO */return null;}
    public function pushRecords(string $zone, array $records):mixed{/* TODO */return null;}
    public function enableDnsSec(string $zone):mixed{/* TODO */return null;}
    public function syncFromPrimary(Zone $zone, DnsProviderInterface $primary):mixed{return null;}
}
