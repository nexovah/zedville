<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupermarketController;
Route::get('/', [SupermarketController::class, 'index'])->name('index');
Route::get('/market-list', [SupermarketController::class, 'market_list'])->name('market-list');
Route::get('/{type}', [SupermarketController::class, 'supermarket'])->name('supermarket');