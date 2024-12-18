<?php

use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\SolicitudController;
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
    return view('welcome');
});
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
->name('home');

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
->name('register.store');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])
->middleware('guest')
->name('register.index');

Route::post('/registerAdmin', [App\Http\Controllers\RegisterAdminController::class, 'store'])
->name('admin.registerAdminStore');

Route::get('/registerAdmin', [App\Http\Controllers\RegisterAdminController::class, 'create'])
->middleware('guest')
->name('admin.registerAdmin');

Route::get('/login', [App\Http\Controllers\SessionsController::class, 'create'])
->middleware('guest')
->name('login.index');

Route::post('/login', [App\Http\Controllers\SessionsController::class, 'store'])
->name('login.store');

Route::get('/logout', [App\Http\Controllers\SessionsController::class, 'destroy'])
->middleware('auth')
->name('login.destroy');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
->middleware('auth.admin')
->name('admin.index');


Route::get('/entrenador', [App\Http\Controllers\UserController::class, 'index'])
->middleware('auth.user')
->name('user.index');

Route::get('/auth', function () {
    return view('index');
})->middleware('auth.user')
->name('auth.user');

Route::resource('solicitudes', SolicitudController::class, [
    'names' => [
        'index' => 'solicitudes',
        'create' => 'solicitudes.create'
    ]
])->middleware('auth.user');

Route::resource('notificaciones', NotificacionController::class, [
    'names' => [
        'index' => 'notificaciones',
        'store' => 'notificaciones.store'
    ]
])->middleware('auth.user');



Route::get('/cantidades', [App\Http\Controllers\SolicitudController::class, 'getCantidades']);


Route::resource('disciplinas', DisciplinaController::class, [
  'names' => [
    'index' => 'disciplinas'
  ]
])->middleware('auth.user');

Route::post('/disciplinas/store', [App\Http\Controllers\DisciplinaController::class, 'store'])
->name('admin.disciplinas.store');

Route::post('/disciplinas/{disciplinaId}/update', [App\Http\Controllers\DisciplinaController::class, 'update'])
->name('admin.disciplinas.update');

Route::get('/statusnoticia', [App\Http\Controllers\DisciplinaController::class, 'UpdateStatusNoti']);



Route::get('/sectoresaulas', [App\Http\Controllers\SolicitudController::class, 'getAulas']);


//usuarios
Route::get('/usuarios/index', [App\Http\Controllers\UsuariosRController::class, 'index'])
->name('admin.usuarios.index');

Route::get('/usuarios/create', [App\Http\Controllers\UsuariosRController::class, 'create'])
->name('admin.usuarios.create');

Route::post('/usuarios/store', [App\Http\Controllers\UsuariosRController::class, 'store'])
->name('admin.usuarios.store');

Route::delete('/usuarios/{user}', [App\Http\Controllers\UsuariosRController::class, 'destroy'])
->name('admin.usuarios.delete');

Route::get('/usuarios/{user}/edit', [App\Http\Controllers\UsuariosRController::class, 'edit'])
->name('admin.usuarios.edit');

Route::put('/usuarios/{user}', [App\Http\Controllers\UsuariosRController::class, 'update'])
->name('admin.usuarios.update');

//roles
Route::get('/rols/index', [App\Http\Controllers\RoleController::class, 'index'])
->name('admin.rols.index');

Route::post('/rols/store', [App\Http\Controllers\RoleController::class, 'store'])
->name('admin.rols.store');

Route::delete('/rols/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'delete'])
->name('admin.rols.delete');

Route::post('/rols/{roleId}/update', [App\Http\Controllers\RoleController::class, 'update'])
->name('admin.rols.update');

//permisos
Route::group(['middleware' => 'auth'], function() {
Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
});
