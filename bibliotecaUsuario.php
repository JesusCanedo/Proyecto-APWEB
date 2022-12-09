<?php //inicio la secion
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['compra'])) {
    header('Location: newVenta.php?id=' . $_GET['id']);
}
include("connections/querys/DBstonks.php");
include("connections/conn_localhost.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleTienda.css">
    <title>Biblioteca</title>
</head>

<body>
    <?php
    include("includes/header.php");
    //include("connections/querys/conn-juego.php");
    $juegos = stonksGetNombreJuegos($conn_localhost);
    $biblioteca = stonksGetBibliotecaUsuario($conn_localhost, $_SESSION['userId']);
    foreach ($biblioteca as $i => $value) {
        # code...
    if ($biblioteca[$i]['idUsuario'] == $_SESSION['userId']) {
        # code...
   

    ?>
    <div>
        <h2>
            
            <?php
            // nombre del juego
        echo $biblioteca[$i]['idJuego']['nombre']; ?>
        </h2>
        <div>
            <p>
                <b>Descripcion:</b> <br>
                <?php echo $biblioteca[$i]['idJuego']['descripcion']; ?> <br>
                <b>Genero:</b>
                <?php echo $biblioteca[$i]['idJuego']['idGenero']['nombre']; ?> <br>
            </p>
        </div>
    </div>


    <?php
 }
}
        ?>
</body>

</html>