<?php
namespace App\Registrar\Http\Controllers\Api\V1;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{
    public function profile()
    {
        return response()->json(app('registrar'));
    }

    public function balance()
    {
        $registrar = app('registrar');
        return response()->json($registrar->balance()->first());
    }
}
