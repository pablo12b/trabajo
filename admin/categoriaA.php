<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $sql = "SELECT cat_codigo as Codigo, cat_nombre as Nombre FROM pbravo.fa_categoria order by 1";
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
        <title>Categoria Administrador</title>
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
            <a href="insertCategoriaA.php" class="btn btn-warning">AGREGAR</a>
            <td><a href="updateCategoriaA.php" class="btn btn-success">EDITAR</a></td>
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