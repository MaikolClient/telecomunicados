<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AnexosController;
use Controllers\LlamadaController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\BloqueadosController;
use Controllers\UsuariosController;
use Controllers\DashboardController;
use Controllers\FiltradosController;
use Controllers\TroncalesController;
use Controllers\LogsController;

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

//Área de Administración
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

//Usuarios
$router->get('/admin/usuarios', [UsuariosController::class, 'index']);
$router->get('/admin/usuarios/crear', [UsuariosController::class, 'crear']);
$router->post('/admin/usuarios/crear', [UsuariosController::class, 'crear']);

$router->get('/admin/usuarios/editar', [UsuariosController::class, 'editar']);
$router->post('/admin/usuarios/editar', [UsuariosController::class, 'editar']);

$router->post('/admin/usuarios/eliminar', [UsuariosController::class, 'eliminar']);

//Anexos
$router->get('/admin/anexos', [AnexosController::class, 'index']);
$router->get('/admin/anexos/crear', [AnexosController::class, 'crear']);
$router->post('/admin/anexos/crear', [AnexosController::class, 'crear']);

$router->get('/admin/anexos/editar', [AnexosController::class, 'editar']);
$router->post('/admin/anexos/editar', [AnexosController::class, 'editar']);

$router->get('/admin/anexos/bloquear', [AnexosController::class, 'bloquear']);
$router->post('/admin/anexos/bloquear', [AnexosController::class, 'bloquear']);

$router->post('/admin/anexos/eliminar', [AnexosController::class, 'eliminar']);

$router->get('/admin/anexos/reporte', [AnexosController::class, 'reporte']);

//Troncales
$router->get('/admin/troncales', [TroncalesController::class, 'index']);
$router->get('/admin/troncales/crear', [TroncalesController::class, 'crear']);
$router->post('/admin/troncales/crear', [TroncalesController::class, 'crear']);

$router->get('/admin/troncales/editar', [TroncalesController::class, 'editar']);
$router->post('/admin/troncales/editar', [TroncalesController::class, 'editar']);

$router->post('/admin/troncales/eliminar', [TroncalesController::class, 'eliminar']);

$router->post('/admin/filtrados', [FiltradosController::class, 'index']);


//Perfil
$router->get('/admin/perfil', [UsuariosController::class, 'perfil']);
$router->post('/admin/perfil', [UsuariosController::class, 'perfil']);

//Bloqueados
$router->get('/admin/bloqueados', [BloqueadosController::class, 'index']);

//Logs
$router->get('/admin/logs', [LogsController::class, 'index']);

//llamadas
$router->get('/admin/llamadas', [LlamadaController::class, 'index']);



//Área de supervisores
$router->get('/supervisor/dashboard', [DashboardController::class, 'index']);

//Usuarios
$router->get('/supervisor/usuarios', [UsuariosController::class, 'index']);
$router->get('/supervisor/usuarios/editar', [UsuariosController::class, 'editar']);
$router->post('/supervisor/usuarios/editar', [UsuariosController::class, 'editar']);

//Anexos
$router->get('/supervisor/anexos', [AnexosController::class, 'index']);
$router->get('/supervisor/anexos/crear', [AnexosController::class, 'crear']);
$router->post('/supervisor/anexos/crear', [AnexosController::class, 'crear']);

$router->get('/supervisor/anexos/editar', [AnexosController::class, 'editar']);
$router->post('/supervisor/anexos/editar', [AnexosController::class, 'editar']);

$router->get('/supervisor/anexos/bloquear', [AnexosController::class, 'bloquear']);
$router->post('/supervisor/anexos/bloquear', [AnexosController::class, 'bloquear']);

$router->post('/supervisor/anexos/eliminar', [AnexosController::class, 'eliminar']);

//Bloqueados
$router->get('/supervisor/bloqueados', [BloqueadosController::class, 'index']);
$router->get('/supervisor/anexos/bloquear', [AnexosController::class, 'bloquear']);
$router->post('/supervisor/anexos/bloquear', [AnexosController::class, 'bloquear']);

$router->post('/supervisor/filtrados', [FiltradosController::class, 'index']);


//Logs
$router->get('/supervisor/logs', [LogsController::class, 'index']);

$router->get('/supervisor/llamadas', [LlamadaController::class, 'index']);


//Perfil
$router->get('/supervisor/perfil', [UsuariosController::class, 'perfil']);



//Error 404
$router->get('/404', [AuthController::class, 'error']);

$router->comprobarRutas();