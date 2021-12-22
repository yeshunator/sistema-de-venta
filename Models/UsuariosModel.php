<?php
class UsuariosModel extends Query{
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
    public function getUsuarios()
    {
        $sql = "SELECT u.*, c.id, c.caja FROM usuarios u INNER JOIN caja c WHERE u.id_caja = c.id"; /* para visualizar la tabla */
        $data = $this->selectAll($sql);
        return $data;
    }
}

?>