<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\ScreenAuditControler::class, 'index'])->name('audits.index');

Route::get('/create', [App\Http\Controllers\ScreenAuditControler::class, 'create'])->name('audits.create');

Route::post('/store', [App\Http\Controllers\ScreenAuditControler::class, 'store'])->name('audits.store');

Route::post('/confirm-payment/{screenAudit}', [App\Http\Controllers\ScreenAuditControler::class, 'confirmPayment'])->name('audits.confirm_payment');
