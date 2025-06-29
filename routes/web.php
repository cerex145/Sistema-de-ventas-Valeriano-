<?php

use App\Http\Controllers\UtilityController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------- 
| Web Routes
|--------------------------------------------------------------------------- 
| Aquí puedes registrar las rutas web para tu aplicación. Estas rutas son
| cargadas por el RouteServiceProvider y todas ellas serán asignadas al
| grupo de middleware "web". ¡Haz algo genial!
|
*/

// Ruta para la instalación
Route::get('/', function () {
    app(InstallController::class)->install();
    return redirect( url('admin/') );
});

// Ruta para la instalación (también accesible directamente)
Route::get('/install',  [InstallController::class, 'install']);

// Ruta para imprimir, usa UtilityController
Route::get('/print/{id}',  [UtilityController::class, 'print']);

// Redirección de la ruta de login
Route::get('/login',  function(){
    return redirect( url('/admin') );
})->name('login');

// Ruta para limpiar cachés
Route::get('/clear',  function(){
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});

// Rutas para manejar órdenes, usando OrderController
Route::resource('orders', OrderController::class);  // Esto crea todas las rutas necesarias para OrderController

// Ruta personalizada para la creación de órdenes, si necesitas hacer algo adicional
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
