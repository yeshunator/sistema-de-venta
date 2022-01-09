<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Usuarios</li> NO BORRAR -->
    <div class="alert alert-primary" role="alert">
        Categorias
    </div>
</ol>
<!-- boton de crear nuevos usuarios -->
<button type="button" class="btn btn-primary mb-2" onclick="frmCategoria()"><i class="fa fa-plus"></i></button>
<!-- Vista de las tablas -->
<table class="table" id="tblCategorias">
  <thead class="table-dark">
      <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th></th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<!-- Funcion de crear nuevos usuarios -->
<div class="modal fade" id="nuevo_categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">Nuevo Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmCategoria">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="hidden" id="id" name="id">
            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de la Categoria">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarCate(event)" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>