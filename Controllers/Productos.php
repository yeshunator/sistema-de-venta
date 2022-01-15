<?php
class Productos extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        $data['medidas'] = $this->model->getMedidas();
        $data['categorias'] = $this->model->getCategorias();
        // print_r($this->model->getProducto());
        $this->views->getView($this, "index", $data);

    }
    public function listar()
    {
        $data = $this->model->getProductos(); //LOS BOTONES DE EDITAR Y ELIMINAR, Y TAMBIEN VER EL ESTADO
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'. base_url. "Assets/img/".$data[$i]['foto'].'" width="100">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary" onclick="btnEditarPro('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" onclick="btnEliminarPro('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-success" onclick="btnReingresarPro('.$data[$i]['id'].')"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REGISTRAR
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $medida = $_POST['medida'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $destino = "Assets/img/".$name;
        if (empty($name)) {
            $name = "default.png";
        }
        if (empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                   $data = $this->model->registrarProducto($codigo, $nombre, $precio_compra, $precio_venta, $medida, $categoria, $name);
                   if ($data == "ok") {
                       $msg = "si";
                       move_uploaded_file($tmpname, $destino);
                   }else if($data == "existe"){
                       $msg = "El Producto ya existe";
                   }else{
                       $msg = "Error al registrar el Producto";
                   } 
            }else{
                if ($_POST['foto_actual'] != $_POST['foto_delete']) {
                    $imgDelete = $this->model->editarPro($id);
                    if ($imgDelete['foto'] != 'default.png' || $imgDelete['foto'] != "") {
                        if (file_exists($destino . $imgDelete['foto'])) {
                            unlink($destino . $imgDelete['foto']);
                        }
                    }
                    $data = $this->model->modificarProducto($codigo, $nombre, $precio_compra, $precio_venta, $medida, $categoria, $name, $id);
                    if ($data == "modificado") {
                        $msg = "modificado";
                        move_uploaded_file($tmpname, $destino);
                    }else{
                        $msg = "Error al modificar el Producto";
                    }  
                }
                
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REGISTRAR
    public function editar(int $id)
    {
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE ELIMINAR
    public function eliminar(int $id)
    {
        $data = $this->model->accionPro(0, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE REINGRESAR
    public function reingresar(int $id)
    {
        $data = $this->model->accionPro(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // FUNCION DE SALIR
    public function salir()
    {
        session_destroy();
        header("location: ".base_url);
    }
}


?>