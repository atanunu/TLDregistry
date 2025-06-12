# TLD Registry DNS subsystem

This package provides pluggable DNS drivers for a Laravel 11 registry platform.

## Contents
- Configurable topologies (primary/secondary)
- Drivers: Cloudns, PowerDNS, Cloudflare, Hetzner
- Artisan command `dns:create-secondary`
- Queue Job `PublishZoneJob`

## Installation
1. Copy files into your Laravel project root.
2. Register `DnsServiceProvider` in `config/app.php`.
3. Run migrations.
4. Set `.env` secrets and `DNS_TOPOLOGY`.

