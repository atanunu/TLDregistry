<?php
return [
    'topology' => env('DNS_TOPOLOGY', 'powerdns_master'),
    'providers' => [
        'powerdns' => App\Dns\Drivers\PowerDNSPrimaryDriver::class,
    ],
    'topologies'=>[
        'powerdns_master'=>[
            'primary'=>'powerdns',
            'secondary'=>[],
        ],
    ],
    'tld_overrides'=>[],
];
