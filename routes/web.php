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

// Route::get('/', 'SocialController@inicio');
Route::get('/', 'UserController@listado');
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
Route::get('User/formulario/{id}', 'UserController@formulario');
Route::post('User/validaEmail', 'UserController@validaEmail');
Route::post('User/ajaxBuscaPropietario', 'UserController@ajaxBuscaPropietario');

//PROPIETARIOS
Route::get('User/listadoPropietario', 'UserController@listadoPropietario');
Route::get('User/formularioPropietario/{id}', 'UserController@formularioPropietario');
Route::post('User/guardaPropietario', 'UserController@guardaPropietario');
Route::get('User/eliminaPropietario/{id}', 'UserController@eliminaPropietario');
Route::get('User/listadoCriadero/{propietario_id}', 'UserController@listadoCriadero');
Route::post('User/ajaxListadoPropietarios', 'UserController@ajaxListadoPropietarios');

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
Route::get('Grupo/listadoGrupoRaza/{grupo_id}', 'GrupoController@listadoGrupoRaza');
Route::post('Grupo/agregarRaza', 'GrupoController@agregarRaza');
Route::get('Grupo/eliminaGrupoRaza/{raza_id}/{grupo_id}', 'GrupoController@eliminaGrupoRaza');


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

// SUCURSAL
Route::get('Sucursal/listado', 'SucursalController@listado');
Route::post('Sucursal/guarda', 'SucursalController@guarda');
Route::get('Sucursal/elimina/{tipo_id}', 'SucursalController@elimina');

// PERFILES
Route::get('Perfil/listado', 'PerfilController@listado');
Route::post('Perfil/guarda', 'PerfilController@guarda');
Route::get('Perfil/elimina/{tipo_id}', 'PerfilController@elimina');

// CRIADEROS
Route::get('Criadero/listado', 'CriaderoController@listado');
Route::post('Criadero/guarda', 'CriaderoController@guarda');
Route::get('Criadero/elimina/{id}', 'CriaderoController@elimina');
Route::get('Criadero/formulario/{id}', 'CriaderoController@formulario');
Route::post('Criadero/ajaxListadoCriadero', 'CriaderoController@ajaxListadoCriadero');
Route::post('Criadero/ajaxBuscaCriadero', 'CriaderoController@ajaxBuscaCriadero');

// EJEMPLARES
Route::get('Ejemplar/formulario/{id}', 'EjemplarController@formulario');
Route::post('Ejemplar/ajaxBuscaEjemplar', 'EjemplarController@ajaxBuscaEjemplar');
Route::get('Ejemplar/listado', 'EjemplarController@listado');
Route::post('Ejemplar/ajaxListado', 'EjemplarController@ajaxListado');
Route::post('Ejemplar/guarda', 'EjemplarController@guarda');
Route::post('Ejemplar/ajaxGuardaExamen', 'EjemplarController@ajaxGuardaExamen');
Route::post('Ejemplar/ajaxEliminaExamen', 'EjemplarController@ajaxEliminaExamen');
Route::post('Ejemplar/ajaxGuardaTransferencia', 'EjemplarController@ajaxGuardaTransferencia');
Route::post('Ejemplar/ajaxEliminaTransferencia', 'EjemplarController@ajaxEliminaTransferencia');
Route::post('Ejemplar/ajaxGuardaTitulo', 'EjemplarController@ajaxGuardaTitulo');
Route::post('Ejemplar/ajaxEliminaTitulo', 'EjemplarController@ajaxEliminaTitulo');
Route::get('Ejemplar/informacion/{ejamplarId}', 'EjemplarController@informacion');



// ---------- MIGRACIONES ----------
Route::get('Migracion/razas', 'MigracionController@razas');
/* Migracion de Propietarios */
Route::get('Migracion/propietarios', 'MigracionController@propietarios');
/* Migracion de Criaderos */
Route::get('Migracion/criaderos', 'MigracionController@criaderos');
/* Migracion de Criaderos */
Route::get('Migracion/propietarioCriadero', 'MigracionController@propietarioCriadero');

// ejmplares primera etapa
Route::get('Migracion/mascotas', 'MigracionController@mascotas');

/* Migracion de GRUPOS */
Route::get('Migracion/grupos', 'MigracionController@grupos');

/* Migracion de GRUPOS_RAZAS */
Route::get('Migracion/grupos_razas', 'MigracionController@grupos_razas');

/* Migracion de TITULOS */
Route::get('Migracion/titulos', 'MigracionController@titulos');

/* Migracion de EXAMENES */
Route::get('Migracion/examenes', 'MigracionController@examenes');

/* Migracion de EXAMENES_MASCOTAS */
Route::get('Migracion/examenes_mascotas', 'MigracionController@examenes_mascotas');


/* Migracion de CAMADAS */
Route::get('Migracion/camadas', 'MigracionController@camadas');

/* Migracion de PADRES MADRES EJEMPLARES */
Route::get('Migracion/padres_madres', 'MigracionController@padres_madres');

/* Migracion de TRAMSFERENCIA */
Route::get('Migracion/tramsferencia', 'MigracionController@tramsferencia');


/* Migracion de MASCOTAS TITULOS */
Route::get('Migracion/mascotas_titulos', 'MigracionController@mascotas_titulos');