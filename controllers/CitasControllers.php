<?php

namespace Controllers;
use MVC\Router;

class CitasControllers{
    public static function index(Router $router){
        //Se inicia sesión para traer los datos del Login
        session_start();

        //Revisa Sí esta autenticado
        \isAuth();

        //Lo enviamos como array asociativo para js es un objeto
        $router->render('citas/index', [
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido']
        ]);
    }
}