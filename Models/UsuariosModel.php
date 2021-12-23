<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $id_caja;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(String $usuario, String $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'"; /* para verificar de login */
        $data = $this->select($sql);
        return $data;
    }
    public function getCajas()
    {
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT u.*, c.id, c.caja FROM usuarios u INNER JOIN caja c WHERE u.id_caja = c.id"; /* para visualizar la tabla */
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(String $usuario, String $nombre, String $clave, int $id_caja)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_caja) VALUES (?,?,?,?)";
        $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_caja);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }
}

?>