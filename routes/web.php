<?php

use App\Http\Controllers\Dictamen_finca_antigua;
use Illuminate\Support\Facades\Route;
use app\Mail\contactoCapacitacion;
use Illuminate\Support\Facades\Mail;


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


/**
 * -----------------------------------------------------------
 * Rutas de cuenta
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con inicio de sesión
 * crear cuenta, recuperar contraseña, etc
 */

Route::get('/', 'cuenta@index');
Route::get('cuenta', 'cuenta@login')->middleware('cuenta');
Route::get('cuenta/registrof', 'cuenta@registrof');
Route::post('cuenta/registrarf', 'cuenta@registrarf');
Route::get('cuenta/registrom', 'cuenta@registrom');
Route::post('cuenta/registrarm', 'cuenta@registrarm');
Route::get('cuenta/recupera', 'cuenta@recupera');
Route::post('cuenta/recuperar', 'cuenta@recuperar');
Route::get('cuenta/cambiac/{correo}/{token}', 'cuenta@cambiac');
Route::post('cuenta/cambiarc', 'cuenta@cambiarc');
Route::post('cuenta/auth', 'cuenta@auth');
Route::get('cuenta/activar/{correo}/{token}', 'cuenta@activar');
Route::get('cuenta/logout', 'cuenta@logout');
Route::post('cuenta/cambiar_contrasena', 'cuenta@cambiar_contrasena');
Route::get('cuenta/preguntas_respuestas', 'cuenta@preguntas_respuestas');


/**
 * --------------- Fin rutas cuentas -------------------------
 */

/**
 * -----------------------------------------------------------
 * Rutas de ciudadano
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el ciudadano,
 * trámites, expedientes, etc.
 */

Route::get('ciudadano/expediente', 'ciudadano@expediente')->middleware('ciudadano');
Route::get('ciudadano/tramites', 'ciudadano@tramites')->middleware('ciudadano');
Route::get('ciudadano/nuevo_tramite', 'ciudadano@nuevo')->middleware('ciudadano');
Route::get('ciudadano/dashboard', 'ciudadano@perfil')->middleware('ciudadano');
Route::get('ciudadano/predios', 'predios@index')->middleware('ciudadano');
Route::get('ciudadano/descanso', 'ciudadano@descanso')->middleware('ciudadano');
Route::get('ciudadano/notificaciones', 'ciudadano@notificaciones')->middleware('ciudadano');
Route::post('ciudadano/post', 'ciudadano@post')->middleware('ciudadano');
Route::post('ciudadano/perfil', 'ciudadano@perfil');
Route::get('predio/form/{action}/{id?}', 'predios@form')->middleware('ciudadano');
Route::get('correo/notificacion', 'ciudadano@notificacion');
Route::post('ciudadano/get_by_name', 'ciudadano@get_by_name');
Route::post('ciudadano/post_file', 'ciudadano@post_file')->middleware('ciudadano');
Route::post('ciudadano/delete_file', 'ciudadano@delete_file')->middleware('ciudadano');
Route::get('ciudadano/citas_linea', 'ciudadano@citas')->middleware('ciudadano');
Route::post('ciudadano/calificar', 'ciudadano@calificar')->middleware('ciudadano');
Route::get('ciudadano/pagos_linea', 'ciudadano@pagos')->middleware('ciudadano');
Route::get('ciudadano/padron_licencias', 'ciudadano@padron_licencias')->middleware('ciudadano');
Route::get('ciudadano/obras_publicas', 'ciudadano@obras_publicas')->middleware('ciudadano');
Route::get('ciudadano/catastro', 'ciudadano@catastro')->middleware('ciudadano');
Route::get('ciudadano/ordenamiento_territorio', 'ciudadano@ordenamiento_territorio')->middleware('ciudadano');
route::get('ciudadano/expediente_unico_municipal', 'ciudadano@expediente_unico_municipal')->middleware('ciudadano');
Route::get('ciudadano/medio_ambiente', 'ciudadano@medio_ambiente')->middleware('ciudadano');


/**
 * --------------- Fin rutas ciudadanos -------------------------
 */


/**
 * -----------------------------------------------------------
 * Rutas de acreditación
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de Acreditación de movilidad
 *
 */

Route::get('acreditaciones/solicitud', 'acreditaciones@solicitud')->middleware('ciudadano');
Route::post('acreditaciones/get_acreditaciones_previas', 'acreditaciones@get_acreditaciones_previas')->middleware('ciudadano');
Route::post('acreditaciones/ingresa_solicitud', 'acreditaciones@ingresa_solicitud')->middleware('ciudadano');
Route::post('acreditaciones/actualiza_solicitud', 'acreditaciones@actualiza_solicitud')->middleware('ciudadano');
Route::post('acreditaciones/consulta_requisitos', 'acreditaciones@consulta_requisitos')->middleware('ciudadano');
Route::post('acreditaciones/ingresa_tramite', 'acreditaciones@ingresa_tramite')->middleware('ciudadano');
Route::get('acreditaciones/acreditacion_movilidad/{id_solicitud}', 'acreditaciones@acreditacion_movilidad')->name('acreditacion_movilidad');
/**
 * --------------- Fin rutas Trabajos menores -------------------------
 */


/**
 * -----------------------------------------------------------
 * Rutas de Trabajos menores
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de Trabajos
 * menores
 */

Route::get('trabajos_menores/solicitud', 'trabajos_menores@solicitud')->middleware('ciudadano');
Route::post('trabajos_menores/upload', 'trabajos_menores@upload')->middleware('ciudadano');
Route::post('trabajos_menores/ingresa_solitud', 'trabajos_menores@ingresa_solitud')->middleware('ciudadano');
Route::post('trabajos_menores/ingresa_tramite', 'trabajos_menores@ingresa_tramite')->middleware('ciudadano');
Route::post('trabajos_menores/actualiza_solitud', 'trabajos_menores@actualiza_solitud')->middleware('ciudadano');
Route::get('trabajos_menores/carta/{fecha}/{id_captura}', 'trabajos_menores@carta');


/**
 * -----------------------------------------------------------
 * Rutas de Licencia de contruccion
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de Trabajos
 * menores
 */

Route::get('licencia_construccion/solicitud', 'licencia_construccion@solicitud')->middleware('ciudadano');
Route::post('licencia_construccion/upload', 'licencia_construccion@upload')->middleware('ciudadano');
Route::post('licencia_construccion/ingresa_solitud', 'licencia_construccion@ingresa_solitud')->middleware('ciudadano');
Route::post('licencia_construccion/ingresa_tramite', 'licencia_construccion@ingresa_tramite')->middleware('ciudadano');
Route::post('licencia_construccion/actualiza_solitud', 'licencia_construccion@actualiza_solitud')->middleware('ciudadano');
Route::get('licencia_construccion/carta/{fecha}/{id_captura}', 'licencia_construccion@carta');



/**
 * --------------- Fin rutas Trabajos menores -------------------------
 */

/**
 * -----------------------------------------------------------
 * Rutas de Certificado de Alineamiento y No. Oficial
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de
 * Certificado de Alineamiento y No. Oficial
 */

Route::get('alineamiento_num_oficial/solicitud', 'alineamiento_num_oficial@solicitud')->middleware('ciudadano');
Route::post('alineamiento_num_oficial/upload', 'alineamiento_num_oficial@upload')->middleware('ciudadano');
Route::post('alineamiento_num_oficial/ingresa_solicitud', 'alineamiento_num_oficial@ingresa_solicitud')->middleware('ciudadano');
Route::post('alineamiento_num_oficial/ingresa_tramite', 'alineamiento_num_oficial@ingresa_tramite')->middleware('ciudadano');
Route::post('alineamiento_num_oficial/actualiza_solitud', 'alineamiento_num_oficial@actualiza_solitud')->middleware('ciudadano');
Route::get('alineamiento_num_oficial/carta/{fecha}/{id_captura}', 'alineamiento_num_oficial@carta');
Route::get('alineamiento_num_oficial/solicitud_multitramite/{id_solicitud}', 'alineamiento_num_oficial@solicitud_multitramite')->name('solicitud_multitramite');
Route::get('alineamiento_num_oficial/solicitud_multi', 'alineamiento_num_oficial@solicitud_multi');

/**
 * ----- Fin rutas Certificado de Alineamiento y No. Oficial -----
 */


/**
 * -----------------------------------------------------------
 * Rutas de Revisión de Proyecto en Línea
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de revisión de proyecto
 * en línea de obra pública
 */

Route::get('revision_proyecto/solicitud', 'revision_proyecto@solicitud')->middleware('ciudadano');
Route::post('revision_proyecto/upload', 'revision_proyecto@upload')->middleware('ciudadano');
Route::post('revision_proyecto/ingresa_solitud', 'revision_proyecto@ingresa_solitud')->middleware('ciudadano');
Route::post('revision_proyecto/ingresa_tramite', 'revision_proyecto@ingresa_tramite')->middleware('ciudadano');
Route::post('revision_proyecto/actualiza_solitud', 'revision_proyecto@actualiza_solitud')->middleware('ciudadano');
Route::get('revision_proyecto/carta/{fecha}/{id_captura}', 'revision_proyecto@carta');


/**
 * --------------- Fin rutas revisión proyecto en línea -------------------------
 */



/**
 * -----------------------------------------------------------
 * Rutas de revisor
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con los usuarios revisor
 */

Route::get('revisor/solicitudes', 'revisor@solicitudes')->middleware('revisor');
Route::get('revisor/reportes', 'revisor@reportes')->middleware('revisor');
Route::get('revisor/configuracion', 'revisor@configuracion')->middleware('revisor');
Route::post('revisor/detalle', 'revisor@detalle')->middleware('revisor');
Route::get('revisor/notificaciones', 'revisor@notificaciones')->middleware('revisor');
Route::get('revisor/form/{accion}/{id_usuario?}', 'revisor@form');
Route::post('revisor/post', 'revisor@post');
Route::post('revisor/put', 'revisor@put');

/**
 * --------------- Fin rutas revisor -------------------------
 */

/**
 * -----------------------------------------------------------
 * Rutas de Dias inhabiles
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con los usuarios revisor
 */


Route::get('dias_inhabiles/form/{accion}/{id_usuario?}', 'dias_inhabiles@form');
Route::post('dias_inhabiles/post', 'dias_inhabiles@post');
Route::post('dias_inhabiles/put', 'dias_inhabiles@put');
Route::post('dias_inhabiles/remove', 'dias_inhabiles@remove');

/**
 * --------------- Fin rutas dias inhabiles -------------------------
 */

/**
 * -----------------------------------------------------------
 * Administrador
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con los usuarios
 *  administrador
 */

Route::get('administrador/ciudadanos', 'administrador@ciudadanos')->middleware('administrador');
Route::get('administrador/detalle/{id_usuario}', 'administrador@detalle')->middleware('administrador');
Route::get('administrador/predios', 'administrador@predios')->middleware('administrador');
Route::get('administrador/reportes', 'administrador@reportes')->middleware('administrador');
Route::get('administrador/revisores', 'administrador@revisores')->middleware('administrador');
Route::get('administrador/dias_inhabiles', 'administrador@dias_inhabiles')->middleware('administrador');

/**
 * --------------- Fin rutas Administrador -------------------------
 */

/**
 * -----------------------------------------------------------
 * Catastro
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con
 * catastro
 *
 */

Route::post('catastro/get_by_cuenta', 'catastro@get_by_cuenta');
Route::post('catastro/get_by_curt', 'catastro@get_by_curt');
Route::post('catastro/get_adeudo_cuenta', 'catastro@get_adeudo_cuenta');

/**
 * --------------- Fin rutas Catastro -------------------------
 */


/**
 * -----------------------------------------------------------
 * Solicitudes
 * -----------------------------------------------------------
 *
 * Mostrar las solicitudes pendientes
 */
Route::get('solicitudes/consulta_solicitudes/{id_solicitud}', 'solicitudes@consulta_solicitudes')->middleware('ciudadano');
Route::post('solicitud/deleted', 'solicitudes@deleted');
Route::post('solicitud/rechazar', 'solicitudes@rechazar');
Route::post('solicitud/regresar', 'solicitudes@regresar');
Route::post('solicitud/continuar', 'solicitudes@continuar');
Route::post('solicitud/get_all', 'solicitudes@get_all');
Route::post('solicitud/detalles', 'solicitudes@detalles');

/**
 * --------------- Fin rutas Solicitudes -------------------------
 */

/**
 * -----------------------------------------------------------
 * Prediales
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::post('predios/post', 'predios@post');
Route::post('predios/get_all_users', 'predios@get_all_users');
Route::post('predios/deleted', 'predios@deleted');
Route::post('predios/get_all', 'predios@get_all');

/**
 * --------------- Fin rutas prediales -------------------------
 */


/**
 * -----------------------------------------------------------
 * Notificaciones
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::post('notificaciones/visto', 'notificaciones@visto');
Route::post('notificaciones/eliminar', 'notificaciones@eliminar');

/**
 * --------------- Fin rutas notificaciones -------------------------
 */


/**
 * -----------------------------------------------------------
 * Graficas
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::post('graficas/solicitudes_estatus', 'graficas@solicitudes_estatus');
Route::post('graficas/solicitudes_revisor', 'graficas@solicitudes_revisor');

/**
 * --------------- Fin rutas graficas -------------------------
 */

/**
 * -----------------------------------------------------------
 * Prelicencias
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::get('prelicencias/solicitud', 'prelicencias@solicitud')->middleware('ciudadano');
Route::get('prelicencias/get_requisitos', 'prelicencias@get_requisitos');
Route::get('prelicencias/requisitos/{giro}', 'prelicencias@requisitos');
Route::post('prelicencias/ingresa_solicitud', 'prelicencias@ingresa_solicitud')->middleware('ciudadano');
Route::post('prelicencias/rechazar', 'prelicencias@rechazar')->middleware('revisor');
Route::post('prelicencias/condicionar', 'prelicencias@condicionar')->middleware('revisor');
Route::post('prelicencias/autorizar', 'prelicencias@autorizar')->middleware('revisor');
Route::get('prelicencias/reenviar/{id_solicitud}', 'prelicencias@reenviar')->middleware('revisor');


/**
 * --------------- Fin rutas Prelicencias -------------------------
 */

/**
 * -----------------------------------------------------------
 * Parkimetros
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::post('parkimetros/get_multas', 'parkimetros@get_multas');


/**
 * --------------- Fin rutas parkimetros -------------------------
 */

/**
 * -----------------------------------------------------------
 * licencias
 * -----------------------------------------------------------
 *
 *
 *
 */

Route::get('licencias/solicitud', 'licencias@solicitud')->middleware('ciudadano');
Route::post('licencias/ingresa_solicitud', 'licencias@ingresa_solicitud')->middleware('ciudadano');
Route::post('licencias/actualiza_solicitud', 'licencias@actualiza_solicitud')->middleware('ciudadano');
Route::post('licencias/ingresa_solicitud_uso_suelo', 'licencias@ingresa_solicitud_uso_suelo')->middleware('ciudadano');


/**
 * --------------- Fin rutas licencias -------------------------
 */

/**
 * -----------------------------------------------------------
 * Consulta uso de suelo
 * -----------------------------------------------------------
 *
 *
 */

Route::get('consulta_uso_suelo/pre_consulta', 'consulta_uso_suelo@pre_consulta')->middleware('ciudadano');



/**
 * --------------- Fin rutas consulta uso suelo -----------------
 */

/**
 * -----------------------------------------------------------
 * Horas extras Padrón y Licencias
 * -----------------------------------------------------------
 *
 *
 */

Route::get('horas_extras/solicitud', 'horas_extras_pyl@solicitud')->middleware('ciudadano');
Route::post('horas_extras/get_datos_licencia', 'horas_extras_pyl@get_datos_licencia')->middleware('ciudadano');
Route::post('horas_extras/get_permisos_giro', 'horas_extras_pyl@get_permisos_giro')->middleware('ciudadano');
Route::post('horas_extras/get_datos_licencia', 'horas_extras_pyl@get_datos_licencia')->middleware('ciudadano');
Route::post('horas_extras/get_permisos_giro', 'horas_extras_pyl@get_permisos_giro')->middleware('ciudadano');
Route::post('horas_extras/ingresa_solitud', 'horas_extras_pyl@ingresa_solitud')->middleware('ciudadano');
Route::get('horas_extras/permiso/{id_solicitud}', 'horas_extras_pyl@permiso')->name('permiso');
Route::get('horas_extras/orden', 'horas_extras_pyl@orden');

/**
 * --------------- Fin rutas Horas extras -------------------------
 */


/**
 * -----------------------------------------------------------
 * Expediente Unico Municipal
 * -----------------------------------------------------------
 *
 *
 */
Route::get('expediente_unico_municipal/solicitud', 'expediente_unico_municipal@solicitud')->middleware('ciudadano');
Route::post('expediente_unico_municipal/ingresa_tramite', 'expediente_unico_municipal@ingresa_tramite')->middleware('ciudadano');
Route::post('expediente_unico_municipal/actualiza_solicitud', 'expediente_unico_municipal@actualiza_solicitud')->middleware('ciudadano');
Route::post('expediente_unico_municipal/ingresa_tramite', 'expediente_unico_municipal@ingresa_tramite')->middleware('ciudadano');
Route::get('expediente_unico_municipal/carta/{fecha}/{id_captura}', 'expediente_unico_municipal@carta');
/**
 * --------------- Fin rutas Horas extras -------------------------
 */





/**
 * -----------------------------------------------------------
 * Ordenamiento del Territorio
 * -----------------------------------------------------------
 */

/*
* DFA - Ordenamiento del Territorio
*/
Route::get('dictamen_finca_antigua/solicitud', 'dictamen_finca_antigua@solicitud')->middleware('ciudadano');
Route::post('dictamen_finca_antigua/ingresa_solicitud', 'dictamen_finca_antigua@ingresa_solicitud')->middleware('ciudadano');
Route::post('dictamen_finca_antigua/actualiza_solicitud', 'dictamen_finca_antigua@actualiza_solicitud')->middleware('ciudadano');
Route::post('dictamen_finca_antigua/ingresa_tramite', 'dictamen_finca_antigua@ingresa_tramite')->middleware('ciudadano');
Route::get('dictamen_finca_antigua/descargarPlano', 'dictamen_finca_antigua@descargarPlano')->middleware('ciudadano');
Route::get('dictamen_finca_antigua/carta/{fecha}/{id_captura}', 'dictamen_finca_antigua@carta');

Route::get('conectarse', [Dictamen_finca_antigua::class, 'conectarse']);


/*
* DTU - Ordenamiento del Territorio
*/
Route::get('dictamen_trazos_usos/solicitud', 'dictamen_trazos_usos@solicitud')->middleware('ciudadano');
Route::post('dictamen_trazos_usos/ingresa_solicitud', 'dictamen_trazos_usos@ingresa_solicitud')->middleware('ciudadano');
Route::post('dictamen_trazos_usos/actualiza_solicitud', 'dictamen_trazos_usos@actualiza_solicitud')->middleware('ciudadano');
Route::post('dictamen_trazos_usos/ingresa_tramite', 'dictamen_trazos_usos@ingresa_tramite')->middleware('ciudadano');
Route::get('dictamen_trazos_usos/carta/{fecha}/{id_captura}', 'dictamen_trazos_usos@carta');


/**
 * --------------- Fin rutas Horas extras -------------------------
 */
Route::get('dictamen_img_urbana/solicitud', 'dictamen_img_urbana@solicitud')->middleware('ciudadano');
Route::post('dictamen_img_urbana/ingresa_solicitud', 'dictamen_img_urbana@ingresa_solicitud')->middleware('ciudadano');
Route::post('dictamen_img_urbana/actualiza_solitud', 'dictamen_img_urbana@actualiza_solitud')->middleware('ciudadano');
Route::post('dictamen_img_urbana/ingresa_tramite', 'dictamen_img_urbana@ingresa_tramite')->middleware('ciudadano');




/**
 * -----------------------------------------------------------
 * Rutas de certificado de habilidad
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de
 *  certificado de habilidad
 */

Route::get('certificado_habitabilidad/solicitud', 'certificado_habitabilidad@solicitud')->middleware('ciudadano');
Route::post('certificado_habitabilidad/upload', 'certificado_habitabilidad@upload')->middleware('ciudadano');
Route::post('certificado_habitabilidad/ingresa_solitud', 'certificado_habitabilidad@ingresa_solitud')->middleware('ciudadano');
Route::post('certificado_habitabilidad/ingresa_tramite', 'certificado_habitabilidad@ingresa_tramite')->middleware('ciudadano');
Route::post('certificado_habitabilidad/actualiza_solitud', 'certificado_habitabilidad@actualiza_solitud')->middleware('ciudadano');
Route::post('certificado_habitabilidad/get_by_licencia', 'certificado_habitabilidad@get_by_licencia')->middleware('ciudadano');
Route::get('certificado_habitabilidad/carta/{fecha}/{id_captura}', 'certificado_habitabilidad@carta');


/**
 * -----------------------------------------------------------
 * Rutas de constancia de habilidad
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de
 *  constancia de habilidad
 */

Route::get('constancia_habitabilidad/solicitud', 'constancia_habitabilidad@solicitud')->middleware('ciudadano');
Route::post('constancia_habitabilidad/upload', 'constancia_habitabilidad@upload')->middleware('ciudadano');
Route::post('constancia_habitabilidad/ingresa_solitud', 'constancia_habitabilidad@ingresa_solitud')->middleware('ciudadano');
Route::post('constancia_habitabilidad/ingresa_tramite', 'constancia_habitabilidad@ingresa_tramite')->middleware('ciudadano');
Route::post('constancia_habitabilidad/actualiza_solitud', 'constancia_habitabilidad@actualiza_solitud')->middleware('ciudadano');
Route::post('constancia_habitabilidad/get_by_licencia', 'constancia_habitabilidad@get_by_licencia')->middleware('ciudadano');
Route::get('constancia_habitabilidad/carta/{fecha}/{id_captura}', 'constancia_habitabilidad@carta');

/**
 * -----------------------------------------------------------
 * Rutas de Revisión de Proyecto en Línea Ordenamiento del Territorio
 * -----------------------------------------------------------
 *
 * Todas las rutas que tengan que ver con el trámite de revisión de proyecto
 * en línea de obra pública
 */

Route::get('revision_proyectoot/solicitud', 'revision_proyectoot@solicitud')->middleware('ciudadano');
Route::post('revision_proyectoot/upload', 'revision_proyectoot@upload')->middleware('ciudadano');
Route::post('revision_proyectoot/ingresa_solitud', 'revision_proyectoot@ingresa_solitud')->middleware('ciudadano');
Route::post('revision_proyectoot/ingresa_tramite', 'revision_proyectoot@ingresa_tramite')->middleware('ciudadano');
Route::post('revision_proyectoot/actualiza_solitud', 'revision_proyectoot@actualiza_solitud')->middleware('ciudadano');
Route::get('revision_proyectoot/carta/{fecha}/{id_captura}', 'revision_proyectoot@carta');


/*
* REA - Medio Ambiente
*/
Route::get('dictamen_rea/solicitud', 'dictamen_rea@solicitud')->middleware('ciudadano');
Route::post('dictamen_rea/ingresa_solicitud', 'dictamen_rea@ingresa_solicitud')->middleware('ciudadano');
Route::post('dictamen_rea/actualiza_solicitud', 'dictamen_rea@actualiza_solicitud')->middleware('ciudadano');
Route::post('dictamen_rea/ingresa_tramite', 'dictamen_rea@ingresa_tramite')->middleware('ciudadano');
Route::get('dictamen_rea/descargarPlano', 'dictamen_rea@descargarPlano')->middleware('ciudadano');
Route::get('dictamen_rea/carta/{fecha}/{id_captura}', 'dictamen_rea@carta');

/*
* Rutas para tramites para bomberos
*/
Route::get('ciudadano/tramites_bomberos', 'ciudadano@tramites_bomberos')->middleware('ciudadano');
Route::get('bombero_capacitacion/solicitud', 'Capacitaciones_Proteccion_Civil@solicitud')->middleware('ciudadano');
Route::post('bombero_capacitacion/ingresa_solicitud', 'Capacitaciones_Proteccion_Civil@ingresa_solicitud')->middleware('ciudadano');
Route::post('bombero_capacitacion/actualiza_solicitud', 'Capacitaciones_Proteccion_Civil@actualiza_solicitud')->middleware('ciudadano');
Route::post('bombero_capacitacion/guardar', 'Capacitaciones_Proteccion_Civil@guardar')->middleware('ciudadano');
Route::get('bombero_capacitacion/guardar', 'Capacitaciones_Proteccion_Civil@guardar')->middleware('ciudadano');


/*
* Rutas para tramites de verificacion tecnica de Riesgos
*/


Route::get('ciudadano/tramites_verificacion_tecnica_riesgos', 'ciudadano@tramites_verificacion_tecnica_riesgos')->middleware('ciudadano');
Route::get('verificacion_tecnica_riesgos/solicitud', 'Verificacion_Riesgos@solicitud')->middleware('ciudadano');
Route::post('verificacion_tecnica_riesgos/ingresa_solicitud', 'Verificacion_Riesgos@ingresa_solicitud')->middleware('ciudadano');
Route::post('verificacion_tecnica_riesgos/actualiza_solicitud', 'Verificacion_Riesgos@actualiza_solicitud')->middleware('ciudadano');
Route::post('verificacion_tecnica_riesgos_2/actualiza_solicitud_2', 'Verificacion_Riesgos@actualiza_solicitud_2')->middleware('ciudadano');
Route::post('verificacion_tecnica_riesgos/ingresa_tramite', 'Verificacion_Riesgos@ingresa_tramite')->middleware('ciudadano');

/*
* Rutas para tramites de evaluación técnica de riesgos
*/
Route::get('evaluacion_riesgos/solicitud', 'evaluacion_riesgos@solicitud')->middleware('ciudadano');
Route::post('evaluacion_riesgos/ingresa_solicitud', 'Evaluacion_Riesgos@ingresa_solicitud')->middleware('ciudadano');
Route::post('evaluacion_riesgos/actualiza_solicitud', 'Evaluacion_Riesgos@actualiza_solicitud')->middleware('ciudadano');
Route::post('evaluacion_riesgos_2/actualiza_solicitud_2', 'Evaluacion_Riesgos@actualiza_solicitud_2')->middleware('ciudadano');
Route::post('evaluacion_riesgos/ingresa_tramite', 'Evaluacion_Riesgos@ingresa_tramite')->middleware('ciudadano');
Route::post('/buscar-cuenta', 'Rectificacion@buscarCuenta')->name('buscarCuenta');




/*
* Rutas para tramites de rectificación de nombre
*/

Route::get('rectificacion/solicitud', 'rectificacion@solicitud')->middleware('ciudadano');
Route::post('rectificacion/ingresa_solicitud', 'Rectificacion@ingresa_solicitud')->middleware('ciudadano');
Route::post('rectificacion/actualiza_solicitud', 'Rectificacion@actualiza_solicitud')->middleware('ciudadano');
Route::post('rectificacion_2/actualiza_solicitud_2', 'Rectificacion@actualiza_solicitud_2')->middleware('ciudadano');
Route::post('rectificacion/ingresa_tramite', 'Rectificacion@ingresa_tramite')->middleware('ciudadano');
Route::get('rectificacion/cuenta', 'Rectificacion@cuenta')->middleware('ciudadano');
