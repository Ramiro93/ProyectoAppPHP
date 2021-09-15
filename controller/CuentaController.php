<?php

class CuentaController {
    public function __construct(){
        include_once("model/CuentaModel.php");
    }

    public function login($email, $password) {
        $modelo = new CuentaModel();
        $row = $modelo->login($email, $password);
        if ($row) {
            $usuario = $row[0];
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
            exit();
        } else {
            echo "<small class='text-danger'>No se pudo loguear</small>";
            include_once("view/loginView.php");
        }
    }

    public function registrar($email,$password,$nombre,$apellido,$rol){
        $modelo = new CuentaModel();
        
        try{
            $modelo->registrar($email,$password,$nombre,$apellido,$rol);
            $row = $modelo->login($email,$password);
            $usuario = $row[0];
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
            exit();
    
        }catch(Exception $e){
            echo "No se pudo registrar";
        }
    }
}