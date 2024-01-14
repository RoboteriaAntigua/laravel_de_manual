<?php

use App\Http\Controllers\nombres;
use App\Models\nombre;
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


Route::get('/create', [nombres::class,'create']);

Route::get('/store',[nombres::class,'store']);

Route::get('/index', [nombres::class, 'index']);


//Para modelos con miles de registros 'chunk' + 'paginate'
Route::get('/chunk', [nombres::class, 'indexChunk']);

