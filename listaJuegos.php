<?php //inicio la secion
if (!isset($_SESSION)) {
    session_start(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de juegos</title>
</head>
<body>
    <?php 
    include("includes/header.php"); 
    include("connections/querys/conn-juego.php");
    ?>
</body>
</html>