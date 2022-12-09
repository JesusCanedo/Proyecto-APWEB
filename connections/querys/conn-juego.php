<?php
$inc = include("connections/conn_localhost.php");
if ($inc) {
  $consulta = "SELECT * FROM juegos";
  $resultado = mysqli_query($conn_localhost, $consulta);
  // mostrar el nombre y la descripción
  echo ("<br><br><br><br><br>");







  
  if ($resultado) {
    while ($row = $resultado->fetch_array()) {
      $id = $row['id'];
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];






      
?>
<div>
  <h2>
    <?php echo $nombre ?>
  </h2>
  <div>
    <p>
      <b>Descripcion:</b> <br>
      <?php echo $descripcion; ?> <br>
      <?php echo ("<a href=\"newVenta.php?id=$id\">Comprar</a>"); ?>
    </p>
  </div>
</div>
<?php
      
    }
  }
}

      ?>