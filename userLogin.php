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
if (isset($_POST['newUser'])) {
    header(header("location: newUser.php"));
}
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
    <title>Stonks</title>
    <link rel="stylesheet" href="style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styleForms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>

<body>
    <br><br><br><br><br>
    <form action="userLogin.php" method="post" class="form-box animated fadeInUp">
        <table>
            <h1 class="form-title">Sing In</h1>
            <tr>
                <td><input type="text" name="correo" placeholder="Email"></td>
            </tr>
            <tr>
                <td><input type="password" name="contrasena" placeholder="Password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login" name="loginSent"></td>
                <td></td>
            </tr>
            <tr>
                <td><input type="submit" value="Registrar" name="newUser"></td>
                <td></td>
            </tr>
              
        </table>
    </form>

</body>
</html>