<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
})->name('logout');


Route::group(['middleware' => ['auth']], function () {

    /* ********************************************************* */
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
        ],
        function () {
            /* Route::get('/', function () {
                return FacadesView::make('home');
            })->name('home');

            Route::get('test', function () {
                return FacadesView::make('test');
            }); */
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('roles', RoleController::class);
            //Route::resource('types',MenuType::class);

            Route::prefix('workers')->group(function () {
                Route::get('/index', [WorkerController::class, "index"])->name('workers.index');
                Route::get('/create', [WorkerController::class, "create"])->name('workers.create');
                Route::get('/{id}/show', [WorkerController::class, "show"])->name('workers.show');
                Route::post('/store', [WorkerController::class, "store"])->name('workers.store');
                Route::get('/{id}/edit', [WorkerController::class, "edit"])->name('workers.edit');
                Route::post('/update/{id}', [WorkerController::class, "update"])->name('workers.update');
                Route::any('/delete/{id}', [WorkerController::class, "destroy"])->name('workers.destroy');
            });
            Route::prefix('users')->group(function () {
                Route::get('/index', [UserController::class, "index"])->name('users.index');
                Route::get('/create', [UserController::class, "create"])->name('users.create');
                Route::get('/{id}/show', [UserController::class, "show"])->name('users.show');
                Route::post('/store', [UserController::class, "store"])->name('users.store');
                Route::get('/{id}/edit', [UserController::class, "edit"])->name('users.edit');
                Route::post('{id}/update', [UserController::class, "update"])->name('users.update');
                Route::any('/delete/{id}', [UserController::class, "destroy"])->name('users.destroy');
            });
            Route::prefix('rooms')->group(function () {
                Route::get('/index', [RoomController::class, "index"])->name('rooms.index');
                Route::get('/create', [RoomController::class, "create"])->name('rooms.create');
                Route::get('/{id}/show', [RoomController::class, "show"])->name('rooms.show');
                Route::post('/store', [RoomController::class, "store"])->name('rooms.store');
                Route::get('/{id}/edit', [RoomController::class, "edit"])->name('rooms.edit');
                Route::post('{id}/update', [RoomController::class, "update"])->name('rooms.update');
                Route::any('/delete/{id}', [RoomController::class, "destroy"])->name('rooms.destroy');
            });
            Route::prefix('customers')->group(function () {
                Route::get('/index', [CustomerController::class, "index"])->name('customers.index');
                Route::get('/create', [CustomerController::class, "create"])->name('customers.create');
                Route::get('/{id}/show', [CustomerController::class, "show"])->name('customers.show');
                Route::post('/store', [CustomerController::class, "store"])->name('customers.store');
                Route::get('/{id}/edit', [CustomerController::class, "edit"])->name('customers.edit');
                Route::post('{id}/update', [CustomerController::class, "update"])->name('customers.update');
                Route::any('/delete/{id}', [CustomerController::class, "destroy"])->name('customers.destroy');
            });
            Route::prefix('reservations')->group(function () {
                Route::get('/index', [ReservationController::class, "index"])->name('reservations.index');
                Route::get('/create', [ReservationController::class, "create"])->name('reservations.create');
                Route::get('/{id}/show', [ReservationController::class, "show"])->name('reservations.show');
                Route::post('/store', [ReservationController::class, "store"])->name('reservations.store');
                Route::get('/{id}/edit', [ReservationController::class, "edit"])->name('reservations.edit');
                Route::post('{id}/update', [ReservationController::class, "update"])->name('reservations.update');
                Route::any('{id}/delete', [ReservationController::class, "destroy"])->name('reservations.destroy');
                Route::any('{id}/checkout', [ReservationController::class, "checkout"])->name('reservations.checkout');
                Route::any('{id}/bill', [ReservationController::class, "bill"])->name('reservations.bill');
            });
            Route::prefix('menu/categories')->group(function () {
                Route::get('/index', [MenuCategoryController::class, "index"])->name('menu.categories.index');
                Route::get('/create', [MenuCategoryController::class, "create"])->name('menu.categories.create');
                Route::get('/{id}/show', [MenuCategoryController::class, "show"])->name('menu.categories.show');
                Route::post('/store', [MenuCategoryController::class, "store"])->name('menu.categories.store');
                Route::get('/{id}/edit', [MenuCategoryController::class, "edit"])->name('menu.categories.edit');
                Route::post('{id}/update', [MenuCategoryController::class, "update"])->name('menu.categories.update');
                Route::any('{id}/delete', [MenuCategoryController::class, "destroy"])->name('menu.categories.destroy');
            });
            Route::prefix('menu/types')->group(function () {
                Route::get('/index', [MenuTypeController::class, "index"])->name('menu.types.index');
                Route::get('/create', [MenuTypeController::class, "create"])->name('menu.types.create');
                Route::get('/{id}/show', [MenuTypeController::class, "show"])->name('menu.types.show');
                Route::post('/store', [MenuTypeController::class, "store"])->name('menu.types.store');
                Route::get('/{id}/edit', [MenuTypeController::class, "edit"])->name('menu.types.edit');
                Route::post('{id}/update', [MenuTypeController::class, "update"])->name('menu.types.update');
                Route::any('{id}/delete', [MenuTypeController::class, "destroy"])->name('menu.types.destroy');
            });
            Route::prefix('orders')->group(function () {
                Route::get('/index', [OrderController::class, "index"])->name('orders.index');
                Route::get('/create', [OrderController::class, "create"])->name('orders.create');
                Route::get('/{id}/show', [OrderController::class, "show"])->name('orders.show');
                Route::post('/store', [OrderController::class, "store"])->name('orders.store');
                Route::get('/{id}/edit', [OrderController::class, "edit"])->name('orders.edit');
                Route::post('{id}/update', [OrderController::class, "update"])->name('orders.update');
                Route::any('{id}/delete', [OrderController::class, "destroy"])->name('orders.destroy');
            });
            Route::prefix('room/services')->group(function () {
                Route::get('/index', [ServiceController::class, "index"])->name('room.services.index');
                Route::get('/create', [ServiceController::class, "create"])->name('room.services.create');
                Route::get('/{id}/show', [ServiceController::class, "show"])->name('room.services.show');
                Route::post('/store', [ServiceController::class, "store"])->name('room.services.store');
                Route::get('/{id}/edit', [ServiceController::class, "edit"])->name('room.services.edit');
                Route::post('{id}/update', [ServiceController::class, "update"])->name('room.services.update');
                Route::any('{id}/delete', [ServiceController::class, "destroy"])->name('room.services.destroy');
                Route::any('{id}/done', [ServiceController::class, "done"])->name('room.services.done');
            });
            Route::prefix('transactions')->group(function () {
                Route::get('/index', [TransactionController::class, "index"])->name('transactions.index');
                Route::get('/create', [TransactionController::class, "create"])->name('transactions.create');
                Route::get('/{id}/show', [TransactionController::class, "show"])->name('transactions.show');
                Route::post('/store', [TransactionController::class, "store"])->name('transactions.store');
                Route::get('/{id}/edit', [TransactionController::class, "edit"])->name('transactions.edit');
                Route::post('{id}/update', [TransactionController::class, "update"])->name('transactions.update');
                Route::any('{id}/delete', [TransactionController::class, "destroy"])->name('transactions.destroy');
            });
            Route::prefix('reception')->group(function () {
                Route::get('/index', [ReservationController::class, "reception"])->name('reception.index');
                Route::any('{id}/done', [TransactionController::class, "safe"])->name('transactions.done');
            });
        }
    );






    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    /* Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/', function () {
            return FacadesView::make('home');
        })->name('home');

        Route::get('test', function () {
            return FacadesView::make('test');
        });
    }); */
});

