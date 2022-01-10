let tblUsuarios, tblClientes, tblCategorias, tblCajas, tblMedidas;
document.addEventListener("DOMContentLoaded", function(){
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [ //PARA AGREGAR MAS COLUMNAS
            {
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    // FIN DE LA TABLA USUARIO
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [ //PARA AGREGAR MAS COLUMNAS
            {
                'data': 'id'
            },
            {
                'data': 'dni'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'direccion'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    // FIN DE LA TABLA CLIENTES
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [ //PARA AGREGAR MAS COLUMNAS
            {
                'data': 'id'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    // FIN DE LA TABLA Categoria
    tblCajas = $('#tblCajas').DataTable({
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        columns: [ //PARA AGREGAR MAS COLUMNAS
            {
                'data': 'id'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    // FIN DE LA TABLA CAJAS
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns: [ //PARA AGREGAR MAS COLUMNAS
            {
                'data': 'id'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'nombre_corto'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
})
// LA FUNCION DE LOGIN
function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    if (usuario.value == " ") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if(clave.value == " ") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    }else{
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    window.location = base_url + "Usuarios";
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}
function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuarios").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}
// LA FUNCION DE REGISTRAR UN USUARIO
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    
    if (usuario.value == "" || nombre.value == "" || caja.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuarios");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Registrado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
// FUNCION DE BOTON DE EDITAR
function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
        const url = base_url + "Usuarios/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("usuario").value = res.usuario;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("caja").value = res.id_caja;
                document.getElementById("claves").classList.add("d-none");
                $("#nuevo_usuario").modal("show");
            }
        }
    
}
// funcion para eliminar el usuario
function btnEliminarUser(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Eliminar?',
        text: "El usuario no se eliminara de forma permanente, solo cambiara el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Usuarios/eliminar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Usuario eliminado con exito.',
                        'success'
                      )
                      tblUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// funcion para reingresar el usuario
function btnReingresarUser(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Reingresar?',
        text: "El usuario se cambiara a modo activo nuevamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Usuarios/reingresar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Usuario reingresado con exito.',
                        'success'
                      )
                      tblUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// ------------- FIN DE LA FUNCION DE USUARIO ---------------
function frmCliente() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmClientes").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}
// LA FUNCION DE REGISTRAR UN Cliente
function registrarCli(e) {
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    
    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmClientes");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cliente Registrado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_cliente").modal("hide");
                      tblClientes.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cliente Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_cliente").modal("hide");
                      tblClientes.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
// FUNCION DE BOTON DE EDITAR Cliente
function btnEditarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
        const url = base_url + "Clientes/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("dni").value = res.dni;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("telefono").value = res.telefono;
                document.getElementById("direccion").value = res.direccion;
                $("#nuevo_cliente").modal("show");
            }
        }
    
}
// funcion para eliminar el Cliente
function btnEliminarCli(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Eliminar?',
        text: "El cliente no se eliminara de forma permanente, solo cambiara el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Clientes/eliminar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Cliente eliminado con exito.',
                        'success'
                      )
                      tblClientes.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// funcion para reingresar el Cliente
function btnReingresarCli(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Reingresar?',
        text: "El cliente se cambiara a modo activo nuevamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Clientes/reingresar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Cliente reingresado con exito.',
                        'success'
                      )
                      tblClientes.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// --------------- FIN DE LA FUNCION DE CLIENTE ------------------
function frmCategoria() {
    document.getElementById("title").innerHTML = "Nuevo categoria";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCategoria").reset();
    $("#nuevo_categoria").modal("show");
    document.getElementById("id").value = "";
}
// LA FUNCION DE REGISTRAR UN categoria
function registrarCate(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    
    if (nombre.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Categoria Registrado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_categoria").modal("hide");
                      tblCategorias.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Categoria Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_categoria").modal("hide");
                      tblCategorias.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
// FUNCION DE BOTON DE EDITAR categoria
function btnEditarCate(id) {
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Modificar";
        const url = base_url + "Categorias/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;
                $("#nuevo_categoria").modal("show");
            }
        }
    
}
// funcion para eliminar el Categoria
function btnEliminarCate(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Eliminar?',
        text: "La categoria no se eliminara de forma permanente, solo cambiara el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Categorias/eliminar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Cliente eliminado con exito.',
                        'success'
                      )
                      tblCategorias.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// funcion para reingresar el Categoria
function btnReingresarCate(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Reingresar?',
        text: "La categoria se cambiara a modo activo nuevamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Categorias/reingresar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Categoria reingresado con exito.',
                        'success'
                      )
                      tblCategorias.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// ******************** FIN DE LA FUNCION CATEGORIA *******************
function frmCaja() {
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCajas").reset();
    $("#nuevo_cajas").modal("show");
    document.getElementById("id").value = "";
}
// LA FUNCION DE REGISTRAR caja
function registrarCaja(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    
    if (nombre.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Cajas/registrar";
        const frm = document.getElementById("frmCajas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Caja Registrado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_cajas").modal("hide");
                      tblCajas.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Caja Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_cajas").modal("hide");
                      tblCajas.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
// FUNCION DE BOTON DE EDITAR Caja
function btnEditarCaja(id) {
    document.getElementById("title").innerHTML = "Actualizar Caja";
    document.getElementById("btnAccion").innerHTML = "Modificar";
        const url = base_url + "Cajas/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.caja;
                $("#nuevo_cajas").modal("show");
            }
        }
    
}
// funcion para eliminar el Caja
function btnEliminarCaja(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Eliminar?',
        text: "La Caja no se eliminara de forma permanente, solo cambiara el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Cajas/eliminar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Caja eliminado con exito.',
                        'success'
                      )
                      tblCajas.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// funcion para reingresar el Caja
function btnReingresarCaja(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Reingresar?',
        text: "La Caja se cambiara a modo activo nuevamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Cajas/reingresar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Caja reingresado con exito.',
                        'success'
                      )
                      tblCajas.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// *********************** FIN DE LA FUNCION DE CAJA ***********************
function frmMedida() {
    document.getElementById("title").innerHTML = "Nueva Medida";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmMedidas").reset();
    $("#nuevo_medida").modal("show");
    document.getElementById("id").value = "";
}
// LA FUNCION DE REGISTRAR UN MEDIDAS
function registrarMedi(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const nombre_corto = document.getElementById("nombre_corto");
    
    if (nombre.value == "" || nombre_corto.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedidas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Medida Registrado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_medida").modal("hide");
                      tblMedidas.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Medida Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_medida").modal("hide");
                      tblMedidas.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
// FUNCION DE BOTON DE EDITAR MEDIDAS
function btnEditarMedi(id) {
    document.getElementById("title").innerHTML = "Actualizar Medida";
    document.getElementById("btnAccion").innerHTML = "Modificar";
        const url = base_url + "Medidas/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("nombre_corto").value = res.nombre_corto;
                $("#nuevo_medida").modal("show");
            }
        }
    
}
// funcion para eliminar el MEDIDAS
function btnEliminarMedi(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Eliminar?',
        text: "La Medida no se eliminara de forma permanente, solo cambiara el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Medidas/eliminar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Medida eliminado con exito.',
                        'success'
                      )
                      tblMedidas.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}
// funcion para reingresar el MEDIDAS
function btnReingresarMedi(id) {
    Swal.fire({
        title: 'Estas seguro(a) de Reingresar?',
        text: "La Medida se cambiara a modo activo nuevamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
        const url = base_url + "Medidas/reingresar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire(
                        'Mensaje!',
                        'Medida reingresado con exito.',
                        'success'
                      )
                      tblMedidas.ajax.reload();
                }else{
                    Swal.fire(
                        'Mensaje!',
                        res,
                        'error'
                    )
                }
            }
        }
          
        }
      })
}