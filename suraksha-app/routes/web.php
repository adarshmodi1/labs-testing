<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\PospController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// ---------- Staff ----------
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::post('/leads/{lead}/stage', [LeadController::class, 'stage'])->name('leads.stage');
    Route::post('/leads/{lead}/activity', [LeadController::class, 'activity'])->name('leads.activity');
    Route::post('/leads/{lead}/convert', [LeadController::class, 'convert'])->name('leads.convert');

    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
    Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::get('/quotations/{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
    Route::post('/quotations/{quotation}/options', [QuotationController::class, 'addOption'])->name('quotations.options.store');
    Route::post('/quotations/{quotation}/ai', [QuotationController::class, 'aiRead'])->name('quotations.ai');
    Route::post('/quotations/{quotation}/ai/discard', [QuotationController::class, 'aiDiscard'])->name('quotations.ai.discard');
    Route::post('/quotations/{quotation}/options/{option}/recommend', [QuotationController::class, 'recommend'])->name('quotations.recommend');
    Route::post('/quotations/{quotation}/options/{option}/visibility', [QuotationController::class, 'toggleVisibility'])->name('quotations.visibility');
    Route::delete('/quotations/{quotation}/options/{option}', [QuotationController::class, 'deleteOption'])->name('quotations.options.destroy');
    Route::post('/quotations/{quotation}/send', [QuotationController::class, 'send'])->name('quotations.send');
    Route::post('/quotations/{quotation}/status', [QuotationController::class, 'status'])->name('quotations.status');

    Route::get('/renewals', [RenewalController::class, 'index'])->name('renewals.index');
    Route::post('/renewals/{renewal}/stage', [RenewalController::class, 'stage'])->name('renewals.stage');

    Route::get('/policies', [PolicyController::class, 'index'])->name('policies.index');
    Route::get('/policies/{policy}', [PolicyController::class, 'show'])->name('policies.show');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::post('/clients/{client}/portal-user', [ClientController::class, 'portalUser'])->name('clients.portal-user');

    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::get('/claims/{claim}', [ClaimController::class, 'show'])->name('claims.show');
    Route::post('/claims/{claim}/update', [ClaimController::class, 'update'])->name('claims.update');

    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/{user}/edit', [TeamController::class, 'edit'])->name('team.edit');
    Route::put('/team/{user}', [TeamController::class, 'update'])->name('team.update');

    Route::get('/posps', [PospController::class, 'index'])->name('posps.index');
    Route::get('/posps/create', [PospController::class, 'create'])->name('posps.create');
    Route::post('/posps', [PospController::class, 'store'])->name('posps.store');
    Route::get('/posps/{posp}', [PospController::class, 'show'])->name('posps.show');
    Route::get('/posps/{posp}/edit', [PospController::class, 'edit'])->name('posps.edit');
    Route::put('/posps/{posp}', [PospController::class, 'update'])->name('posps.update');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/test', [SettingsController::class, 'test'])->name('settings.test');

    Route::get('/files/quote/{option}', [FileController::class, 'quotePdf'])->name('files.quote');
    Route::get('/files/claim/{claim}/{i}', [FileController::class, 'claimFile'])->name('files.claim');
});

// ---------- Customer portal ----------
Route::prefix('portal')->name('portal.')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [PortalController::class, 'showLogin'])->name('login');
        Route::post('/login', [PortalController::class, 'login'])->middleware('throttle:10,1');
    });
    Route::post('/logout', [PortalController::class, 'logout'])->name('logout');
    Route::middleware('auth:customer')->group(function () {
        Route::get('/', [PortalController::class, 'home'])->name('home');
        Route::get('/policies', [PortalController::class, 'policies'])->name('policies');
        Route::get('/policies/{policy}', [PortalController::class, 'policy'])->name('policy');
        Route::get('/renewals', [PortalController::class, 'renewals'])->name('renewals');
        Route::get('/quotes', [PortalController::class, 'quotes'])->name('quotes');
        Route::get('/quotes/{quotation}', [PortalController::class, 'quote'])->name('quote');
        Route::post('/quotes/{quotation}/approve', [PortalController::class, 'approve'])->name('quote.approve');
        Route::get('/claims', [PortalController::class, 'claims'])->name('claims');
        Route::get('/claims/new', [PortalController::class, 'newClaim'])->name('claims.new');
        Route::post('/claims', [PortalController::class, 'storeClaim'])->name('claims.store');
        Route::get('/claims/{claim}', [PortalController::class, 'claim'])->name('claim');
        Route::get('/claims/{claim}/file/{i}', [PortalController::class, 'claimFile'])->name('claim.file');
    });
});
