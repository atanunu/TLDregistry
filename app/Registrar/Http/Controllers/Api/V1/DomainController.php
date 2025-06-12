<?php
namespace App\Registrar\Http\Controllers\Api\V1;

use Illuminate\Routing\Controller;
use App\Registrar\Http\Requests\RegisterDomainRequest;
use App\Registrar\Services\RegistrarService;
use App\Registrar\Models\Registrar;
use App\Models\Domain;
use App\Services\Dns\PublishZoneJob;

class DomainController extends Controller
{
    protected RegistrarService $service;

    public function __construct(RegistrarService $service)
    {
        $this->service = $service;
    }

    public function check(string $name)
    {
        return ['available'=>Domain::isAvailable($name)];
    }

    public function register(RegisterDomainRequest $request)
    {
        $registrar = app('registrar');
        $price = 10.0; // TODO: dynamic pricing

        $this->service->debit($registrar, $price, 'registration');

        $domain = Domain::create([
            'name'=>$request->domain,
            'registrar_id'=>$registrar->id,
            'expires_at'=>now()->addYears($request->period)
        ]);

        PublishZoneJob::dispatch($domain);

        return response()->json([
            'status'=>'success',
            'domain'=>$domain->name,
            'expiry'=>$domain->expires_at->toDateString()
        ], 201);
    }
}
