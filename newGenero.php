<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
    //checamos si inicio sesion
    if (!isset($_SESSION['userId']))
        header('Location: userLogin.php?auth=false');
    if (!$_SESSION['rol'] === "admin")
        header('Location: index.php?admin=false');
}

include("connections/conn_localhost.php");
include("connections/querys/DBstonks.php");

//el formulario se envio
if (isset($_POST['newGenero'])) {
    //se verifica que nada este vacio
    foreach ($_POST as $key => $value) {
        if ($value == '')
            $error[] = "El campo $key esta vacio :c";
    }


    //checamos si hay errores
    if (!isset($error)) {
        //llamamos a la funcion para insertar un nuevo genero
        stonksNewGenero($conn_localhost, $_POST['nombreGenero'], $_POST['descripcion']);
        header("location: newGenero.php?si=true");



    }

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
    <title>stonks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleForms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

   
</head>

<body>
    <br><br><br><br><br>

    <form action="newGenero.php" method="post" class="form-box animated fadeInUp">
        <table cellpadding="2">
            <tr>
            <h1 class="form-title">Agregar genero</h1>
                <td><input type="text" name="nombreGenero" placeholder="Genero"></td>
            </tr>
            <tr>
                <td><textarea name="descripcion" rows="10" cols="40" 
                placeholder="Descripcion"></textarea>
                </td>

            </tr>

            <tr>
                <td><input type="submit" value="Confirmar" name="newGenero"></td>
            </tr>
        </table>
    </form>

</body>

</html>