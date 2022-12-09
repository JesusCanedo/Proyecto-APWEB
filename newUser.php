<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
}
include("connections/conn_localhost.php");
include("connections/querys/DBstonks.php");
//el formulario se envio
if (isset($_POST['userRegister'])) {
    //se verifica que nada este vacio
    foreach ($_POST as $key => $value) {
        if ($value == '')
            $error[] = "El campo $key esta vacio :c";
    }

    //las contraseñas coinciden
    if ($_POST['contrasena'] != $_POST['contrasena2'])
        $error[] = "las contraseñas no coinciden";
    //checamos si hay errores
    if (!isset($error)) {
       

        //checamos si es desarrolador
        if (isset($_POST['rol'])) {
            $rol = "desarollador";
        } else {
            $rol = "agente";
        }
        //llamamos la funcion para insertar el nuevo usuario
        stonksInsertUser($conn_localhost, $_POST['nickName'], $_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['contrasena'], $rol);
        header("location: index.php?registrado=true")
        
    }

}
?>
<!DOCTYPE html>
<?php
include("includes/header.php");
//include("includes/utils.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stonks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleForms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
   
</head>

<body>
    <br><br><br><br><br>

    <?php
    include("includes/formUserAdd.php");
    ?>


</body>

</html>