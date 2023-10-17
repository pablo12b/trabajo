<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $mostrar = false;
    $stmt;
    if(isset($_POST['buscar'])){
        $pro_nombre = $_POST['pro_nombre'];
        $sql = "SELECT p.pro_codigo as Codigo, p.pro_barras as Barras, p.pro_nombre as Nombre, TO_CHAR(p.pro_precio, '$99,999.99') as Precio,
        p.pro_stock as Stock, p.pro_if_iva as IVA, c.cat_nombre Categoria 
        FROM pbravo.fa_productos p, pbravo.fa_categoria c WHERE p.pro_nombre LIKE '%$pro_nombre%' and p.cat_codigo = c.cat_codigo order by 1";
        $stmt = $getConection->prepare($sql);
        $stmt->execute();
        $primeravez=true;
        $mostrar = true;
    }
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
        <form action="" method="post">
            <input type="text" class="form-control m-3" name = "pro_nombre" placeholder="inserte: Nombre Producto">
            <button type="text" class="btn btn-success m-3" name = "buscar" type="submit">Buscar</button>
        </form>
       
        <div class="container">
            <?php if($mostrar){?>
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
            <?php } ?>
        </div>
    </body>
</html>