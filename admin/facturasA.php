<?php
    require_once('../base.php');
    $conex = new Conexion();
    $getConection = $conex->Conectar();
    $sql = "SELECT f.cab_codigo as Codigo, f.cab_fecha as Fecha, TO_CHAR(f.cab_subtotal, '$99,999.99') as Subtotal, TO_CHAR(f.cab_iva, '$99,999.99')  as IVA,
			TO_CHAR(f.cab_total, '$99,999.99') as Total, u.usu_nombre as Usuario, p.pe_nombre||' '||p.pe_apellido as Persona, f.cab_estado as Estado 
			FROM pbravo.fa_cabeceras f, pbravo.fa_usuarios u, pbravo.fa_personas p where u.usu_codigo = f.usu_codigo and 
			p.pe_codigo = f.pe_codigo order by 1";
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
            <a href="insertFacturaA.php" class="btn btn-warning">AGREGAR</a>
			<a href="updateFacturaA.php" class="btn btn-success">EDITAR</a>
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