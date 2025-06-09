<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIEventos;
//use Controllers\APIJugadores;
use Controllers\APIEntrenadores;
use Controllers\APIEquipacion;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\EventosController;
//use Controllers\RegalosController;
use Controllers\PaginasController;
//use Controllers\PonentesController;
use Controllers\RegistroController;
use Controllers\DashboardController;
//use Controllers\JugadoresController;
use Controllers\EquipacionController;
use Controllers\RenovacionController;

use Controllers\RegistradosController;
use Controllers\EntrenadoresController;
use Controllers\PatrocinadorController;

$router = new Router();

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


// Area de Administracion
// DASHBOARD
$router->get('/admin/dashboard', [DashboardController::class, 'index']);



$router->get('/admin/panel', [AdminController::class, 'index']);

$router->post('/admin/panel/usuarios/aceptar', [AdminController::class, 'aceptarUsuario']);
$router->post('/admin/panel/usuarios/rechazar', [AdminController::class, 'rechazarUsuario']);

$router->get('/admin/panel/editar', [AdminController::class, 'editar']);
$router->post('/admin/panel/editar', [AdminController::class, 'editar']);

// DASHBOARD Renovaciones
$router->get('/admin/renovaciones', [RenovacionController::class, 'index']);
$router->get('/registro/renovaciones', [RenovacionController::class, 'crearSolicitud']);
$router->post('/admin/renovaciones/aceptar', [RenovacionController::class, 'aceptarRenovacion']);
$router->post('/admin/renovaciones/rechazar', [RenovacionController::class, 'rechazarRenovacion']);


// DASHBOARD REGISTRADOS
$router->get('/admin/registrados/editar', [RegistradosController::class, 'editar']);
$router->post('/admin/registrados/editar', [RegistradosController::class, 'editar']);

$router->get('/admin/registrados', [RegistradosController::class, 'index']);
$router->post('/admin/registrados/aprobar', [RegistradosController::class, 'aprobarUsuario']);
$router->post('/admin/registrados/rechazar', [RegistradosController::class, 'rechazarUsuario']);


// Area de Administracion
// DASHBOARD JUGADORES
$router->get('/admin/entrenadores', [EntrenadoresController::class, 'index']);
$router->get('/admin/entrenadores/crear', [EntrenadoresController::class, 'crear']);
$router->post('/admin/entrenadores/crear', [EntrenadoresController::class, 'crear']);
$router->get('/admin/entrenadores/editar', [EntrenadoresController::class, 'editar']);
$router->post('/admin/entrenadores/editar', [EntrenadoresController::class, 'editar']);
$router->post('/admin/entrenadores/eliminar', [EntrenadoresController::class, 'eliminar']);



// Area de Administracion
// DASHBOARD EVENTOS
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);
// Area de Administracion ----FIN----

////////////////////////////////////////////////////////////////////////

// APIS
$router->get('/api/eventos-horario', [APIEventos::class, 'index']);
//$router->get('/api/jugadores', [APIJugadores::class, 'index']);
//$router->get('/api/jugador', [APIJugadores::class, 'jugador']);
$router->get('/api/equipacion', [APIEquipacion::class, 'index']);

$router->get('/api/entrenadores', [APIEntrenadores::class, 'index']);
$router->get('/api/entrenador', [APIEntrenadores::class, 'entrenador']);




// DASHBOARD PATROCINADORES
$router->get('/admin/patrocinadores', [PatrocinadorController::class, 'index']);
$router->get('/admin/patrocinadores/crear', [PatrocinadorController::class, 'crear']);
$router->post('/admin/patrocinadores/crear', [PatrocinadorController::class, 'crear']);
$router->get('/admin/patrocinadores/editar', [PatrocinadorController::class, 'editar']);
$router->post('/admin/patrocinadores/editar', [PatrocinadorController::class, 'editar']);
$router->post('/admin/patrocinadores/eliminar', [PatrocinadorController::class, 'eliminar']);


// DASHBOARD EQUIPACION
$router->get('/admin/equipacion', [EquipacionController::class, 'index']);

// Registro de Usuarios
$router->get('/finalizar-registro', [RegistroController::class, 'crear']);
$router->post('/finalizar-registro/gratis', [RegistroController::class, 'gratis']);
$router->post('/finalizar-registro/pagar', [RegistroController::class, 'pagar']);
$router->get('/finalizar-registro/eventosconf', [RegistroController::class, 'eventosconf']);
$router->post('/finalizar-registro/eventosconf', [RegistroController::class, 'eventosconf']);


// Boleto virtual
$router->get('/boleto', [RegistroController::class, 'boleto']);

$router->post('/boleto', [RegistroController::class, 'guardarFirma']);
$router->get('/firma', [RegistroController::class, 'firma']);
$router->get('/confirmar-firma', [RegistroController::class, 'confirmarFirma']);
$router->post('/renovacion', [RegistroController::class, 'solicitarRenovacion']);



// Area Publica de paginas
$router->get('/', [PaginasController::class, 'index']);
$router->get('/clubdeportivo', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/eventos', [PaginasController::class, 'eventos']);
$router->get('/evento', [PaginasController::class, 'detalleEvento']);
$router->get('/pruebas', [PaginasController::class, 'pruebas']);
$router->get('/404', [PaginasController::class, 'error']);



$router->comprobarRutas();