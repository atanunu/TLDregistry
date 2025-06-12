<?php
use Illuminate\Support\Facades\Route;
use App\Registrar\Http\Controllers\Api\V1\DomainController;
use App\Registrar\Http\Controllers\Api\V1\RegistrarController;
use App\Registrar\Http\Middleware\VerifyRegistrarSignature;

Route::prefix('registrar/v1')
    ->middleware(['json.response', VerifyRegistrarSignature::class])
    ->group(function () {
        Route::get('domains/{name}/check', [DomainController::class,'check'])->name('domains.check');
        Route::post('domains', [DomainController::class,'register'])->name('domains.register');
        Route::get('me', [RegistrarController::class,'profile'])->name('registrar.profile');
        Route::get('balance', [RegistrarController::class,'balance'])->name('registrar.balance');
});
