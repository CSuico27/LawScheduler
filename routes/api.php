<?php

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


Route::get('/api/regions', [RegisterPage::class, 'getRegions'])->name('api.regions.index');
Route::get('/api/provinces', [RegisterPage::class, 'getProvinces'])->name('api.provinces.index');
Route::get('/api/municipalities', [RegisterPage::class, 'getMunicipalities'])->name('api.municipalities.index');
Route::get('/api/barangays', [RegisterPage::class, 'getBarangays'])->name('api.barangays.index');

// EDIT CLIENT
Route::get('/api/client/regions', [ClientPage::class, 'getRegions'])->name('api.regions.client');
Route::get('/api/client/provinces', [ClientPage::class, 'getProvinces'])->name('api.provinces.client');
Route::get('/api/client/municipalities', [ClientPage::class, 'getMunicipalities'])->name('api.municipalities.client');
Route::get('/api/client/barangays', [ClientPage::class, 'getBarangays'])->name('api.barangays.client');

// CASE SUB TYPE
Route::get('/case/types', [CaseSubType::class, 'getCaseTypes'])->name('api.case.types');
Route::get('/api/case/sub-types', [CasePage::class, 'getCaseSubTypes'])->name('api.case.sub-types');

// CASE STAGE 
Route::get('/api/case/stage', [CasePage::class, 'getCaseStage'])->name('api.case.stage');

// COURT TYPE
Route::get('/court/types', [CourtPage::class, 'getCourtTypes'])->name('api.court.types');
Route::get('/courts', [CasePage::class, 'getCourts'])->name('api.courts');
Route::get('/courts/{courtTypeId}', [CasePage::class, 'getCourtsByType'])->name('api.court.byType');

// USER
Route::get('/api/user/participant', [AppointmentPage::class, 'getParticipant'])->name('api.user.participant');
Route::post('/law-sched-admin/appointment', [AppointmentPage::class, 'createMeeting']);

// ZOOM
// Route::get('/zoom/authorize', [AppointmentPage::class, 'redirectToZoom'])->name('zoom.authorize');
// Route::get('/zoom/callback', [AppointmentPage::class, 'handleZoomCallback']);
// Route::post('/zoom-meetings', [AppointmentPage::class, 'createMeeting']);
