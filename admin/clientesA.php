<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $sql = "SELECT pe_codigo as Codigo, pe_cedula as Cedula, pe_nombre as Nombre, pe_apellido as Apellido, 
            pe_direccion as Direccion, pe_telefono as Telefono, pe_correo as Correo, pe_estado as Estado
            FROM pbravo.fa_personas where pe_empleado='C' order by 1";
    $stmt = $getConection->prepare($sql);
    $stmt->execute();
    $primeravez=true;
?>

<html>
    <head>
        <title>Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../estilos/meni.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <header>
        <div class="container">
            <div class="menu">
                <a href="inicioA.php" class="logo">Principal</a>
                <ul>
                    <li><a href="facturasA.php">Facturar</a></li>
                    <li><a href="clientesA.php">Clientes</a></li>
                    <li><a href="productoA.php">Productos</a></li>
                    <li><a href="categoriaA.php">Categorias</a></li>
                    <li><a href="detalleA.php">Detalle</a></li>
                    <li><a href="proveeA.php">Proveedores</a></li>
                    <li><a href="proveedoresA.php">Factura Proveedores</a></li>
                    <li><a href="../conexion.php" name="cerrar" method="post">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </header>
        
    <body>
        <div class="container">
            <a href="insertClienteA.php" class="btn btn-warning">AGREGAR</a>
            <a href="updateClienteA.php" class="btn btn-success">EDITAR</a>
            <table class="table table-striped table-hover">
                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if($primeravez){?>
                    <thead>
                        <tr>
                        <?php   
                            foreach($row as $key=>$value){
                                echo '<th scope="col">'.strtoupper($key).'</th>';
                            }
                            $primeravez = false;
                        }?>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <?php 
                                foreach($row as $key=>$value){
                                    echo '<td>'.$value.'</td>';
                                }
                            ?>
                        </tr>
                    </tbody>
                <?php }?>
            </table>				
        </div>
    </body>
</html>