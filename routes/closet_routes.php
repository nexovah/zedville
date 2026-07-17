<?php

// ============================================================
// ZEDVILLE — CLOSET — Laravel Routes
// File: routes/closet_routes.php
//
// HOW TO INTEGRATE:
//   Add this line inside routes/web.php:
//
//     require __DIR__ . '/closet_routes.php';
//
//   Or copy these lines directly into routes/web.php.
// ============================================================

use App\Http\Controllers\ClosetController;
use Illuminate\Support\Facades\Route;
// Closet page
Route::get('/', function () {
    return view('closet.index');
});

Route::middleware('auth')->group(function () {

    // ── Student: own closet ──────────────────────────────────
    Route::get('/mine',                [ClosetController::class, 'mine']);

    // ── Tutor / Admin: view any student's closet ─────────────
    Route::get('/student/{studentId}', [ClosetController::class, 'studentCloset']);

    // ── Catalog: read (all roles) ────────────────────────────
    Route::get('/catalog',             [ClosetController::class, 'catalog']);

    // ── Catalog: write (admin only) ──────────────────────────
    Route::post('/catalog',            [ClosetController::class, 'catalogStore']);
    Route::put('/catalog/{id}',        [ClosetController::class, 'catalogUpdate']);
});
