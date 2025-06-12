<?php
namespace App\Registrar\Http\Controllers\Rdap;

use Illuminate\Routing\Controller;
use App\Models\Domain;
use App\Http\Resources\Rdap\DomainResource;

class DomainController extends Controller
{
    public function __invoke(string $name)
    {
        $domain = Domain::where('name',$name)->firstOrFail();
        return new DomainResource($domain);
    }
}
