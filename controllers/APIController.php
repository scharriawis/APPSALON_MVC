<?php

namespace Controllers;
use MVC\Router;
use Model\Servicios;
use Model\Cita;
use Model\CitasServicios;

class APIController{
    public static function index( Router $router){
        $servicios = Servicios::all();
        echo json_encode($servicios);//Codifica o pasa la información de la base de datos de la url a un formato de transporte tipo .json
        
    }

    public static function guardar(){
        //database table cita
        //Instanciamos la cita y capturamos los que haya en post
        $cita = new Cita($_POST);
        //Enviamos los datos a la database
        $resultado = $cita->guardar();
        //End database table cita

        //database table citasservicios
        //Crear variable del id cita
        $id = $resultado['id'];
        //Separamos el string que contiene los servicios.
        $idServicios = explode(',', $_POST['servicios']);
        //Iteramos y separamos en cada uno de los servicios
        foreach($idServicios as $idServicio){
            //Creamos el arreglo para el constructor del model CitasServicios
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            //Instanciamos
            $citasServicios = new CitasServicios($args);
            //Lo enviamos a la data base
            $citasServicios->guardar();
        }
        //end database table citasservicios

        //Enviamos la variable que va a devolver un boolean gracias a active record function crear

        //Se imprime en pantalla por medio de la coficición json
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $resultado = Cita::find($id);
            $resultado->eliminar();
            header('Location: ' . $_SERVER['HTTP_REFERER']);    //$_SERVER['HTTP_REFERER']
        }
    }
}