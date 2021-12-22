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
            <button type="button" class="btn btn-primary">editar</button>
            <button type="button" class="btn btn-danger">Eliminar</button>
            </div>';
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
}


?>