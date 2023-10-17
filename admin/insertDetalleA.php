<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();

    if(isset($_POST['success'])){
        $det_cantidad = $_POST['det_cantidad'];
        $det_cantidad = intval($det_cantidad);
        $det_preciou = 0.00;
        $det_subtotal=0.00;
        $pro_codigo = $_POST['pro_codigo'];
        $cab_codigo = $conex->returnCabecera();
        try{
            $sql = "select pro_stock as pro_stock from pbravo.fa_productos where pro_codigo='$pro_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_stock = $rowLastId['pro_stock'];
        $pro_stock = $pro_stock - $det_cantidad;
        if($pro_stock < $det_cantidad || $det_cantidad <= 0){
            header("Location: insertDetalleA.php");
            $pro_stock= $pro_stock + $det_cantidad;
            $det_cantidad = 0;
        } else if ($pro_stock <= '5' or $pro_stock >= '1') {
            echo "<script>alert('El stock del producto es: $pro_stock. Intentar con otro producto.');</script>";
        } 
        try{
            $sql = "update pbravo.fa_productos set  pro_stock = '$pro_stock' where pro_codigo = '$pro_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        try{
            $sql = "select pro_precio as pro_precio from pbravo.fa_productos where pro_codigo='$pro_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $det_preciou = $rowLastId['pro_precio'];
        $det_preciou = str_replace(",", ".", $det_preciou);
        $det_preciou = floatval($det_preciou);
        $det_subtotal = $det_preciou * $det_cantidad;
        $det_subtotal=(float)$det_subtotal;
        try{
            $sql = "select pro_if_iva as pro_if_iva from pbravo.fa_productos where pro_codigo='$pro_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $iva = $rowLastId['pro_if_iva'];
        if($iva == 'S'){
            $det_iva = $det_subtotal * 0.12;
            $det_iva = (double)$det_iva;
        } else {
            $det_iva = 00.00;
        }
        $det_total = $det_subtotal + $det_iva;
        $det_preciou = str_replace(".", ",", $det_preciou);
        $det_subtotal = str_replace(".", ",", $det_subtotal);
        $det_iva = str_replace(".", ",", $det_iva);
        $det_total = str_replace(".", ",", $det_total);
        try{
            $sql = "insert into pbravo.fa_detalles (det_codigo, det_cantidad, det_preciou, det_subtotal, det_iva, det_total, pro_codigo, cab_codigo)
            values (pbravo.sec_detalles.nextVal, '$det_cantidad', '$det_preciou', '$det_subtotal', '$det_iva', '$det_total', '$pro_codigo', '$cab_codigo')";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        try{
            $sql = "select cab_subtotal as cab_subtotal from pbravo.fa_cabeceras where cab_codigo='$cab_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $cab_subtotal = $rowLastId['cab_subtotal'];
        $cab_subtotal = str_replace(",", ".", $cab_subtotal);
        $cab_subtotal = $cab_subtotal+$det_subtotal;
        $cab_subtotal = str_replace(".", ",", $cab_subtotal);
        try{
            $sql = "select cab_iva as cab_iva from pbravo.fa_cabeceras where cab_codigo='$cab_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $cab_iva = $rowLastId['cab_iva'];
        $cab_iva = str_replace(",", ".", $cab_iva);
        $cab_iva = $cab_iva+$det_iva;
        $cab_iva = str_replace(".", ",", $cab_iva);
        try{
            $sql = "select cab_total as cab_total from pbravo.fa_cabeceras where cab_codigo='$cab_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $cab_total = $rowLastId['cab_total'];
        $cab_total = str_replace(",", ".", $cab_total);
        $cab_total = $cab_total+$det_total;
        $cab_total = str_replace(".", ",", $cab_total);
        try{
            $sql = "update pbravo.fa_cabeceras set cab_subtotal = '$cab_subtotal',
            cab_iva = '$cab_iva', cab_total = '$cab_total' where cab_codigo = '$cab_codigo'";
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
    }
    if(isset($_POST['volver'])){
        header("Location: facturasA.php");
        exit;
    }
    if(isset($_POST['info'])){
        header("Location: ../correo.php");
        header("Location: ../invoice.php");
        exit;
    }
?>

<html>
    <head>
    <title>Insertar Detalle - Administrador</title>
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
            <input type="text" class="form-control m-3" name = "det_cantidad" placeholder="inserte: Cantidad">
            <input type="text" class="form-control m-3" name = "pro_codigo" placeholder="inserte: Produto">
            <button type="text" class="btn btn-success m-3" name = "success" type="submit">Insertar</button>
            <button type="text" class="btn btn-info" name = "info" type="submit">Facturar</button>
            <button type="text" class="btn btn-warning m-3" name = "volver" href="facturasA.php" type="submit">Volver</button>
        </form>
    </body>
</html>