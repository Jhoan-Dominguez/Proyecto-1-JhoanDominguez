
<?php ?>
<?php 
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
    header('Location: ./index.php?');
    die();
}
?>
<script>
$("#btnIniciarSesion").click(function(e){
    let correo = $("#correo").val();
    let password = $("#password").val();
    let url = "index.php?correo=" + correo + '&password=' + password;
    location.replace(url);
    e.preventDefault(); 
})
</script>