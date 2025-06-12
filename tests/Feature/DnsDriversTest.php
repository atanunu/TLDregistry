<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Dns\Drivers\CloudnsPrimaryDriver;
class DnsDriversTest extends TestCase
{
    public function test_cloudns_push(){Http::fake(['*'=>Http::response(['status'=>'Success'])]);$drv=app(CloudnsPrimaryDriver::class);$drv->pushRecords('example.tld',[]);$this->assertTrue(true);}
}
