<?php
namespace App\Registrar\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;

class LoadCollisionSet extends Command
{
    protected $signature = 'registry:load-ncrf {url}';
    protected $description = 'Load Name Collision block list into Redis set';

    public function handle(): int
    {
        $url = $this->argument('url');
        $this->info("Downloading {$url}");
        $csv = Http::get($url)->body();
        $labels = array_filter(array_map('trim', explode("\n", $csv)));

        Redis::del('ncrf');
        Redis::sadd('ncrf', $labels);

        $this->info('Loaded '.count($labels).' labels');
        return 0;
    }
}
