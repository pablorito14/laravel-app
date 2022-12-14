<?php

use App\Http\Controllers\FacturaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ServiciosController;
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

Route::get('/', function () {
    return redirect()->route('facturas.index');
});

Route::resource('facturas',FacturaController::class);
Route::get('facturas/{factura}/pdf',[PDFController::class,'generarPdf'])->name('pdf.factura');

Route::resource('servicios',ServiciosController::class);

Route::get('/test', [HomeController::class, 'index']);