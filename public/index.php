<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginControllers;
use Controllers\CitasControllers;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServiciosController;
use MVC\Router;

$router = new Router();

//Login
$router->get('/', [LoginControllers::class, 'login']);
$router->post('/', [LoginControllers::class, 'login']);
$router->get('/logout', [LoginControllers::class, 'logout']);

//Password
$router->get('/forgot', [LoginControllers::class, 'forgot']);
$router->post('/forgot', [LoginControllers::class, 'forgot']);
$router->get('/recover', [LoginControllers::class, 'recover']);
$router->post('/recover', [LoginControllers::class, 'recover']);

//Create Account
$router->get('/create-account', [LoginControllers::class, 'createAccount']);
$router->post('/create-account', [LoginControllers::class, 'createAccount']);

//Confirm account
$router->get('/confirm-account', [LoginControllers::class, 'confirmAccount']);
$router->get('/messages', [LoginControllers::class, 'messages']);

//Private area
$router->get('/citas', [CitasControllers::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

//CRUD servicios
$router->get('/servicios', [ServiciosController::class, 'index']);
$router->get('/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();