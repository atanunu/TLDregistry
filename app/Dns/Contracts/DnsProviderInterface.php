<?php
namespace App\Dns\Contracts;
use App\Models\Zone;
interface DnsProviderInterface
{
    public function createZone(string $zone, array $options = []): mixed;
    public function pushRecords(string $zone, array $records): mixed;
    public function enableDnsSec(string $zone): mixed;
    public function syncFromPrimary(Zone $zone, self $primary): mixed;
}
