<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();

    if(isset($_POST['success'])){
        $cat_nombre = $_POST['cat_nombre'];
        try{
            $sql = "insert into pbravo.fa_categoria (cat_codigo, cat_nombre) values (pbravo.sec_categorias.nextVal, '$cat_nombre')";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
    }
    if(isset($_POST['volver'])){
        header("Location: categoriaA.php");
        exit;
    }
?>

<html>
    <head>
        <title>Insertar Categoria - Administrador</title>
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
            <input type="text" class="form-control m-3" name = "cat_nombre" placeholder="inserte: Nombre">
            <button type="text" class="btn btn-success m-3" name = "success" type="submit">Insertar</button>
            <button type="text" class="btn btn-warning m-3" name = "volver" href="categoriaA.php" type="submit">Volver</button>
        </form>
    </body>
</html>
