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
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" type="text" class="form-control" type="text" name="codigo" placeholder="Ingrese el codigo de barras" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nombre">Descripcion</label>
                        <input id="nombre" type="text" class="form-control" type="text" name="nombre" placeholder="Descripcion del producto" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="number" class="form-control" name="cantidad" onkeyup="calcularPrecio(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub total" disabled>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<table class="table table-dark">
    <thead>
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="row">
    <div class="col-md-4 ms-auto">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
            <button type="button" class="btn btn-primary mt-2"> Generar Compra</button>
        </div>
    </div>
</div>
<!-- para que visualise el footer -->
<?php include "Views/Templates/footer.php"; ?>