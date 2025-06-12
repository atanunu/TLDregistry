<?php
use Illuminate\Support\Facades\Route;
use App\Registrar\Http\Controllers\Rdap\DomainController as RdapDomain;
use App\Registrar\Http\Middleware\VerifyRdapOidc;

Route::middleware([VerifyRdapOidc::class])
    ->get('/rdap/domain/{name}', RdapDomain::class);
