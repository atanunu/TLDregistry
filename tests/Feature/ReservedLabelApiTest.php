<?php
namespace Tests\Feature;
use Tests\TestCase; use App\Models\Tld; use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservedLabelApiTest extends TestCase{
use RefreshDatabase;
public function test_can_create_reserved_label(){
    $tld=Tld::factory()->create();
    $resp=$this->postJson("/api/v1/registry/tlds/{$tld->id}/reserved-labels",['label'=>'example','status'=>'blocked']);
    $resp->assertStatus(201)->assertJson(['label'=>'example']);
}
}
