<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Usuarios</li> NO BORRAR -->
    <div class="alert alert-primary" role="alert">
        Clientes
    </div>
</ol>
<!-- boton de crear nuevos usuarios -->
<button type="button" class="btn btn-primary mb-2" onclick="frmCliente()"><i class="fa fa-plus"></i></button>
<!-- Vista de las tablas -->
<table class="table" id="tblClientes">
  <thead class="table-dark">
      <tr>
          <th>Id</th>
          <th>Dni</th>
          <th>Nombre</th>
          <th>Telefono</th>
          <th>Direccion</th>
          <th>Estado</th>
          <th></th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<!-- Funcion de crear nuevos usuarios -->
<div class="modal fade" id="nuevo_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmClientes">
          <div class="form-group">
            <label for="dni">Dni</label>
            <input type="hidden" id="id" name="id">
            <input id="dni" class="form-control" type="text" name="dni" placeholder="Documento de identidad">
          </div>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Cliente">
          </div>
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Numero de telefono">
          </div>
          <div class="mb-3">
              <label for="direccion" class="form-label">Direccion</label>
              <textarea class="form-control" id="direccion" name="direccion" placeholder="Direccion" rows="3" aria-label=""></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarCli(event)" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>