<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Fetch records from database 
$query = $db->query("SELECT i.* , p.descripcion descripcionProducto , p.cat_idcategoria , p.imagen , c.desc descripcionCategoria FROM inventario i  INNER JOIN producto p on i.prd_idproducto = p.idproducto LEFT JOIN categoria c on c.idcategoria = p.cat_idcategoria;"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('idinventario', 'fc_ini', 'fc_fin', 'stk_inicial', 'entradas', 'salidas', 'total', 'prd_idproducto', 'descripcionProducto', 'cat_idcategoria', 'imagen', 'descripcionCategoria'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['idinventario'], $row['fc_ini'], $row['fc_fin'], $row['stk_inicial'], $row['entradas'], $row['salidas'], $row['total'],  $row['prd_idproducto'], $row['descripcionProducto'], $row['cat_idcategoria'], $row['imagen'], $row['descripcionCategoria']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>