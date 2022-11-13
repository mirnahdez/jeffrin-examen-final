<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<!-- Export link -->
<div class="col-md-12 head">
    <div class="float-right">
        <a href="exportData.php" class="btn btn-success btn-block"><i class="dwn"></i>Exportar archivo CSV</a>
    </div>
</div>

<!-- Data list table --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#ID</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>F. Inicio</th>
            <th>F. Fin</th>
            <th>C. Inicial</th>
            <th>Entradas</th>
            <th>Salidas</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
   <?php 
    // Database configuration 
    $dbHost     = "localhost"; 
    $dbUsername = "root"; 
    $dbPassword = "jeffrin123"; 
    $dbName     = "mydb"; 
     
    // Create database connection 
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
     
    // Check connection 
    if ($db->connect_error) { 
        die("Connection failed: " . $db->connect_error); 
    }
    
    // Fetch records from database 
    $result = $db->query("SELECT i.* , p.descripcion descripcionProducto, p.cat_idcategoria, p.imagen, c.desc descripcionCategoria FROM inventario i  INNER JOIN producto p on i.prd_idproducto = p.idproducto LEFT JOIN categoria c on c.idcategoria = p.cat_idcategoria;"); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
    ?>
        <tr>
            <td><?php echo $row['idinventario']; ?></td>
            <td><?php echo $row['descripcionProducto']; ?></td>
            <td><?php echo $row['descripcionCategoria']; ?></td>
            <td><?php echo $row['fc_ini']; ?></td>
            <td><?php echo $row['fc_fin']; ?></td>
            <td><?php echo $row['stk_inicial']; ?></td>
            <td><?php echo $row['entradas']; ?></td>
            <td><?php echo $row['salidas']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="7">No member(s) found...</td></tr>
    <?php } ?>
    </tbody>
</table>