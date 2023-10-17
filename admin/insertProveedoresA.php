<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    if(isset($_POST['success'])){
        $fac_numero = $_POST['fac_numero'];
        $fac_fecha = $_POST['fac_fecha'];
        $fac_valor = $_POST['fac_valor'];
        $fac_cantidad = $_POST['fac_cantidad'];
        $prov_codigo = $_POST['prov_codigo'];
        $pro_codigo = $_POST['pro_codigo'];
        $sql = "insert into pbravo.fa_factura_proveedores (fac_codigo, fac_numero, fac_fecha, fac_valor, fac_cantidad, prov_codigo, pro_codigo)
        values (pbravo.sec_factura_proveedores.nextVal, '$fac_numero', to_date('".$fac_fecha."','yyyy-mm-dd'), '$fac_valor', '$fac_cantidad', '$prov_codigo', '$pro_codigo')";
        try{
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $sql = "select pro_stock as pro_stock from pbravo.fa_productos where pro_codigo='$pro_codigo'";
        try{
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_stock = $rowLastId['pro_stock'];
        $pro_stock = $pro_stock + $fac_cantidad;
        $sql = "update pbravo.fa_productos set pro_stock='$pro_stock' where pro_codigo='$pro_codigo'";
        try{
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
    }
    if(isset($_POST['volver'])){
        header("Location: proveedoresA.php");
        exit;
    }
?>

<html>
    <head>
        <title>Insertar Factura Proveedor - Administrador</title>
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
            <input type="text" class="form-control m-3" name = "fac_numero" placeholder="inserte: Numero ">
            <input type="text" class="form-control m-3" name = "fac_fecha" placeholder="inserte: Fecha (yyyy-mm-dd)">
            <input type="text" class="form-control m-3" name = "fac_valor" placeholder="inserte: Valor (##,##)">
            <input type="text" class="form-control m-3" name = "fac_cantidad" placeholder="inserte: Cantidad">
            <input type="text" class="form-control m-3" name = "prov_codigo" placeholder="inserte: Proveedor">
            <input type="text" class="form-control m-3" name = "pro_codigo" placeholder="inserte: Producto">
            <button type="text" class="btn btn-success m-3" name = "success" type="submit">Insertar</button>
            <button type="text" class="btn btn-warning m-3" name = "volver" href="proveedoresA.php" type="submit">Volver</button>
        </form>
    </body>
</html>