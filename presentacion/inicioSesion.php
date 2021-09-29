
<?php ?>
<?php 

    if(isset($_GET['correo']) && isset($_GET['password'])){
        $correo = $_GET['correo'];
        $password = $_GET['password'];
        
        $usuario = new usuario();
        $usuario = $usuario->buscarUsuario($correo, $password);

        if($usuario){
            session_start();
            $_SESION['usuario'] = $usuario;
        }
    }
if(!isset($_SESSION)){
?>

<div style="margin-top: 10%; margin-left: 30%; height: 100%; width: 500px">
    <div class="form-floating mb-3">
        <h1>Inicio de Sesion</h1>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="correo" required placeholder="Corre Electronico">
        <label for="correo">Correo Electronico</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" required placeholder="Password">
        <label for="password">Password</label>
    </div>
    <div class="d-grid">
        <button type="submit" name="btnIniciarSesion" id="btnIniciarSesion" class="btn btn-primary">Iniciar Sesion</button>
    </div>
</div> 

<?php 
}else {

    if($usuario[0] -> getid_tipoUsuario() == 1){
        ?>
        <h1>administrador</h1>
        <?php
    }elseif ($usuario[0] -> getid_tipoUsuario() == 2){
        ?>
        <h1>domiciliario</h1>
        <?php
    }elseif ($usuario[0] -> getid_tipoUsuario() == 3){
        ?>
        <h1>cliente</h1>
        <?php include "./presentacion/vistas/cliente/paginaGeneral.php"; ?> 
        <?php
    }else{
        echo "Error :c";
    }
}
?>
<script>
$("#btnIniciarSesion").click(function(e){
    let correo = $("#correo").val();
    let password = $("#password").val();
    let url = "index.php?opcion=iniciarSesion" + "&correo=" + correo + '&password=' + password;
    location.replace(url);
    e.preventDefault(); 
})
</script>