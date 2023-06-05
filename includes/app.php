<?php 

require __DIR__ . '/../vendor/autoload.php';        //composer
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);  //enrutamiento a .env database
$dotenv->safeLoad();    //Sino esta el archivo .env no marque errores

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);