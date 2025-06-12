<?php
namespace App\Dns;
use App\Models\Zone;
class TopologyManager
{
    public function __construct(private array $config){}
    private function make(string $alias){return app($this->config['providers'][$alias]);}
    public function driversFor(Zone $zone):DriverSet
    {
        $key=$this->config['tld_overrides'][$zone->tld]??$this->config['topology'];
        $top=$this->config['topologies'][$key];
        $primary=$this->make($top['primary']);
        $sec=array_map(fn($a)=>$this->make($a),$top['secondary']);
        return new DriverSet($primary,$sec);
    }
}
