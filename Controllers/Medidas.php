<?php
class Medidas extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");

    }
    public function listar()
    {
        $data = $this->model->getMedidas(); //LOS BOTONES DE EDITAR Y ELIMINAR, Y TAMBIEN VER EL ESTADO
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary" onclick="btnEditarMedi('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" onclick="btnEliminarMedi('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-success" onclick="btnReingresarMedi('.$data[$i]['id'].')"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REGISTRAR
    public function registrar()
    {
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $id = $_POST['id'];
        if (empty($nombre) || empty($nombre_corto)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                   $data = $this->model->registrarMedida($nombre, $nombre_corto);
                   if ($data == "ok") {
                       $msg = "si";
                   }else if($data == "existe"){
                       $msg = "La medida ya existe";
                   }else{
                       $msg = "Error al registrar la medida";
                   } 
            }else{
                $data = $this->model->modificarMedida($nombre, $nombre_corto, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar la medida";
                } 
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REGISTRAR
    public function editar(int $id)
    {
        $data = $this->model->editarMedi($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE ELIMINAR
    public function eliminar(int $id)
    {
        $data = $this->model->accionMedi(0, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el Cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REINGRESAR
    public function reingresar(int $id)
    {
        $data = $this->model->accionMedi(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el Cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}


?>