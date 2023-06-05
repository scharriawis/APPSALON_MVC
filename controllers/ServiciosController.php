<?php

namespace Controllers;

use MVC\Router;
use Model\Servicios;

class ServiciosController{
    public static function index( Router $router){
        session_start();
        \isAdmin();
        $mensaje = intval($_GET['mensaje']);
        //database servicios
        $servicios = Servicios::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'servicios' => $servicios,
            'mensaje' => $mensaje
        ]);
    }

    public static function crear( Router $router){
        session_start();
        \isAdmin();
        $servicio = new Servicios;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Sincroniza el form con la database
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                $alertas['exito'][] = 'El servicio ha sido creado perfectamente'; 
                header('Location: /admin?mensaje=1');
            }
        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar( Router $router){
        session_start();
        \isAdmin();
        
        if(!is_numeric($_GET['id'])) return;
        $servicio = Servicios::find($_GET['id']);
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios?mensaje=2');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $servicio = Servicios::find($id);
            $servicio->eliminar();
            header('Location: /servicios?mensaje=3');
        }
    }
}