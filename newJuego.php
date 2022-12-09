<?php
//inicio la secion
if (!isset($_SESSION)) {
    session_start();
    //checamos si inicio sesion
    if (!isset($_SESSION['userId']))
        header('Location: userLogin.php?auth=false');
    if ($_SESSION['userRole'] === "agente" )
        header('Location: index.php?admin=false');
}

include("connections/conn_localhost.php");
include("connections/querys/DBstonks.php");
//pedimos los generos para el formulario
$generos = stonksGetGeneros($conn_localhost);


//el formulario se envio
if (isset($_POST['newGenero'])) {
    //se verifica que nada este vacio
    foreach ($_POST as $key => $value) {
        if ($value == '')
            $error[] = "El campo $key esta vacio :c";
    }


    //checamos si hay errores
    if (!isset($error)) {
        //llamamos a la funcion para insertar un nuevo juego
        stonksNewJuego($conn_localhost,$_POST['nombreJuego'],$_POST['idGenero'],$_SESSION['userId'],$_POST['descripcionJuego']);
        
        //header("location: listaJuegos.php?si=true");



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
    <?php
    
    ?>
    <form action="newJuego.php" method="post"  class="form-box-user animated fadeInUp">
        <table cellpadding="2">
            <tr>
        <h1 class="form-title">Agregar Juego</h1>
                <td><input type="text" name="nombreJuego" placeholder="Nombre del Juego"></td>
            </tr>
            <tr>
                <td><textarea name="descripcionJuego" rows="10" cols="40" placeholder="Descripcion del juego"></textarea></td>
            </tr>
            
            <tr>
                <td><label class="form-rol-genero" for="idGenero">Genero:</label></td>
                <td><select name="idGenero">
                    <?php 
                    for ($i=1; $i <= sizeof($generos); $i++) {
                        echo "<option value=\"" . $generos[$i]['id'] . "\">" . $generos[$i]['nombre'] . "</option>";
                        
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Confirmar" name="newGenero"></td>
            </tr>
        </table>
    </form>


</body>

</html>