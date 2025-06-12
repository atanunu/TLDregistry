<?php
namespace App\Dns\Drivers;
use App\Dns\Contracts\DnsProviderInterface;
use App\Dns\BaseRestDriver;
use App\Models\Zone;
/** PowerDNS Primary Driver */
class PowerDNSPrimaryDriver implements DnsProviderInterface
{
    use BaseRestDriver;
    private const BASE='http://127.0.0.1:8081/api/v1';
    public function __construct(private readonly string $token=''){$this->token=$this->token?:env('PDNS_API_KEY');}
    public function createZone(string $zone, array $options=[]):mixed{/* TODO */return null;}
    public function pushRecords(string $zone, array $records):mixed{/* TODO */return null;}
    public function enableDnsSec(string $zone):mixed{/* TODO */return null;}
    public function syncFromPrimary(Zone $zone, DnsProviderInterface $primary):mixed{return null;}
}
