<?php
class ProductosModel extends Query{
    private $Producto, $nombre, $clave, $id_caja, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getProducto(String $Producto, String $clave)
    {
        $sql = "SELECT * FROM Productos WHERE Producto = '$Producto' AND clave = '$clave'"; /* para verificar de login */
        $data = $this->select($sql);
        return $data;
    }
    public function getCajas()
    {
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql = "SELECT u.*, c.id as id_caja, c.caja FROM Productos u INNER JOIN caja c WHERE u.id_caja = c.id"; /* para visualizar la tabla */
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProducto(String $Producto, String $nombre, String $clave, int $id_caja)
    {
        $this->Producto = $Producto;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        $vericar = "SELECT * FROM Productos WHERE Producto = '$this->Producto'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO Productos(Producto, nombre, clave, id_caja) VALUES (?,?,?,?)";
            $datos = array($this->Producto, $this->nombre, $this->clave, $this->id_caja);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
            $res = "ok";
            }else{
            $res = "error";
            }
        }else{
            $res = "existe";
        }
        
        return $res;
    }
    public function modificarProducto(String $Producto, String $nombre, int $id_caja, int $id)
    {
        $this->Producto = $Producto;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_caja = $id_caja;
        $sql = "UPDATE Productos SET Producto = ?, nombre = ?, id_caja = ? WHERE id = ?";
        $datos = array($this->Producto, $this->nombre, $this->id_caja, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }
        
        return $res;
    }
    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM Productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE Productos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}

?>