
<?php 
    if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario[0] -> getid_usuario();

    $todosUsuarios = $usuario[0] -> consultarTodos();

    $producto = new producto();
    $producto = $producto -> consultarTodos();

    $cliente = new cliente();
    $cliente = $cliente -> consultarTodos();
        
    $domiciliario = new domiciliario();
    $domiciliario = $domiciliario -> consultarTodos();

    $stock = new stock();
    $stock = $stock -> consultarTodos();

    // grafica general
    $valores = [];

    for($i = 0; $i < count($producto); $i++ ){
        $valores[$i] = 0;
    }

    $carrito = new carrito();
    $carrito = $carrito -> consultarCarritosComprados();
    $carritoProducto = 0;
    if($carrito){
        foreach($carrito as $carrito_item){
            $carritoProducto = new carritoProducto();
            $carritoProducto = $carritoProducto -> cantidadProductosComprados( $carrito_item -> getid_carrito());

            foreach($carritoProducto as $carritoProducto_item){
                if($valores[ $carritoProducto_item[0] - 1 ])
                    $valores[ $carritoProducto_item[0] - 1 ] += $carritoProducto_item[1];
                else{
                    $valores[ $carritoProducto_item[0] - 1 ] = $carritoProducto_item[1];
                }
            }
        }
    }

    $compraProducto = new compraProducto();
    $compraProducto = $compraProducto -> consultarCantidadProductos();

    if($compraProducto){
        foreach($compraProducto as $compraProducto_item){
            if($valores[ $compraProducto_item[0] - 1 ])
                $valores[ $compraProducto_item[0] - 1 ] += $compraProducto_item[1];
            else{
                $valores[ $compraProducto_item[0] - 1 ] = $compraProducto_item[1];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoDomiciliario">Registrar Nuevo Domiciliario</button>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoProducto">Crear Nuevo Producto</button>

    <!-- Modal Nuevo Producto -->

    <div class="modal fade" id="nuevoProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 600px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Nuevo Producto </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div style="margin-top: 10px; margin-left: 5%; height: 100%; width: 500px">
            <div class="form-floating mb-3">
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="Altura" placeholder="Altura">
                <label for="Altura">Altura</label>
            </div>
            <div class="form-floating mb-3">
                <input type="numer" class="form-control" id="Ancho" placeholder="Ancho">
                <label for="Ancho">Ancho</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="Profundidad" placeholder="Profundidad">
                <label for="Profundidad">Profundidad</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Caracteristicas" placeholder="Caracteristicas">
                <label for="Caracteristicas">Caracteristicas</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="Valor" placeholder="Valor">
                <label for="Valor">Valor</label>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
            onclick="crearNuevoProducto()" >Crear Producto</button>
        </div>
        </div>
        </div>
        </div>

    <!-- Modal Registrar Nuevo Domiciliario -->

    <div class="modal fade" id="nuevoDomiciliario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 600px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Nuevo Domiciliario </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div style="margin-top: 10px; margin-left: 5%; height: 100%; width: 500px">
            <div class="form-floating mb-3">
                <h1>  </h1>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nuevoDomiciliarioNombre" placeholder="Nombre">
                <label for="nuevoDomiciliarioNombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nuevoDomiciliarioApellido" placeholder="Apellido">
                <label for="nuevoDomiciliarioApellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nuevoDomiciliarioCodigo" placeholder="Codigo">
                <label for="nuevoDomiciliarioCodigo">Codigo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="nuevoDomiciliarioCorreo" placeholder="Corre Electronico">
                <label for="nuevoDomiciliarioCorreo">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" autocomplete="new-password" id="nuevoDomiciliarioPassword" placeholder="Password">
                <label for="nuevoDomiciliarioPassword">Password</label>
            </div>
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
            onclick="crearNuevoDomiciliario()" >Registrar</button>
        </div>
        </div>
    </div>
    </div>



    <!-- modal grafica producto -->
    <?php 
    foreach ($producto as $producto_item){
    ?>
    <div class="modal fade" id="modalGraficaProducto<?php echo $producto_item -> getid_producto() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estadisticas Producto <?php echo $producto_item -> getid_producto() ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="graficaProducto<?php echo $producto_item -> getid_producto() ?>" 
        style="background: #ACACAC; height: 200px; width: 200px; padding:0;">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <?php 
    }
    ?>

    <!-- Modal Editar Perfil -->
    <?php 
    foreach ($cliente as $cliente_item){
        foreach ($todosUsuarios as $todosUsuarios_item){
            if( $cliente_item -> getid_usuario() == $todosUsuarios_item -> getid_usuario() ){
        ?>

    <div class="modal fade" id="modalEditarCliente<?php echo $todosUsuarios_item -> getid_usuario() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 600px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos Cliente <?php echo $cliente_item -> getnombre_cliente() ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div style="margin-top: 10px; margin-left: 5%; height: 100%; width: 500px">
            <div class="form-floating mb-3">
                <h1>  </h1>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente_item -> getnombre_cliente() ?>" id="nombre<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente_item -> getapellido_cliente() ?>" id="apellido<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Apellido">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente_item -> getdireccion_cliente() ?>" id="direccion<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Direccion">
                <label for="direccion">Direccion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $cliente_item -> gettelefono_cliente() ?>" id="numeroTelefono<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Telefono">
                <label for="numeroTelefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" value="<?php echo $todosUsuarios_item -> getcorreo_usuario() ?>" id="correo<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Corre Electronico">
                <label for="correo">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" value="<?php echo $todosUsuarios_item -> getpassword_usuario() ?>" id="password<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <!-- <div class="d-grid">
                <button onclick="crear()" name="btnCrearCuenta" class="btn btn-primary">Actualizar Datos</button>
            </div> -->
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
            onclick="actualizarDatos( <?php echo $todosUsuarios_item -> getid_usuario() ?> )" >Actualizar Datos</button>
        </div>
        </div>
    </div>
    </div>

    <!-- modal grafica cliente -->
    <div class="modal fade" id="modalGrafica<?php echo $todosUsuarios_item -> getid_usuario() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estadisticas Cliente <?php echo $cliente_item -> getnombre_cliente() ?> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="graficaCliente<?php echo $todosUsuarios_item -> getid_usuario() ?>"
        style="background: #ACACAC; height: 200px; width: 200px; padding:0;">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <?php 
                }    
                }    
                }
    ?>

     <!-- Modal Editar Domiciliario -->
     <?php 
    foreach ($domiciliario as $domiciliario_item){
        foreach ($todosUsuarios as $todosUsuarios_item){
            if( $domiciliario_item -> getid_usuario() == $todosUsuarios_item -> getid_usuario() ){
        ?>

    <div class="modal fade" id="modalEditarDomiciliario<?php echo $todosUsuarios_item -> getid_usuario() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-left: 25%">
        <div class="modal-content" style="width: 600px;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos Cliente <?php echo $todosUsuarios_item -> getid_usuario() ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        <div style="margin-top: 10px; margin-left: 5%; height: 100%; width: 500px">
            <div class="form-floating mb-3">
                <h1>  </h1>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $domiciliario_item -> getnombre_domiciliario() ?>" id="nombre<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $domiciliario_item -> getapellido_domiciliario() ?>" id="apellido<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Apellido">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?php echo $domiciliario_item -> getcodigo_domiciliario() ?>" id="direccion<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Codigo">
                <label for="direccion">Codigo</label>
            </div>
        
            <div class="form-floating mb-3">
                <input type="email" class="form-control" value="<?php echo $todosUsuarios_item -> getcorreo_usuario() ?>" id="correo<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Corre Electronico">
                <label for="correo">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" value="<?php echo $todosUsuarios_item -> getpassword_usuario() ?>" id="password<?php echo $todosUsuarios_item -> getid_usuario() ?>" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <!-- <div class="d-grid">
                <button onclick="crear()" name="btnCrearCuenta" class="btn btn-primary">Actualizar Datos</button>
            </div> -->
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
            onclick="actualizarDatos( <?php echo $todosUsuarios_item -> getid_usuario() ?> )" >Actualizar Datos</button>
        </div>
        </div>
    </div>
    </div>

    <!-- modal grafica domiciliario -->
    <div class="modal fade" id="modalGrafica<?php echo $todosUsuarios_item -> getid_usuario() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estadisticas Domiciliario <?php echo $domiciliario_item -> getnombre_domiciliario() ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="grafica<?php echo $todosUsuarios_item -> getid_usuario() ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <?php 
                }    
                }    
                }
    ?>


    <div class="container" id="graphicAndTable">
        <div class="row">
            <div class="col-6">
                <div style="">
                    <h1 style="text-align: center;">STOCK</h1>
                    <table class="table" style="">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tienda</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($stock as $stock_item){
                        ?>
                        <tr>
                            <th scope="row"> <?php echo $stock_item->getid_stock() ?> </th>
                            <td> <?php echo $stock_item->getcantidad() ?> </td>
                            <td> <?php echo $stock_item->getdisponibilidad() ?> </td>
                            <td> <?php echo $stock_item->getid_producto() ?> </td>
                            <td> <?php echo $stock_item->getid_tienda() ?> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6" id="grafica" style="background: #ACACAC; padding:0;"></div>         
        </div>
    </div>

    <!-- Tabla Producto -->

        <div class="col-12">
            <div style="">
            <h1 style="text-align: center;">PRODUCTOS</h1>
            <table class="table" style="">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">alto</th>
                <th scope="col">ancho</th>
                <th scope="col">profundidad</th>
                <th scope="col">caracteristicas</th>
                <th scope="col">estado</th>
                <th scope="col">valor</th>
                <th scope="col">N. Unidades</th>
                <th scope="col">add carrito</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($producto as $producto_item){
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $producto_item->getid_producto() ?> </th>
                        <td> <?php echo $producto_item->gety_producto() . "cm" ?> </td>
                        <td> <?php echo $producto_item->getx_producto() . "cm" ?> </td>
                        <td> <?php echo $producto_item->getz_producto() . "cm" ?> </td>
                        <td> <?php echo $producto_item->getcaracteristicas() ?> </td>
                        <td> <?php echo $producto_item->getestado_producto() ?> </td>
                        <td> <?php echo "$".$producto_item->getvalor_producto() ?> </td>
                        <td>
                        <select id="cantidadProductoAdd<?php echo $producto_item->getid_producto(); ?>" onchange="cantidadAdd( <?php echo $producto_item->getid_producto(); ?> )" id="cantidadProducto" style="width:60px">
                            <option value="10"> 10 </option>
                            <option value="20"> 20 </option>
                            <option value="30"> 30 </option>
                            <option value="40"> 40 </option>
                            <option value="otro">Otro</option>
                        </select>
                        <input id="cantidadProductoOtroAdd<?php echo $producto_item->getid_producto(); ?>" type="number" min="1" max="10" style="display:none">
                        </td>
                        <td><button type="button" class="btn btn-success" id="comprarStock<?php echo $producto_item -> getid_producto() ?>"
                        onclick="comprarProductoStock(<?php echo $producto_item -> getid_producto() ?>)">Buy</button></td> 
                        <td><button type="button" class="btn btn-dark" id="verGraficoProducto<?php echo $producto_item -> getid_producto() ?>"
                        onclick="drawPieChart( <?php echo $producto_item -> getid_producto() ?> )"
                        data-bs-toggle="modal" data-bs-target="#modalGraficaProducto<?php echo $producto_item -> getid_producto() ?>">Ver Grafico</button></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>

    <!-- Tabla Clientes -->
        <div class="col-12">
            <div style="">
            <h1 style="text-align: center;">Clientes</h1>
            <table class="table" style="">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">nombre</th>
                <th scope="col">apellido</th>
                <th scope="col">direccion</th>
                <th scope="col">telefono</th>
                <th scope="col">fecha nacimiento</th>
                <th scope="col">Estado</th>
                <th scope="col">editar</th>
                <th scope="col">cambiar estado</th>
                <th scope="col">Ver Grafico</th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($cliente as $cliente_item){
                    foreach ($todosUsuarios as $todosUsuarios_item){
                        if( $cliente_item -> getid_usuario() == $todosUsuarios_item -> getid_usuario() ){
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $cliente_item->getid_cliente() ?> </th>
                        <td> <?php echo $cliente_item->getnombre_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getapellido_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getdireccion_cliente() ?> </td>
                        <td> <?php echo $cliente_item->gettelefono_cliente() ?> </td>
                        <td> <?php echo $cliente_item->getfechaNacimiento_cliente() ?> </td>
                        <td> <?php echo $todosUsuarios_item -> getestado_usuario() ?> </td>
                        <td><button type="button" class="btn btn-primary" id="Editar<?php echo $todosUsuarios_item -> getid_usuario() ?>"
                        data-bs-toggle="modal" data-bs-target="#modalEditarCliente<?php echo $todosUsuarios_item -> getid_usuario() ?>" >Editar</button></td> 
                        <td><button type="button" class="btn btn-danger">Cambiar Estado</button></td> 
                        <td><button type="button" class="btn btn-dark" id="verGrafico<?php echo $todosUsuarios_item -> getid_usuario() ?>"
                        onclick="drawPieChartCliente( <?php echo $todosUsuarios_item -> getid_usuario() ?> )"
                        data-bs-toggle="modal" data-bs-target="#modalGrafica<?php echo $todosUsuarios_item -> getid_usuario() ?>">Ver Grafico</button></td>
                        
                    </tr>
                    <?php
                        }
                    }
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>

    <!-- Tabla Domiciliario -->
    <div class="col-12">
        <div style="">
        <h1 style="text-align: center;">Domiciliarios</h1>
        <table class="table" style="">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">nombre</th>
            <th scope="col">apellido</th>
            <th scope="col">codigo</th>
            <th scope="col">estado</th>
            <th scope="col">editar</th>
            <th scope="col">cambiar estado</th>
            <th scope="col">Ver Graficos</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($domiciliario as $domiciliario_item){
                foreach ($todosUsuarios as $todosUsuarios_item){
                    if( $domiciliario_item -> getid_usuario() == $todosUsuarios_item -> getid_usuario() ){
                ?>
                <tr>
                    <th scope="row"> <?php echo $domiciliario_item->getid_domiciliario() ?> </th>
                    <td> <?php echo $domiciliario_item->getnombre_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getapellido_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getcodigo_domiciliario() ?> </td>
                    <td> <?php echo $domiciliario_item->getestado_domiciliario() ?> </td>
                    <td><button type="button" class="btn btn-primary"id="Editar<?php echo $todosUsuarios_item -> getid_usuario() ?>"
                        data-bs-toggle="modal" data-bs-target="#modalEditarDomiciliario<?php echo $todosUsuarios_item -> getid_usuario() ?>">Editar</button></td> 
                    <td><button type="button" class="btn btn-danger">Cambiar Estado</button></td> 
                    <td><button type="button" class="btn btn-dark" id="verGrafico<?php echo $todosUsuarios_item -> getid_usuario() ?>"
                    data-bs-toggle="modal" data-bs-target="#modalGrafica<?php echo $todosUsuarios_item -> getid_usuario() ?>">Ver Grafico</button></td>
                        
                </tr>
                <?php
                    }
                }
            }
            ?>
        </tbody>
        </table>
        </div>
    </div>


</body>
</html>

<?php 

} else{
    echo "error";
}
?>


<script>
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawChart);


      function drawChart() {
        // grafica de barras
        let data_bar = google.visualization.arrayToDataTable([
            ['productos', 'cantidad'],
            <?php 
            for($i = 0; $i < count($valores); $i++){
                echo "[". ($i+1) .", ".$valores[$i]."],\n";
            }
            ?>
        ]);

        let options_bar = {
          chart: {
            title: 'Company Pronto Muebles',
          }
        };

        let chart = new google.charts.Bar(document.getElementById('grafica'));
        chart.draw(data_bar, google.charts.Bar.convertOptions(options_bar));
      }

    
      function drawPieChart(idProducto){
        let data = google.visualization.arrayToDataTable([
            ['Producto', 'Cantidad'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
            ]);

            let options = {
            title: 'My Daily Activities'
            };

            let chart = new google.visualization.PieChart(document.getElementById('graficaProducto'+idProducto));
            chart.draw(data, options);
        }

    function drawPieChartCliente(idUsuario){
        let array;
        let datos  = [ ['Producto', 'Cantidad'] ];
        
        $.ajax({    
            url: "funciones.php",
            type: 'POST',
            data: {
                opcion: 'drawPieChartCliente',
                idUsuario: idUsuario,
            },
        }).done(function(response){
            array = JSON.parse(response);
            console.log(array)
            for( const index in array ){
                datos.push([index , parseInt(array[index])])
            }
            console.log(datos)

            let data = google.visualization.arrayToDataTable(
                datos
            );

            let options = {
            title: 'My Daily Activities'
            };

            let chart = new google.visualization.PieChart(document.getElementById('graficaCliente'+idUsuario));
            chart.draw(data, options);
        })
    
    }
      
</script>

<script>
function cantidadAdd(id){
    let opcion = document.getElementById("cantidadProductoAdd"+id);
    let input = document.getElementById("cantidadProductoOtroAdd"+id);
    let eleccion = opcion.value

    if(eleccion == "otro"){
        input.style.display = "inline"
    }else{
        input.style.display = "none"
    }
}

function otroCantidad(id){
    let opcion = document.getElementById("cantidadProducto"+id);
    let input = document.getElementById("cantidadProductoOtro"+id);
    let eleccion = opcion.value

    if(eleccion == "otro"){
        input.style.display = "inline"
    }else{
        input.style.display = "none"
    }
}

function crearNuevoProducto(){

    let Altura = document.getElementById("Altura").value;
    let Ancho = document.getElementById("Ancho").value;
    let Profundidad = document.getElementById("Profundidad").value;
    let Caracteristicas = document.getElementById("Caracteristicas").value;
    let Valor = document.getElementById("Valor").value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'crearNuevoProducto',
            altura: Altura,
            ancho: Ancho,
            profundidad: Profundidad,
            caracteristicas: Caracteristicas,
            valor: Valor,
        },
    }).done(function(response){

        if(response == 1){
            alert("Nuevo Producto Creado");
            location.replace("index.php?");
        }else{
            alert("Error"+response);          
        }
    })
}

function crearNuevoDomiciliario(){
    let nombre = document.getElementById("nuevoDomiciliarioNombre").value;
    let apellido = document.getElementById("nuevoDomiciliarioApellido").value;
    let codigo = document.getElementById("nuevoDomiciliarioCodigo").value;
    let correo = document.getElementById("nuevoDomiciliarioCorreo").value;
    let password = document.getElementById("nuevoDomiciliarioPassword").value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'crearNuevoDomiciliario',
            nombre: nombre,
            apellido: apellido,
            codigo: codigo,
            correo: correo,
            password: password,
        },
    }).done(function(response){

        if(response == 1){
            alert("Nuevo Domiciliario Creado");
            location.replace("index.php?");
        }else{
            alert("Error"+response);          
        }
    })
}

function actualizarGraphicAndTableStock(){
    let graphic = document.getElementById("graphicAndTable");

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarGraphicAndTableStock',
        },
    }).done(function(response){
        graphic.innerHTML = response;
        drawChart();
    })
}

setInterval(() => {
    actualizarGraphicAndTableStock();
}, 3000);


function actualizarEStado(idUsuario){
    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarEStado',
            idUsuario: idUsuario,
            estado: 0,
        },

    }).done(function(response){

        if(response == 1){
            alert("Estado del Usuario Actualizado");          
        }else{
            alert("Error"+response);          
        }
    })
}

function actualizarDatos(idUsuario){

    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let direccion = document.getElementById("direccion").value;
    let numero = document.getElementById("numeroTelefono").value;
    let correo = document.getElementById("correo").value;
    let password = document.getElementById("password").value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'actualizarDatos',
            idUsuario: idUsuario,
            nombre: nombre,
            apellido: apellido,
            direccion: direccion,
            numero: numero,
            correo: correo,
            password: password,
        },

    }).done(function(response){

        if(response == 1){
            alert("Datos Actualizados");          
        }else{
            alert("Error"+response);          
        }
    })
}

function crearFacturaProducto(idCompra, idUsuario){
    $.ajax({
        url: "crearPdf.php",
        type: 'POST',
        data: {
            opcion: 'producto',
            idCompra: idCompra,
            idUsuario: idUsuario,
        },

    }).done(function(response){
        console.log(response)
    })
}

function comprarProductoStock( idProducto ){

    let cantidad = document.getElementById("cantidadProductoAdd"+idProducto).value;
    let cantidadOtro = document.getElementById("cantidadProductoOtroAdd"+idProducto).value;

    $.ajax({
        url: "funciones.php",
        type: 'POST',
        data: {
            opcion: 'comprarProductoStock',
            idProducto: idProducto ,
            cantidad: cantidad,
            cantidadOtro: cantidadOtro,
        }
    }).done(function(response){

        if(response == 1){
            alert('Compra Exitosa');
            location.replace("index.php?");
        }else{
            alert("Error"+response)            
        }
    })

}
</script>

