<form action="newUser.php" method="post">
    <table cellpadding="2">
        <tr>
            <td><label for="nickName">Nickname:*</label></td>
            <td><input type="text" name="nickName"
                    value="<?php if (isset($_POST['nickName']))
                    echo $_POST['nickName']; ?>"></td>
        </tr>
        <tr>
            <td><label for="nombre">Nombre:*</label></td>
            <td><input type="text" name="nombre" value="<?php if (isset($_POST['nombre']))
                    echo $_POST['nombre']; ?>">
            </td>

        </tr>
        <tr>
            <td><label for="apellidos">Apellidos:*</label></td>
            <td><input type="text" name="apellidos"
                    value="<?php if (isset($_POST['apellidos']))
                        echo $_POST['apellidos']; ?>"></td>

        </tr>
        <tr>
            <td><label for="correo">Correo:*</label></td>
            <td><input type="text" name="correo" value="<?php if (isset($_POST['correo']))
                        echo $_POST['correo']; ?>"></td>

        </tr>
        <tr>
            <td><label for="Contrasena">Contraseña:*</label></td>
            <td><input type="password" name="contrasena"></td>
        </tr>
        <tr>
            <td><label for="Contrasena2">confirmar Contraseña*</label></td>
            <td><input type="password" name="contrasena2"></td>
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