<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1 as V1;

Route::prefix('v1/registry')->group(function(){
    Route::apiResource('tlds.reserved-labels',V1\ReservedLabelController::class)->parameters(['reserved-labels'=>'label']);
    Route::apiResource('tlds.premium-labels',V1\PremiumLabelController::class)->parameters(['premium-labels'=>'label']);
    Route::get('tlds/{tld}/fees',[V1\TldFeeController::class,'show']);
    Route::put('tlds/{tld}/fees',[V1\TldFeeController::class,'update']);
});
