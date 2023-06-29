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
$clientSecret = 'seti_1NONOFH3qVRn63M23HWQb5Hu_secret_OAippmkMyjiZCH6LR2KBFxhPoIqcATJ';
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

