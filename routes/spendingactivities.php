<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpendingActivitiesController;
//Route::get('/', [SupermarketController::class, 'index'])->name('index');
Route::get('/market-list', [SpendingActivitiesController::class, 'market_list'])->name('market-list');
Route::get('/{type}', [SpendingActivitiesController::class, 'supermarket'])->name('supermarket');
Route::get('/spending-tracker/{type}', [SpendingActivitiesController::class, 'spending_tracker'])->name('spending-tracker');