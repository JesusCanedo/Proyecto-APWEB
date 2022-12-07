<!DOCTYPE html>
<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
}
include("includes/header.php");
include("connections/conn_localhost.php");
include("connections/querys/DBstonks.php");
include("includes/utils.php");

if (isset($_POST['loginSent'])) {
    //se verifica que nada este vacio
    foreach ($_POST as $key => $value) {
        if ($value == '')
            $error[] = "El campo $key esta vacio :c";
    }

    //vemos si hay errores
if (!isset($error)) {
        //iniciamos la sesion
        stonksInicioSesion($conn_localhost, $_POST['correo'], $_POST['contrasena'], "index.php");
}


}







?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam</title>
    <link rel="stylesheet" href="style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <br><br><br><br><br>
    <form action="userLogin.php" method="post">
        <table>
            <tr>
                <td><label for="correo">Correo:</label></td>
                <td><input type="text" name="correo"></td>
            </tr>
            <tr>
                <td><label for="contrasena">Contraseña:</label></td>
                <td><input type="password" name="contrasena"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login" name="loginSent"></td>
                <td></td>
            </tr>
        </table>
    </form>


</body>

</html>