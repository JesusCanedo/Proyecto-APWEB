<?php 
$inc = include("connections/conn_localhost.php"); 
if ($inc){
    $consulta = "SELECT * FROM juegos";
    $resultado = mysqli_query($conn_localhost,$consulta);
  // mostrar el nombre y la descripción
  if($resultado){
    while($row = $resultado->fetch_array()){
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      ?> 
      <div>
        <h2><?php echo $nombre ?></h2>
        <div>
          <p>
            <b>Descripcion:</b> <?php echo $descripcion; ?> <br>
          </p>
        </div>
      </div>
      <?php
    }
  }
}
  
?>