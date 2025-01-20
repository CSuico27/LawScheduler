<?php

use App\Livewire\Auth\AccountActivationPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Client\AccountPage;
use App\Livewire\Client\Booking;
use App\Livewire\Client\CancelPage;
use App\Livewire\Client\InvoicePage as ClientInvoicePage;
use App\Livewire\Client\SuccessPage;
use App\Livewire\HomePage;
use App\Livewire\Pages\AppointmentPage;
use App\Livewire\Pages\InvoicePage;
use App\Models\AccountActivation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', HomePage::class)->name('user.home');
Route::get('/invoice/{invoiceId}/pdf', [InvoicePage::class, 'generatePdf'])->name('invoice.pdf');

Route::middleware('guest')->group(function () {
    // AUTH
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
    Route::post('/create-meeting', [AppointmentPage::class, 'createMeeting']);
    Route::get('/activate-account/{token}', AccountActivationPage::class)->name('activate-account');

    
});

Route::middleware('auth')->group(function (){
    Route::get('/logout', function (){
        auth()->logout();
        return redirect('/');
    });

    Route::get('/my-account', AccountPage::class)->name('client.account');
    Route::get('/booking/create', Booking::class)->name('client.booking');
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
    Route::get('/invoice', ClientInvoicePage::class)->name('client.invoice');
});
