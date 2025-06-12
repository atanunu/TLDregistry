<?php
namespace App\Dns\Drivers;
use App\Dns\Contracts\DnsProviderInterface;
use App\Dns\BaseRestDriver;
use App\Models\Zone;
/** Cloudns Secondary Driver */
class CloudnsSecondaryDriver implements DnsProviderInterface
{
    use BaseRestDriver;
    private const BASE='https://api.cloudns.net/dns';
    public function __construct(private readonly string $token=''){$this->token=$this->token?:env('CLOUDNS_AUTH_PASSWORD');}
    public function createZone(string $zone, array $options=[]):mixed{/* TODO */return null;}
    public function pushRecords(string $zone, array $records):mixed{/* TODO */return null;}
    public function enableDnsSec(string $zone):mixed{/* TODO */return null;}
    public function syncFromPrimary(Zone $zone, DnsProviderInterface $primary):mixed{return null;}
}
