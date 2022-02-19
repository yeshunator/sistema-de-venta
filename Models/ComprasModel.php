<?php
class ComprasModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
   public function getProcod(string $cod)
   {
       $sql = "SELECT * FROM productos WHERE codigo = '$cod'";
       $data = $this->select($sql);
       return $data;
   }
}

?>