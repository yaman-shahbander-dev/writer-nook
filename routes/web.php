<?php

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

Route::get('/', function () {
    return view('welcome');
});

// for testing stripe confirm payment
$clientSecret = 'seti_1NKlCBH3qVRn63M2Dq41tvQf_secret_O6zAGglgMlaU5qhrsP9IjGYeN9MufFb';
Route::get('/stripe-key', function () use ($clientSecret) {
    return response()->json([
        'publishableKey' => config('payment.stripe.public_key'),
        'clientSecret' => $clientSecret
    ]);
});
Route::get('pay', function () use ($clientSecret) {
    return response()->json([
        'error' => false,
        'requiresAction' => false,
        'clientSecret' => $clientSecret
    ], 200);
});

