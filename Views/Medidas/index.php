<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Usuarios</li> NO BORRAR -->
    <div class="alert alert-primary" role="alert">
        Medidas
    </div>
</ol>
<!-- boton de crear nuevos medidas -->
<button type="button" class="btn btn-primary mb-2" onclick="frmMedida()"><i class="fa fa-plus"></i></button>
<!-- Vista de las tablas -->
<table class="table" id="tblMedidas">
  <thead class="table-dark">
      <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Nombre_Corto</th>
          <th>Estado</th>
          <th></th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<!-- Funcion de crear nuevos usuarios -->
<div class="modal fade" id="nuevo_medida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">Nueva Medida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmMedidas">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="hidden" id="id" name="id">
            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de la medida">
          </div>
          <div class="form-group">
            <label for="nombre_corto">Nombre_corto</label>
            <input id="nombre_corto" class="form-control" type="text" name="nombre_corto" placeholder="Nombre corto de la medida">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarMedi(event)" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>