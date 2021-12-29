<?php
class Usuarios extends Controller{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['cajas'] = $this->model->getCajas();
        // print_r($this->model->getUsuario());
        $this->views->getView($this, "index", $data);

    }
    public function listar()
    {
        $data = $this->model->getUsuarios(); //LOS BOTONES DE EDITAR Y ELIMINAR, Y TAMBIEN VER EL ESTADO
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
            }
            $data[$i]['acciones'] = '<div>
            <button type="button" class="btn btn-primary" onclick="btnEditarUser('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-danger" onclick="btnEliminarUser('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
            <button type="button" class="btn btn-success" onclick="btnReingresarUser('.$data[$i]['id'].')">Reingrensar</button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg = "ok";

            }else{
                $msg = "contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($caja)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                if($clave != $confirmar){
                    $msg = "Las contraseñas no coinciden";
                }else{
                   $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                   if ($data == "ok") {
                       $msg = "si";
                   }else if($data == "existe"){
                       $msg = "El usuario ya existe";
                   }else{
                       $msg = "Error al registrar el usuario";
                   } 
                } 
            }else{
                $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el usuario";
                } 
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}


?>