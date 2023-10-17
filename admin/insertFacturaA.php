<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $usu_nombre = $conex->volver();

    if(isset($_POST['success'])){
        $cab_fecha = date('Y-m-d');
        $pe_codigo = $_POST['pe_codigo'];
        $sql = "insert into pbravo.fa_cabeceras (cab_codigo, cab_fecha, cab_subtotal, cab_iva, cab_total, usu_codigo, pe_codigo, cab_estado)
        values (pbravo.sec_cabeceras.nextVal, to_date('".$cab_fecha."','yyyy-mm-dd'), '00,00', '00,00', '00,00', 
        (select usu_codigo from pbravo.fa_usuarios where usu_nombre = '$usu_nombre'), '$pe_codigo', 'S')";
        try{
            $stmt = $getConection->prepare($sql);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $cabecera_id = "SELECT MAX(cab_codigo) AS last_id FROM pbravo.FA_CABECERAS";
        try{
            $stmt = $getConection->prepare($cabecera_id);
            $stmt->execute();
        }catch(PDOExeption $e){
            echo "No se inserto el dato por el error: <br>".$e->getMessage()."<br>".$sql;
        }
        $rowLastId = $stmt->fetch(PDO::FETCH_ASSOC);
        $last_id = $rowLastId['last_id'];
        $conex->insertcabecera($last_id);
        header("Location: insertDetalleA.php");
        exit;
    }
    if(isset($_POST['volver'])){
        header("Location: facturasA.php");
        exit;
    }
?>

<html>
    <head>
        <title>Insertar Factura - Administrador</title>
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
            <input type="text" class="form-control m-3" name = "pe_codigo" placeholder="inserte: Persona">
            <button type="text" class="btn btn-success m-3" name = "success" type="submit">Insertar</button>
            <button type="text" class="btn btn-warning m-3" name = "volver" href="facturasA.php" type="submit">Volver</button>
        </form>
    </body>
</html>