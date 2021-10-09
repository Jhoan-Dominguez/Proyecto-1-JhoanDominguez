
<div style="margin-top: 10px; margin-left: 30%; height: 100%; width: 500px">
    <div class="form-floating mb-3">
        <h1>Registro de Usuario</h1>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
        <label for="nombre">Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="apellido" placeholder="Apellido">
        <label for="apellido">Apellido</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="direccion" placeholder="Direccion">
        <label for="direccion">Direccion</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numeroTelefono" placeholder="Telefono">
        <label for="numeroTelefono">Telefono</label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="yearBorn" placeholder="Year Born">
        <label for="yearBorn">Year Born</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="correo" placeholder="Corre Electronico">
        <label for="correo">Correo Electronico</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Password</label>
    </div>
    <div class="d-grid">
        <button onclick="crear()" name="btnCrearCuenta" class="btn btn-primary">Crear Cuenta</button>
    </div>
</div>

<script>
  function crear(){
        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let direccion = $("#direccion").val();
        let telefono = $("#numeroTelefono").val();
        let yearBorn = $("#yearBorn").val();
        let correo = $("#correo").val();
        let password = $("#password").val();

        if ( nombre.length==0 || apellido.length==0 || direccion.length==0 || telefono.length==0 || numeroTelefono.length==0 || 
            yearBorn.length==0 || correo.length==0 || password.length==0 ){
                alert("No se permiten campos vacios")
            }
        $.ajax({
            url: "funciones.php",
            type: 'POST',
            data: {
                opcion: 'crearCuenta',
                nombre: nombre,
                apellido: apellido,
                direccion: direccion,
                telefono: telefono,
                yearBorn: yearBorn,
                correo: correo,
                password: password,
            }
        }).done(function(response){

            if(response == 0){
                alert(response)
            }else{
                alert('usuario creado con exito')
                location.replace("index.php?");
            }
        })

    }
</script>