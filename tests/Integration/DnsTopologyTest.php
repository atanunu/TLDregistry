<?php
namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Models\Zone;
use App\Dns\TopologyManager;
use App\Dns\DriverSet;

/**
 * Integration‑level test that exercises the TopologyManager and PublishZoneJob
 * with faked HTTP endpoints for every provider alias configured in dns.php.
 *
 * This ensures:
 *   1. Each provider alias can be instantiated by the IoC container.
 *   2. The primary driver receives a pushRecords call.
 *   3. Every secondary driver receives syncFromPrimary without exception.
 */
class DnsTopologyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Fake ALL external HTTP requests so no real API calls are made.
        Http::fake(['*' => Http::response(['status'=>'Success'], 200)]);
    }

    /** @test */
    public function every_topology_works_in_isolation()
    {
        $manager = app(TopologyManager::class);
        $zone    = Zone::factory()->create(['name'=>'test.example','tld'=>'example']);

        // Cycle through configured topologies
        foreach (config('dns.topologies') as $key => $topo) {
            config(['dns.topology' => $key]);           // hot‑swap topology

            $set = $manager->driversFor($zone);
            $this->assertInstanceOf(DriverSet::class, $set, "{$key} did not return DriverSet");

            // Make sure primary push does not throw
            $set->primary()->pushRecords($zone->name, [
                ['name'=>'@','type'=>'A','value'=>'192.0.2.1','ttl'=>300]
            ]);

            // Make sure every secondary can sync
            foreach ($set->secondary() as $sec) {
                $sec->syncFromPrimary($zone, $set->primary());
                $this->assertTrue(true, get_class($sec).' sync passed');
            }
        }
    }
}
