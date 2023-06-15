<?php

namespace Controllers;
use MVC\Router;
use Model\User;
use Clases\Email;

class LoginControllers{
    public static function login( Router $router){
        //Instanciar ele model User para rellenar formulario
        $auth = new User;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Tomamos los datos qué envian los usuarios en form
            $auth = new User($_POST);
            //Validar los campos obligatorios
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                //Autenticar email
                $usuario = User::where('email', $auth->email);
                if($usuario){
                    //Autenticar confirmado y password, luego pasamos como argumento el password enviado por el usauario
                    if($usuario->comprobarPasswordAndConfirmado($auth->password)){
                        //Inicia sesion he importamos los datos
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        //\debuguear($_SESSION);
                        //Identificamos el tipo de usuario
                        if($usuario->admin === '1'){
                            //Importamos el valor de admin
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /citas');
                        }
                    }
                }else{
                    //Mostrar mensaje de error
                    $alertas = User::setAlerta('error', 'Usuario no existe');
                }   
            }

            $alertas = User::getAlertas();
        }

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function forgot(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = new User($_POST);
            $alertas = $user->validarEmail();
            if(empty($alertas)){
                $resultado = User::where('email', $user->email);
               if($resultado && $resultado->confirmado){
                    //Generar token
                    $resultado->crearToken();
                    $resultado->guardar();
                    //Enviar mensaje exito
                    User::setAlerta('exito', 'Revisa tu email');
                    //Todo: enviar el email
                    $email = new Email($resultado->email, $resultado->nombre, $resultado->apellido, $resultado->token);
                    $email->enviarInstrucciones();
                    
               }else{
                    User::setAlerta('error', 'Usuario no registrado o confirmado');
               } 
            }
        }
        $alertas = User::getAlertas();
        $router->render('auth/forgot-Password', [
            'alertas' => $alertas
        ]);
    }

    public static function recover(Router $router){
        $alertas = [];
        $error = false;
        //Obtenemos el valor del token mediante get
        $token = s($_GET['token']);
        $user = User::where('token', $token);
        if(empty($user)){
            User::setAlerta('error', 'token no valido');
            $error = true;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //leer el password y guardarlo
            $password = new User($_POST);
            $password->validarPassword();
            if(empty($alertas)){
                //Eliminar token
                $user->token = null;
                //Eliminar el password anterior
                $user->password = null;
                //Actualizar password
                $user->password = $password->password;
                //Hashear password
                $user->hashearPassword();
                //Guardar cambios
                $resultado = $user->guardar();
                //Reedirecionar
                if($resultado){
                    header('Location: /');
                }
            }
        }
            //resetear token
            //$user->token = null;
            //Guardamos cambios
            //$user->guardar();
            //Mostrar mensaje de exito
            //User::setAlerta('exito', 'Inicia sesión con tu nuevo password');
        
        $alertas = User::getAlertas();
        $router->render('auth/recover', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function createAccount(Router $router){

        $user = new User;
        //Alertas de campo vacío
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //sincroniza lo que hay en post con la class User o Model User
            $user->sincronizar($_POST);
            //Validación del formulario
            $alertas = $user->crearNuevaCuenta();

            //Revisar si la validación está vacía
            if(empty($alertas)){
                //Verificar sí el usuario existe
                $resultado = $user->usuarioExiste();
                if($resultado->num_rows){
                    $alertas = User::getAlertas();
                }else{
                    //El usuario no existe
                    //Hashear password
                    $user->hashearPassword();
                    //Generar token
                    $user->crearToken();
                    //Enviar email
                    $email = new Email($user->email, $user->nombre, $user->apellido, $user->token);
                    //Enviar confirmación
                    $email->enviarConfirmacion();
                    //Crear usuario
                    $resultado = $user->guardar();
                    if($resultado){
                        header('Location: /messages');
                    }
                }
            }
        }
        $router->render('auth/createAccount', [
            'user' => $user,
            'alertas' => $alertas
        ]);
    }

    public static function confirmAccount(Router $router){
        $alertas = [];
        //Obtener mediante el get el token
        $token = \s($_GET['token']);
        //Consultar mediante la columna y valor de la database
        $usuario = User::where('token', $token);

        //Confirmar el token de email y establecer alerta a la variable alerta
        if(empty($usuario)){
            User::setAlerta('error', 'Token no válido');
        }else{
            //Cambiar a modo confirmado
            $usuario->confirmado = "1";
            //Cambiar el valor del token
            $usuario->token = null;
            //Guardar cambios en database
            $usuario->guardar();
            //Establecer alerta
            User::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        //Obtener alertas
        $alertas = User::getAlertas();

        //Obtener las vistas
        $router->render('auth/confirmAccount', [
            'alertas' => $alertas,
        ]);
    }

    public static function messages(Router $router){
        $router->render('auth/messages');
    }
}
