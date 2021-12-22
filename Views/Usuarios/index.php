<?php 
include "ViewS/Templates/header.php";
?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
</ol>
<button type="button" class="btn btn-primary mb-2">Nuevo</button>
<!-- Vista de las tablas -->
<table class="table" id="tblUsuarios">
  <thead class="table-dark">
      <tr>
          <th>Id</th>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Caja</th>
          <th>Estado</th>
          <th></th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<!-- Funcion de crear nuevos usuarios -->
<div class="modal fade" id="nuevo_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmUsuarios">
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "ViewS/Templates/footer.php"; ?>