<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Dns\Contracts\DnsProviderInterface;

/**
 * Data‑driven test that loops through every driver class defined in config('dns.providers')
 * so adding new providers automatically enforces contract compliance.
 */
class DriverMatrixTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::fake(['*'=>Http::response(['status'=>'Success'], 200)]);
    }

    /** @test */
    public function all_drivers_implement_contract_methods()
    {
        foreach (config('dns.providers') as $alias => $class) {
            $drv = app($class);
            $this->assertInstanceOf(DnsProviderInterface::class, $drv, "{$alias} is not a valid driver");

            // smoke‑call contract methods; exceptions indicate failure
            $drv->createZone("matrix‑test‑{$alias}.tld", []);
            $drv->pushRecords("matrix‑test‑{$alias}.tld", []);
            try { $drv->enableDnsSec("matrix‑test‑{$alias}.tld"); } catch (\Throwable) {}
        }
    }
}
