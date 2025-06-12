<?php
namespace App\Dns;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Throwable;
/** Common HTTP, retry, back‑off and audit for REST-based providers. */
trait BaseRestDriver
{
    protected int $retryMax = 3;
    protected int $sleepMs  = 500;

    protected function http(string $method, string $url, array $options, string $provider, string $action)
    {
        $attempt = 0;
        do {
            $attempt++;
            $resp = Http::retry(0,0)->{$method}($url, $options);
            $this->audit($provider,$action,$options,$resp);
            if($resp->successful()) return $resp;
            usleep($this->sleepMs*1000);
        }while($attempt<$this->retryMax);
        throw new \RuntimeException("{$provider} {$action} failed after retries: ".$resp->body());
    }

    private function audit(string $provider,string $action,array $req,$resp):void
    {
        try{
            DB::table('dns_provider_logs')->insert([
                'provider'=>$provider,
                'zone'=>$req['domain-name']??($req['name']??''),
                'action'=>$action,
                'request'=>json_encode($req,JSON_UNESCAPED_SLASHES),
                'response'=>$resp->body(),
                'http_code'=>$resp->status(),
                'created_at'=>now(),'updated_at'=>now(),
            ]);
        }catch(Throwable){}
    }
}
