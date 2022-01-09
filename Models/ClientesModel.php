<?php
class ClientesModel extends Query{
    private $dni, $nombre, $telefono, $direccion, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getClientes()
    {
        $sql = "SELECT * FROM clientes"; /* para visualizar la tabla */
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCliente(String $dni, String $nombre, String $telefono, String $direccion)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $vericar = "SELECT * FROM clientes WHERE dni = '$this->dni'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO Clientes(dni, nombre, telefono, direccion) VALUES (?,?,?,?)";
            $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion);
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
    public function modificarCliente(String $dni, String $nombre, String $telefono, String $direccion, int $id)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;
        $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
        $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }
        
        return $res;
    }
    public function editarCli(int $id)
    {
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCli(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}

?>