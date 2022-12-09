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
    <title>Lista de juegos</title>
</head>

<body>
    <?php
    include("includes/header.php");
    //include("connections/querys/conn-juego.php");
    $juegos = stonksGetNombreJuegos($conn_localhost);
    foreach ($juegos as $i => $value) {
        # code...
    

    ?>
    <div>
        <h2>
            <?php echo $juegos[$i]['nombre'] ?>
        </h2>
        <div>
            <p>
                <b>Descripcion:</b> <br>
                <?php echo $juegos[$i]['descripcion']; ?> <br>
                <b>Genero:</b>
                <?php echo $juegos[$i]['idGenero']['nombre']; ?> <br>
                <?php echo ("<a href=\"newVenta.php?id=".$juegos[$i]['id']."\">Comprar</a>"); ?>
            </p>
        </div>
    </div>


    <?php

}
        ?>
</body>

</html>