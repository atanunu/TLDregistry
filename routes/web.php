<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\RegistrarTable;

/*
|--------------------------------------------------------------------------
| Web Routes  –  v6 additions
|--------------------------------------------------------------------------
|
| Admins can list and search registrars at /admin/registrars.
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/registrars', RegistrarTable::class)
        ->name('admin.registrars');
