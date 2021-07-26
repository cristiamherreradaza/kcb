<?php

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

// Route::get('home', 'SocialController@inicio')->name('home');


/*Route::get('/home', function () {
    return view('home');
});*/

Route::get('/', 'SocialController@inicio');
// Route::get('/', 'home');

Auth::routes();

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');
Route::get('Panel/inicio', 'PanelController@inicio');

// RED SOCIAL
Route::get('Social/inicio', 'SocialController@inicio');

// USUARIOS
Route::get('User/listado', 'UserController@listado');
Route::get('User/nuevo', 'UserController@nuevo');
Route::post('User/ajaxDistrito', 'UserController@ajaxDistrito');
Route::post('User/ajaxOtb', 'UserController@ajaxOtb');
Route::post('User/guarda', 'UserController@guarda');
Route::get('User/ajax_listado', 'UserController@ajax_listado');
Route::get('User/edita/{id}', 'UserController@edita');
Route::get('User/elimina/{id}', 'UserController@elimina');
Route::get('User/pagos/{user_id}', 'UserController@pagos');
Route::get('User/cambiaPago/{id}/{estado}', 'UserController@cambiaPago');

// RAZAS
Route::get('Raza/listado', 'RazaController@listado');
Route::post('Raza/guarda', 'RazaController@guarda');
Route::get('Raza/elimina/{tipo_id}', 'RazaController@elimina');

// CATEGORIAS PISATAS
Route::get('CategoriasPista/listado', 'CategoriasPistaController@listado');
Route::post('CategoriasPista/guarda', 'CategoriasPistaController@guarda');
Route::get('CategoriasPista/elimina/{tipo_id}', 'CategoriasPistaController@elimina');

// EXAMENES
Route::get('Examen/listado', 'ExamenController@listado');
Route::post('Examen/guarda', 'ExamenController@guarda');
Route::get('Examen/elimina/{tipo_id}', 'ExamenController@elimina');

// GRUPOS
Route::get('Grupo/listado', 'GrupoController@listado');
Route::post('Grupo/guarda', 'GrupoController@guarda');
Route::get('Grupo/elimina/{tipo_id}', 'GrupoController@elimina');

// EVENTOS
Route::get('Evento/listado', 'EventoController@listado');
Route::post('Evento/guarda', 'EventoController@guarda');
Route::get('Evento/elimina/{tipo_id}', 'EventoController@elimina');

// PISTAS
Route::get('Pista/listado', 'PistaController@listado');
Route::post('Pista/guarda', 'PistaController@guarda');
Route::get('Pista/elimina/{tipo_id}', 'PistaController@elimina');

// TIPOS USUARIOS
Route::get('TiposUsuario/listado', 'TiposUsuarioController@listado');
Route::post('TiposUsuario/guarda', 'TiposUsuarioController@guarda');
Route::get('TiposUsuario/elimina/{tipo_id}', 'TiposUsuarioController@elimina');

// TITULOS
Route::get('Titulo/listado', 'TituloController@listado');
Route::post('Titulo/guarda', 'TituloController@guarda');
Route::get('Titulo/elimina/{tipo_id}', 'TituloController@elimina');