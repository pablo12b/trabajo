<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    if(isset($_POST['success'])){
        $pro_barras = $_POST['pro_barras'];
        $pro_nombre = $_POST['pro_nombre'];
        $pro_precio = $_POST['pro_precio'];
        $pro_stock = $_POST['pro_stock'];
        $pro_if_iva = $_POST['pro_if_iva'];
        $cat_codigo = $_POST['cat_codigo'];
        echo "
        <br>----$pro_barras
        <br>----$pro_nombre
        <br>----$pro_precio
        <br>----$pro_stock
        <br>----$pro_if_iva
        <br>----$cat_codigo";
        $sql = "INSERT INTO pbravo.fa_productos (pro_codigo, pro_barras, pro_nombre, pro_precio, pro_stock, pro_if_iva, cat_codigo)
        values (pbravo.sec_productos.nextVal, '$pro_barras', '$pro_nombre', '$pro_precio', '$pro_stock', '$pro_if_iva', '$cat_codigo')";
        try{
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
    }
    if(isset($_POST['volver'])){
        header("Location: productoA.php");
        exit;
    }
?>

<html>
    <head>
        <title>Insertar Producto - Empleado</title>
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
            <img src="../img/logo.jpg" class="img-fluid" alt="..." preserveAspectRatio="xMidYMid slice" width="100%" height="100">
            <input type="text" class="form-control m-3" name = "pro_barras" placeholder="inserte: pro_barras">
            <input type="text" class="form-control m-3" name = "pro_nombre" placeholder="inserte: pro_nombre">
            <input type="text" class="form-control m-3" name = "pro_precio" placeholder="inserte: pro_precio (##,##)">
            <input type="text" class="form-control m-3" name = "pro_stock" placeholder="inserte: pro_stock">
            <input type="text" class="form-control m-3" name = "pro_if_iva" placeholder="inserte: pro_if_iva (S=Si tiene iva) (N=No tiene iva)">
            <input type="text" class="form-control m-3" name = "cat_codigo" placeholder="inserte: cat_codigo">
            <button type="text" class="btn btn-success m-3" name = "success" type="submit">Insertar</button>
            <button type="text" class="btn btn-warning m-3" name = "volver" href="productoA.php" type="submit">Volver</button>
        </form>
    </body>
</html>