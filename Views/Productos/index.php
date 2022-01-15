<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <!-- <li class="breadcrumb-item active">Productos</li> NO BORRAR -->
    <div class="alert alert-primary" role="alert">
        Productos
    </div>
</ol>
<!-- boton de crear nuevos Productos dsf -->
<button type="button" class="btn btn-primary mb-2" onclick="frmProducto()"><i class="fa fa-plus"></i></button>
<!-- Vista de las tablas -->
<table class="table" id="tblProductos">
  <thead class="table-dark">
      <tr>
          <th>Id</th>
          <th>Imagen</th>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Estado</th>
          <th></th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<!-- Funcion de crear nuevos Productos -->
<div class="modal fade" id="nuevo_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmProductos">
          <div class="form-group">
            <label for="codigo">Codigo de barras</label>
            <input type="hidden" id="id" name="id">
            <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo de barra">
          </div>
          <div class="form-group">
            <label for="nombre">Descripcion</label>
            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
          </div>
          <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                      <label for="precio_compra">Precio Compra</label>
                      <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="Precio de la compra">
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
                      <label for="precio_venta">Precio Venta</label>
                      <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="Precio de la venta">
                 </div>
             </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                   <label for="medida">Medidas</label>
                       <select id="medida" class="form-control" name="medida">
                         <?php foreach ($data['medidas'] as $row) { ?>
                         <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                         <?php } ?>
                       </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                   <label for="categoria">Categoria</label>
                       <select id="categoria" class="form-control" name="categoria">
                         <?php foreach ($data['categorias'] as $row) { ?>
                         <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                         <?php } ?>
                       </select>
                </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
                      <label>Foto</label>
                      <div class="card border-primary">
                        <div class="card-body">
                          <label for="imagen" class="btn btn-primary" id="icon-image"><i class="fas fa-image"></i></label>
                          <span id="icon-cerrar"></span>
                        <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                        <input type="hidden" id="foto_actual" name="foto_actual">
                        <input type="hidden" id="foto_delete" name="foto_delete">
                        <img class="img-thumbnail" id="img-preview">
                        </div>
                      </div>
                 </div>
              </div>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarPro(event)" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>