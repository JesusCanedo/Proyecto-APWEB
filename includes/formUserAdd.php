<link rel="stylesheet" href="styleForms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

<form action="newUser.php" method="post" class="form-box animated fadeInUp">
    <table cellpadding="2">
    <h1 class="form-title-user">Registro</h1>
        <tr>
            <td><input type="text" name="nickName" placeholder="Nickname"
                    value="<?php if (isset($_POST['nickName']))
                    echo $_POST['nickName']; ?>"></td>
        </tr>
        <tr>
            <td><input type="text" name="nombre" placeholder="Nombre" 
            value="<?php if (isset($_POST['nombre']))
                    echo $_POST['nombre']; ?>">
            </td>

        </tr>
        <tr>
            <td><input type="text" name="apellidos" placeholder="Apellidos"
                    value="<?php if (isset($_POST['apellidos']))
                        echo $_POST['apellidos']; ?>"></td>

        </tr>
        <tr>
            <td><input type="text" name="correo" placeholder="Email"
            value="<?php if (isset($_POST['correo']))
                        echo $_POST['correo']; ?>"></td>

        </tr>
        <tr>
            <td><input type="password" name="contrasena" placeholder="Password"
            ></td>
        </tr>
        <tr>
            <td><input type="password" name="contrasena2" placeholder="ConfimarPassword"></td>
        </tr>
        <tr>
            <td><label class="form-rol" for="rol">Desarrollador?:*</label></td>
            <td><input type="checkbox" name="rol"></td>
        </tr>
        <tr>
        <td><input type="submit" value="Confirmar" name="userRegister"></td>
      </tr>
    </table>
</form>