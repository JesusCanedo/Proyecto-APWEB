<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
    //checamos si inicio sesion
    if(!isset($_SESSION['userId'])) header('Location: userLogin.php?auth=false'); 
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
        //llamamos la funcion para actualizar el nuevo usuario
        stonksUpdateUser($conn_localhost,$_SESSION['userId'],$_POST['nickName'],$_POST['nombre'],$_POST['apellidos'],$_POST['rol'], "updateUser.php?updateUser=true");
        
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

    <form action="updateUser.php" method="post">
    <table cellpadding="2">
        <tr>
            <td><label for="nickName">Nickname:</label></td>
            <td><input type="text" name="nickName"
                    value="<?php echo $_SESSION['userNickName'] ?>"></td>
        </tr>
        <tr>
            <td><label for="nombre">Nombre:</label></td>
            <td><input type="text" name="nombre" value="<?php echo $_SESSION['userName']?>">
            </td>

        </tr>
        <tr>
            <td><label for="apellidos">Apellidos:</label></td>
            <td><input type="text" name="apellidos"
                    value="<?php echo $_SESSION['userLastName'] ?>"></td>

        </tr>
        <tr>
            <td><label for="correo">Correo:</label></td>
            <td><input disabled="disabled" type="text" name="correo" value="<?php echo $_SESSION['userEmail']?>"></td>

        </tr>
        <tr>
            <td><label for="rol">Desarrollador?:*</label></td>
            <td><input type="checkbox" name="rol"></td>
        </tr>
        <tr>
        <td></td>
        <td><input type="submit" value="Confirmar" name="userRegister"></td>
      </tr>
    </table>
</form>


</body>

</html>