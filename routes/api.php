<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BarangaysController;
use App\Http\Controllers\Api\RegionsController;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Pages\AppointmentPage;
use App\Livewire\Pages\CasePage;
use App\Livewire\Pages\CaseStagePage;
use App\Livewire\Pages\CaseSubType;
use App\Livewire\Pages\ClientPage;
use App\Livewire\Pages\CourtPage;
use App\Models\AppointmentsModel;
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


Route::get('/api/regions', [ApiController::class, 'getRegions'])->name('api.regions.index');
Route::get('/api/provinces', [ApiController::class, 'getProvinces'])->name('api.provinces.index');
Route::get('/api/municipalities', [ApiController::class, 'getMunicipalities'])->name('api.municipalities.index');
Route::get('/api/barangays', [ApiController::class, 'getBarangays'])->name('api.barangays.index');

// EDIT CLIENT
Route::get('/api/client/regions', [ApiController::class, 'getRegions'])->name('api.regions.client');
Route::get('/api/client/provinces', [ApiController::class, 'getProvinces'])->name('api.provinces.client');
Route::get('/api/client/municipalities', [ApiController::class, 'getMunicipalities'])->name('api.municipalities.client');
Route::get('/api/client/barangays', [ApiController::class, 'getBarangays'])->name('api.barangays.client');

// CASE SUB TYPE
Route::get('/case/types', [ApiController::class, 'getCaseTypes'])->name('api.case.types');
Route::get('/api/case/sub-types', [ApiController::class, 'getCaseSubTypes'])->name('api.case.sub-types');

// CASE STAGE 
Route::get('/api/case/stage', [ApiController::class, 'getCaseStage'])->name('api.case.stage');

// COURT TYPE
Route::get('/court/types', [ApiController::class, 'getCourtTypes'])->name('api.court.types');
Route::get('/courts', [ApiController::class, 'getCourts'])->name('api.courts');
Route::get('/courts/{courtTypeId}', [ApiController::class, 'getCourtsByType'])->name('api.court.byType');

// USER
Route::get('/api/user/participant', [ApiController::class, 'getParticipant'])->name('api.user.participant');
Route::post('/law-sched-admin/appointment', [AppointmentPage::class, 'createMeeting']);

// SERVICES
Route::get('/api/services/types', [ApiController::class, 'getServiceTypes'])->name('api.services.types');
Route::get('/api/services', [ApiController::class, 'getServices'])->name('api.services');

// ZOOM
// Route::get('/zoom/authorize', [AppointmentPage::class, 'redirectToZoom'])->name('zoom.authorize');
// Route::get('/zoom/callback', [AppointmentPage::class, 'handleZoomCallback']);
// Route::post('/zoom-meetings', [AppointmentPage::class, 'createMeeting']);
