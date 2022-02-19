<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Usuarios</li> NO BORRAR -->
    <div class="alert alert-primary" role="alert">
        Nueva Compra
    </div>
</ol>
<div class="card">
  <div class="card-body">
      <form id="frmCompra">
          <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="codigo">Codigo de barras</label>
                      <input type="codigo" class="form-control" type="text" name="codigo" placeholder="Ingrese el codigo de barras">
                  </div>
              </div>
              <div class="col-md-5">
                  <div class="form-group">
                      <label for="nombre">Descripcion</label>
                      <input type="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion del producto" disabled>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="cantidad">Cantidad</label>
                      <input type="cantidad" class="form-control" type="number" name="cantidad">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="precio">Precio</label>
                      <input type="precio" class="form-control" type="text" name="precio" placeholder="Precio" disabled>
                  </div>
              </div>
          </div>
      </form>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>