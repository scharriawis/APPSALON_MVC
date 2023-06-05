<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Revisa si el el usuario está autennticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

//Devuelve un bool Sí hay otra cita cliente
function isLast(string $actual, string $proximo) : bool{      //Es último
    if($actual !== $proximo){
        return true;
    }
    return false;
}

function mensaje($mensaje){

    switch($mensaje){
        case 1: echo "El servicio fue creado correctamente";
        break;
        case 2: echo "El servicio fue actualizado correctamente";
        break;
        case 3: echo "El servicio fue eliminado correctamente";
        break;
    }
}
