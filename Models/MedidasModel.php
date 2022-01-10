<?php
class MedidasModel extends Query{
    private $nombre, $nombre_corto, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMedidas()
    {
        $sql = "SELECT * FROM medidas"; /* para visualizar la tabla */
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarMedida(String $nombre, String $nombre_corto)
    {
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;
        $vericar = "SELECT * FROM medidas WHERE nombre = '$this->nombre'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO medidas(nombre, nombre_corto) VALUES (?,?)";
            $datos = array($this->nombre, $this->nombre_corto);
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
    public function modificarMedida(String $nombre, String $nombre_corto, int $id)
    {
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;
        $this->id = $id;
        $sql = "UPDATE medidas SET nombre = ?, nombre_corto = ? WHERE id = ?";
        $datos = array($this->nombre, $this->nombre_corto, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }
        
        return $res;
    }
    public function editarMedi(int $id)
    {
        $sql = "SELECT * FROM medidas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionMedi(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE medidas SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}

?>