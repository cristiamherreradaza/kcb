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

// Route::get('home', 'SocialController@inicio')->name('home');


// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/', 'SocialController@inicio');

// Route::get('/', 'UserController@listado');
Route::get('/', 'PanelController@inicio');
// Route::get('/', 'EjemplarController@listado');


// Route::get('/', 'PanelController@inicio');
// Route::get('/', 'PanelController@inicio')->name('inicio');
// Route::get('/', 'home');

Auth::routes();

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');

// Route::get('/', 'PanelController@inicio');
Route::get('panel/inicio', 'PanelController@inicio');

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
Route::post('User/ajaxBuscaPropietarioTransferencia', 'UserController@ajaxBuscaPropietarioTransferencia');
Route::post('User/ajaxGuardaNuevoPropietario', 'UserController@ajaxGuardaNuevoPropietario');
Route::post('User/validaCedula', 'UserController@validaCedula');

// MENUS
Route::post('User/ajaxPermisos', 'UserController@ajaxPermisos');
Route::post('User/guardaPermiso', 'UserController@guardaPermiso');
Route::get('User/listaPermisos', 'UserController@listaPermisos');
Route::post('User/ajaxBuscaPermisos', 'UserController@ajaxBuscaPermisos');
Route::post('User/cambiaEstadoMenuPerfil', 'UserController@cambiaEstadoMenuPerfil');
Route::post('User/ajaxPermisosPerfil', 'UserController@ajaxPermisosPerfil');
Route::post('User/guardaPermisoPerfil', 'UserController@guardaPermisoPerfil');


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
Route::get('Evento/formulario/{evento_id}', 'EventoController@formulario');
Route::post('Evento/ajaxBuscaEjemplar', 'EventoController@ajaxBuscaEjemplar');
Route::post('Evento/inscribirEvento', 'EventoController@inscribirEvento');
Route::post('Evento/ajaxBuscaExtranjero', 'EventoController@ajaxBuscaExtranjero');
Route::get('Evento/listadoInscritos/{evento_id}', 'EventoController@listadoInscritos');
Route::post('Evento/editaInscripcionEjemplarEvento', 'EventoController@editaInscripcionEjemplarEvento');
Route::get('Evento/eliminaInscripcion/{inscripcion_id}', 'EventoController@eliminaInscripcion');
Route::get('Evento/catalogo/{evento_id}', 'EventoController@catalogo');
Route::get('Evento/catalogoNumeracion/{evento_id}', 'EventoController@catalogoNumeracion');
Route::post('Evento/ajaxBuscaCategoria', 'EventoController@ajaxBuscaCategoria');
Route::get('Evento/generaBestingPdf/{evento}/{tipo}', 'EventoController@generaBestingPdf');
Route::post('Evento/inscribirEjemplar', 'EventoController@inscribirEjemplar');
Route::post('Evento/buscaExtranjero', 'EventoController@buscaExtranjero');



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
Route::post('Criadero/ajaxBuscaCriaderoPropietario', 'CriaderoController@ajaxBuscaCriaderoPropietario');
Route::post('Criadero/guardaCriaderoPropietario', 'CriaderoController@guardaCriaderoPropietario');
Route::post('Criadero/guardaCriaderoNuevoPropietario', 'CriaderoController@guardaCriaderoNuevoPropietario');


// EJEMPLARES
Route::get('Ejemplar/formulario/{id}', 'EjemplarController@formulario');
Route::post('Ejemplar/ajaxBuscaEjemplar', 'EjemplarController@ajaxBuscaEjemplar');
Route::get('Ejemplar/listado', 'EjemplarController@listado');
Route::post('Ejemplar/ajaxListado', 'EjemplarController@ajaxListado');
Route::get('Ejemplar/listadoExtranjero', 'EjemplarController@listadoExtranjero');
Route::post('Ejemplar/ajaxListadoExtranjero', 'EjemplarController@ajaxListadoExtranjero');
Route::post('Ejemplar/guarda', 'EjemplarController@guarda');
Route::post('Ejemplar/ajaxGuardaExamen', 'EjemplarController@ajaxGuardaExamen');
Route::post('Ejemplar/ajaxEliminaExamen', 'EjemplarController@ajaxEliminaExamen');
Route::post('Ejemplar/ajaxGuardaTransferencia', 'EjemplarController@ajaxGuardaTransferencia');
Route::post('Ejemplar/ajaxEliminaTransferencia', 'EjemplarController@ajaxEliminaTransferencia');
Route::post('Ejemplar/ajaxGuardaTitulo', 'EjemplarController@ajaxGuardaTitulo');
Route::post('Ejemplar/ajaxEliminaTitulo', 'EjemplarController@ajaxEliminaTitulo');
Route::get('Ejemplar/informacion/{ejamplarId}', 'EjemplarController@informacion');
Route::get('Ejemplar/formularioCamada', 'EjemplarController@formularioCamada');
Route::post('Ejemplar/guardaCamada', 'EjemplarController@guardaCamada');
Route::get('Ejemplar/listadoCamada/{camada_id}', 'EjemplarController@listadoCamada');
Route::get('Ejemplar/eliminaEjemplarCamada/{ejemplar_id}', 'EjemplarController@eliminaEjemplarCamada');
Route::get('Ejemplar/guardaEjemplarCamada/{camada_id}/{ejemplar_id}', 'EjemplarController@guardaEjemplarCamada');
Route::post('Ejemplar/guardaEjemplarEdita', 'EjemplarController@guardaEjemplarEdita');
Route::post('Ejemplar/ajaxBuscaEjemplarEdita', 'EjemplarController@ajaxBuscaEjemplarEdita');
Route::get('Ejemplar/generaExcelPedigree/{ejemplarId}', 'EjemplarController@generaExcelPedigree');
Route::post('Ejemplar/ajaxGuardaEjemplar', 'EjemplarController@ajaxGuardaEjemplar');
Route::post('Ejemplar/registroNuevoEjemplarCamada', 'EjemplarController@registroNuevoEjemplarCamada');
Route::get('Ejemplar/demoModificacion', 'EjemplarController@demoModificacion');
Route::get('Ejemplar/muestraModificacion/{tabla}/{registro}', 'EjemplarController@muestraModificacion');
Route::post('Ejemplar/validaKcb', 'EjemplarController@validaKcb');
Route::get('Ejemplar/eliminaEjemplar/{ejemplar_id}', 'EjemplarController@eliminaEjemplar');
Route::get('Ejemplar/generaPdf', 'EjemplarController@generaPdf');
Route::get('Ejemplar/certificadoRosado/{ejemplar_id}', 'EjemplarController@certificadoRosado');
Route::get('Ejemplar/certificadoRosadoAdelante/{ejemplar_id}', 'EjemplarController@certificadoRosadoAdelante');
Route::get('Ejemplar/certificadoExportacion/{ejemplar_id}', 'EjemplarController@certificadoExportacion');
Route::get('Ejemplar/bitacora', 'EjemplarController@bitacora');
Route::get('Ejemplar/listaCamadasPadres/{ejemplar_id}/{padre}', 'EjemplarController@listaCamadasPadres');
Route::get('Ejemplar/generaExcel', 'EjemplarController@generaExcel');


// ALQUILERES
Route::get('Alquiler/listado', 'AlquilerController@listado');

// MENUS
Route::get('User/listado', 'UserController@listado');


// REPORTES
Route::get('Reporte/ejemplarporraza', 'ReporteController@ejemplarporRaza');
Route::post('Reporte/ejemplarporrazaPdf', 'ReporteController@ejemplarporRazaPdf');


//JUECES
Route::get('Juez/listado', 'JuezController@listado');
Route::post('Juez/guarda', 'JuezController@guarda');
Route::get('Juez/elimina/{juez_id}', 'JuezController@elimina');
Route::post('Juez/ajaxguardaAsignacionEvento', 'JuezController@ajaxguardaAsignacionEvento');
Route::post('Juez/ajaxListadoAsignacion', 'JuezController@ajaxListadoAsignacion');
Route::post('Juez/ajaxEliminaAsignacion', 'JuezController@ajaxEliminaAsignacion');
Route::get('Juez/calificacion', 'JuezController@calificacion');
// Route::get('Juez/grupos/{evento_id}', 'JuezController@grupos');
// Route::get('Juez/categorias/{evento_id}', 'JuezController@categorias');
Route::get('Juez/categorias/{evento_id}/{asignacion_id}', 'JuezController@categorias');
Route::get('Juez/razas/{evento_id}/{grupo_id}', 'JuezController@razas');
Route::get('Juez/ponderacion/{evento_id}/{grupo_id}/{raza_id}', 'JuezController@ponderacion');
Route::post('Juez/guardaPonderacion', 'JuezController@guardaPonderacion');
Route::get('Juez/planilla/{evento_id}/{grupo_id}/{raza_id}', 'JuezController@planilla');
Route::post('Juez/AjaxPlanillaCalificacion', 'JuezController@AjaxPlanillaCalificacion');
Route::post('Juez/AjaxEjemplarCatalogoRaza', 'JuezController@AjaxEjemplarCatalogoRaza');
Route::post('Juez/ajaxFinalizarCalificacion', 'JuezController@ajaxFinalizarCalificacion');
// Route::post('Juez/ajaxGanadores', 'JuezController@ajaxGanadores');
Route::post('Juez/ajaxCategoriasCalificacion', 'JuezController@ajaxCategoriasCalificacion');
Route::post('Juez/ajaxCalificacionMejor', 'JuezController@ajaxCalificacionMejor');
Route::post('Juez/ajaxPlanilla', 'JuezController@ajaxPlanilla');
Route::post('Juez/ajaxGanadores', 'JuezController@ajaxGanadores');
Route::post('Juez/mejorVencedores', 'JuezController@mejorVencedores');
Route::post('Juez/mejorRazaFinPlanilla', 'JuezController@mejorRazaFinPlanilla');
Route::post('Juez/bestingGanadores', 'JuezController@bestingGanadores');
Route::post('Juez/calificabesting', 'JuezController@calificabesting');
Route::post('Juez/calificaFinales', 'JuezController@calificaFinales');
Route::post('Juez/cambiaMejorRecerva', 'JuezController@cambiaMejorRecerva');
Route::get('Juez/planillaPDF/{evento_id}/{pista}', 'JuezController@planillaPDF');
Route::get('Juez/bestingPDF/{evento_id}/{pista}', 'JuezController@bestingPDF');


// ---------- MIGRACIONES ----------
Route::get('Migracion/razas', 'MigracionController@razas');
/* Migracion de Propietarios */
Route::get('Migracion/propietarios_1', 'MigracionController@propietarios');
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


/* Migracion de CATEGORIAS PISTAS */
Route::get('Migracion/categorias_pistas', 'MigracionController@categorias_pistas');

/* Migracion de EVENTOS */
Route::get('Migracion/eventos', 'MigracionController@eventos');

// corriccion de fecha de ejemplares 
 Route::get('Migracion/corregirFechaEjemplares', 'MigracionController@corregirFechaEjemplares');

 /* Migracion de EVENTOS INSCRIUTOS MASCOTAS TEMPORALES */
Route::get('Migracion/ejmplares_ventos', 'MigracionController@ejmplares_ventos');


 /* REGULARIZACION DE TRAMSFERENCIAS */
 Route::get('Migracion/regularizacionTramsferencias', 'MigracionController@regularizacionTramsferencias');
