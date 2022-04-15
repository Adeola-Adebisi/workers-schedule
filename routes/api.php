<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Worker;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>['auth:sanctum']], function () {
Route::post('/workers', [WorkerController::class, 'store'])->name('worker.store');
Route::put('/workers', [WorkerController::class, 'update'])->name('worker.update');
Route::delete('/workers', [WorkerController::class, 'destroy'])->name('worker.delete');
Route::post('/logout', [LogoutController::class, 'logout'])->name('worker.logout');
});

//public access

Route::get('/workers', [WorkerController::class, 'index'])->name('worker.index');
Route::get('/shifts', [ShiftController::class, 'index'])->name('worker.index');
Route::post('/register', [RegisterController::class, 'create'])->name('worker.create');
Route::post('/login', [LoginController::class, 'login'])->name('worker.login');
//protected access






/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
Route::get('/workers', function () {
   return Worker::all(); 
});

Route::post('/workers', function (Request $request) {
    

$name = $request->input('name');
request()->validate([
    'name'=>'required'
]);
    return Worker::create([
        'name'=>$name
       
]);
});

Route::put('/workers/{worker}', function (Worker $worker, Request $request) {
    request()->validate([
        'name'=>'required'
    ]);
    $worker->update([
        'name'=>$request->input('name')
    ]);
 });

Route::delete('/workers/{worker}', function (Worker $worker, Request $request) {
$success=$worker->delete();
return[
    'success'=>$success
];
 });
 */