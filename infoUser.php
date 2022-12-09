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
    //redireccionamos para que mopdifique su usuario
    header('Location: updateUser.php');

}
?>
<!DOCTYPE html>
<?php
include("includes/header.php");

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
    <link rel="stylesheet" href="styleForms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

   
</head>

<body>
    <br><br><br><br><br><br><br><br><br>

    <form action="infoUser.php" method="post" class="form-box">
    <table cellpadding="2">
        <tr>
        <h1 class="form-title">informacion del Usuario</h1>
            <td><input disabled="disabled" type="text" name="nickName" placeholder="Nickname"
                    value="<?php echo $_SESSION['userNickName'] ?>"></td>
        </tr>
        <tr>
            <td><input disabled="disabled" type="text" name="nombre" placeholder="Nombre"
             value="<?php echo $_SESSION['userName']?>">
            </td>

        </tr>
        <tr>
            <td><input type="text" name="apellidos" placeholder="Apellidos"
                    value="<?php echo $_SESSION['userLastName'] ?>"></td>

        </tr>
        <tr>
            <td><input disabled="disabled" type="text" name="correo" placeholder="Correo"
             value="<?php echo $_SESSION['userEmail']?>"></td>

        </tr>
        <tr>
            <td><label class="form-rol" for="rol">Desarrollador?:*</label></td>
            <td><input disabled="disabled" type="checkbox" name="rol"></td>
        </tr>
        <tr>
        <td><a href="updateUser.php"><input type="submit" value="Modificar informacion" name="userRegister"></a></td>
      </tr>
    </table>

    <?php
    
    
    ?>
</form>


</body>

</html>