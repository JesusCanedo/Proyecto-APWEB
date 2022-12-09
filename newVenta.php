<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
    //checamos si inicio sesion
    if (!isset($_SESSION['userId']))
        header('Location: userLogin.php?auth=false');

}

include("connections/conn_localhost.php");
include("connections/querys/DBstonks.php");
//pedimos los generos para el formulario
$juegos = stonksGetNombreJuegos($conn_localhost);
$bibloteca = stonksGetBibliotecaUsuario($conn_localhost, $_SESSION['userId']);

//el formulario se envio
if (isset($_GET['id'])) {
    foreach ($juegos as $key => $value) {
        if ($juegos[$key]['id'] == $_GET['id']) {
            $indiceJuego = $key;
        }
    }

}
if (isset($_GET['venta'])) {
    stonksInsertarVenta($conn_localhost,$_GET['i'],$_SESSION['userId']);
    header('Location: bibliotecaUsuario.php');
}
?>
<!DOCTYPE html>
<?php
include("includes/header.php");
include("includes/utils.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stonks</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <br><br><br><br><br>
    <?php



    ?>
    <div>
        <h2>
            <?php echo $juegos[$indiceJuego]['nombre'] ?>
        </h2>
        <div>
            <p>
                <b>Descripcion:</b> <br>
                <?php echo $juegos[$indiceJuego]['descripcion']; ?> <br>
                <b>Genero:</b>
                <?php echo $juegos[$indiceJuego]['idGenero']['nombre']; ?> <br>
                <b>Seguro de la compra?:</b><br>
                <?php echo ("<a href=\"newVenta.php?venta=true&i=".$juegos[$indiceJuego]['id']."\">Comprar</a>"); ?>
            </p>
        </div>
    </div>

</body>

</html>