<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $sql = "SELECT f.det_codigo as Codigo, f.det_cantidad as Cantidad, TO_CHAR(f.det_preciou, '$99,999.99') as Precio, TO_CHAR(f.det_subtotal, '$99,999.99') as Subtotal,
            TO_CHAR(f.det_iva, '$99,999.99') as IVA, TO_CHAR(f.det_total, '$99,999.99') as Total, p.pro_nombre as Produto, f.cab_codigo as Cabecera FROM pbravo.fa_detalles f,
            pbravo.fa_productos p where p.pro_codigo = f.pro_codigo order by 1";
    $stmt = $getConection->prepare($sql);
    $stmt->execute();
    $primeravez=true;
    if(isset($_POST['cerrar'])){
        header("Location: ../conexion.php");
        $conex->cerrar();
        exit;
    }
?>

<html>
    <head>
        <title>Detalle Administrador</title>
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