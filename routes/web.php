<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MountainAbleController;
use App\Http\Controllers\MountainController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Models\Mountain;
use App\Models\Reservation;

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


// Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [LandingController::class, 'index']);
Route::get('/mountaindetails/{id}', [LandingController::class, 'show']);
// Route::get('/mountaindetails/{id}/create', [ReservationController::class, 'create'])->name('rsv.create')->middleware('auth');

Route::get('/news', [LandingController::class, 'regulation']);
Route::get('/news/{id}', [LandingController::class, 'showregulation']);


// ADMIN
// Route::get('admin/home', [HomeController::class, 'handleAdmin'])->middleware('admin')->name('admin.route');
Route::get('admin/home', [HomeController::class, 'handleAdmin'])->middleware('admin')->name('admin.route');
Route::get('/chart-data', [HomeController::class, 'getData']);

Route::get('/chart', [ChartController::class, 'showChart']);
// Route::get('/your-route', [HomeController::class, 'yourMethod'])->name('your.route');
// Route::get('/load-chart-data', [HomeController::class, 'loadChartData'])->name('load.chart.data');




Route::resource('/addmountains', MountainController::class)->middleware('admin');
// Route::get('/addmountains', [MountainController::class, 'index'])->middleware('admin');;


Route::resource('/mountainables', MountainAbleController::class)->middleware('admin');

Route::get('changeStatus', 'MountainController@changeStatus')->middleware('admin');

Route::resource('/regulations', RegulationController::class)->middleware('admin');

Route::get('/payments', [PaymentController::class, 'index'])->middleware('admin')->name('admin.listpay');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->middleware('admin')->name('admin.edit');
Route::put('/payments/{id}/edit', [PaymentController::class, 'update'])->middleware('admin')->name('admin.updatepayment');

Route::get('/group/{groupId}/members', [ReservationController::class, 'showGroupMembers'])->name('rsv.members')->middleware('admin');

Route::get('/users', [RoleController::class, 'index'])->middleware('auth')->name('admin.user');
Route::get('/users/{id}/edit', [RoleController::class, 'edit'])->middleware('admin')->name('admin.edituser');
Route::put('/users/{id}/edit', [RoleController::class, 'update'])->middleware('admin')->name('admin.updateuser');



// USER 
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Route::get('/mountaindetails/{id}/group', [ReservationController::class, 'groupcreate'])->name('rsv.group')->middleware('auth');
// Route::post('/mountaindetails/{id}/group', [ReservationController::class, 'storegroup'])->name('rsv.groupstore')->middleware('auth');

Route::get('/detailgunung/{id}/grup', [ReservationController::class, 'groupcreate'])->name('rsv.group')->middleware('auth');
// Route::post('/mountaindetails/{id}/group/{id_mtnable}', [ReservationController::class, 'storegroup'])->name('rsv.groupstore')->middleware('auth');
Route::post('/mountaindetails/{id_mtnable}/storegroup', [ReservationController::class, 'storegroup'])->name('rsv.groupstore')->middleware('auth');



// Route::get('/mountaindetails/{id}/group/{group}/create', [ReservationController::class, 'create'])->name('rsv.create')->middleware('auth');
// Route::post('/mountaindetails/{id}/group/{group}/create', [ReservationController::class, 'store'])->name('rsv.store')->middleware('auth');
Route::get('/groups/{group}/mountaindetail/{id}/create', [ReservationController::class, 'create'])->name('rsv.create')->middleware('auth');
Route::post('/mountaindetails/{id}/group/{group}/create', [ReservationController::class, 'store'])->name('rsv.store')->middleware('auth');
Route::get('/mountaindetails/{id}/group/{group}', [ReservationController::class, 'show'])->name('rsv.show')->middleware('auth');
Route::delete('/mountaindetails/{id}/group/{group}', [ReservationController::class, 'destroy'])->name('rsv.destroy')->middleware('auth');

Route::get('/reservations', [ReservationController::class, 'index'])->name('rsv.index')->middleware('auth');







Route::get('/climbers', [ReservationController::class, 'climb'])->name('rsv.climb')->middleware('auth');
Route::get('/climbers/{id}/edit', [ReservationController::class, 'climedit'])->name('rsv.climbedit')->middleware('auth');
Route::put('/climbers/{id}', [ReservationController::class, 'climupdate'])->name('rsv.climbupdate')->middleware('auth');



Route::get('/mountaindetails/{id}/group/{group}/pay', [PaymentController::class, 'create'])->name('pay.create')->middleware('auth');
Route::post('/mountaindetails/{id}/group/{group}/pay', [PaymentController::class, 'store'])->name('pay.store')->middleware('auth');
Route::get('/payments/{id}/group/{group}', [PaymentController::class, 'show'])->name('pay.show')->middleware('auth');



// Route::resource('/reservations', ReservationController::class)->middleware('auth');