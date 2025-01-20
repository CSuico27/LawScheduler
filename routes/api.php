<?php

use App\Http\Controllers\Api\BarangaysController;
use App\Http\Controllers\Api\RegionsController;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Pages\ClientPage;
use App\Models\PHRegions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api/regions', [RegisterPage::class, 'getRegions'])->name('api.regions.index');
Route::get('/api/provinces', [RegisterPage::class, 'getProvinces'])->name('api.provinces.index');
Route::get('/api/municipalities', [RegisterPage::class, 'getMunicipalities'])->name('api.municipalities.index');
Route::get('/api/barangays', [RegisterPage::class, 'getBarangays'])->name('api.barangays.index');

// EDIT CLIENT
Route::get('/api/client/regions', [ClientPage::class, 'getRegions'])->name('api.regions.client');
Route::get('/api/client//provinces', [ClientPage::class, 'getProvinces'])->name('api.provinces.client');
Route::get('/api/client//municipalities', [ClientPage::class, 'getMunicipalities'])->name('api.municipalities.client');
Route::get('/api/client//barangays', [ClientPage::class, 'getBarangays'])->name('api.barangays.client');