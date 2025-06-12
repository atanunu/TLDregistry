<?php
namespace App\Dns;
use App\Dns\Contracts\DnsProviderInterface;
class DriverSet
{
    public function __construct(private DnsProviderInterface $primary, private array $secondary){}
    public function primary():DnsProviderInterface{return $this->primary;}
    public function secondary():array{return $this->secondary;}
}
