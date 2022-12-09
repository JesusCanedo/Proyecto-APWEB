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
if (isset($_POST['newVenta'])) {
    //se verifica que nada este vacio
    foreach ($_POST as $key => $value) {
        if ($value == '')
            $error[] = "El campo $key esta vacio :c";
    }


    //checamos si hay errores
    if (!isset($error)) {
        //llamamos a la funcion para insertar un nuevo juego

        
        stonksInsertarVenta($conn_localhost,$_POST['idJuego'],$_SESSION['userId']);
        header("location: index.php?venta=true");



    }

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
    <form action="newVenta.php" method="post">
        <table cellpadding="2">
            
            <tr>
                <td><label for="idJuego">Genero:</label></td>
                <td><select name="idJuego">
                    <?php 
                    for ($i=0; $i < sizeof($juegos); $i++) {
                        echo "<option value=\"" . $juegos[$i]['id'] . "\">" . $juegos[$i]['nombre'] . "</option>";
                        
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><label for="prueba">Genero:</label></td>
                <td><select name="prueba">
                    <?php 
                    for ($i=0; $i < sizeof($juegos); $i++) {
                        echo "<option value=\"" . $bibloteca[$i]['id'] . "\">" . $bibloteca[$i]['idJuego']['nombre'] . "</option>";
                        echo "<option value=\"" . $bibloteca[$i]['id'] . "\">" . $bibloteca[$i]['idJuego']['idGenero']['nombre'] . "</option>";
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Confirmar" name="newVenta"></td>
            </tr>
        </table>
    </form>


</body>

</html>