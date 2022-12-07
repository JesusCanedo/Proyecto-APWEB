<?php
//Funcion para añadir un usuario a la DB
function stonksInsertUser($connection, $nickName, $nombre, $apellidos, $correo, $contrasena, $rol)
{
  //userName, nombre, apellidos, correo, contrasena, rol
  $queryRegisterUser = sprintf(
    "INSERT INTO usuarios (userName, nombre, apellidos, correo, contrasena, rol) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
    mysqli_real_escape_string($connection, trim($nickName)),
    mysqli_real_escape_string($connection, trim($nombre)),
    mysqli_real_escape_string($connection, trim($apellidos)),
    mysqli_real_escape_string($connection, trim($correo)),
    mysqli_real_escape_string($connection, trim($contrasena)),
    mysqli_real_escape_string($connection, trim($rol))
  );

  mysqli_query($connection, $queryRegisterUser) or trigger_error("El query para registrar usuarios falló");

}
function stonksInicioSesion($connection, $correo, $contrasena, $pathRedireccion)
{
  // Armamos el query para verificar email y password en la BD
  $queryLogin = sprintf(
    "SELECT id,userName, nombre, apellidos, correo, rol FROM usuarios WHERE correo = '%s' AND contrasena = '%s'",
    mysqli_real_escape_string($connection, trim($correo)),
    mysqli_real_escape_string($connection, trim($contrasena))
  );

  // Ejecutamos el query
  $resQueryLogin = mysqli_query($connection, $queryLogin) or trigger_error("Login query failed");

  // Determinamos si el login es valido (email y password coincidentes)
//Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resQueryLogin)) {
    // Hacemos un fetch del recordset
    $userData = mysqli_fetch_assoc($resQueryLogin);

    // Defninimos variables de sesion en $_SESSION
    $_SESSION['userId'] = $userData['id'];
    $_SESSION['userNickName'] = $userData['userName'];
    $_SESSION['userName'] = $userData['nombre'];
    $_SESSION['userLastName'] = $userData['apellidos'];
    $_SESSION['userEmail'] = $userData['correo'];
    $_SESSION['userRole'] = $userData['rol'];

    // Redireccionamos al usuario al Panel de Control
    header("Location: " . $pathRedireccion);
  }
}
function stonksUpdateUser($connection, $userId, $nickName, $nombre, $apellidos, $rol, $pathRedireccion)
{

  $queryUpdateUser = sprintf(
    "UPDATE usuarios SET userName = '%s', nombre = '%s', apellidos = '%s', rol = '%s' WHERE id = $userId",
    mysqli_real_escape_string($connection, trim($nickName)),
    mysqli_real_escape_string($connection, trim($nombre)),
    mysqli_real_escape_string($connection, trim($apellidos)),
    mysqli_real_escape_string($connection, trim($rol))
  );

  // Ejecutamos el query
  mysqli_query($connection, $queryUpdateUser) or trigger_error("El query de inserción de usuarios falló");

  // Redireccionamos al usuario al Panel de Control
  stonksRecargarSession($connection, $userId);
  header("Location: $pathRedireccion");
}
function stonksRecargarSession($connection, $userId)
{
  
  // Armamos el query para verificar email y password en la BD
  $queryRefresh = sprintf(
    "SELECT userName, nombre, apellidos, correo, rol FROM usuarios WHERE id = '%s'",
    mysqli_real_escape_string($connection, trim($userId))
  );

  // Ejecutamos el query
  $resqueryRefresh = mysqli_query($connection, $queryRefresh) or trigger_error("Login query failed");

  
//Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resqueryRefresh)) {
    // Hacemos un fetch del recordset
    $userData = mysqli_fetch_assoc($resqueryRefresh);

    // Defninimos variables de sesion en $_SESSION
    
    $_SESSION['userNickName'] = $userData['userName'];
    $_SESSION['userName'] = $userData['nombre'];
    $_SESSION['userLastName'] = $userData['apellidos'];
    $_SESSION['userEmail'] = $userData['correo'];
    $_SESSION['userRole'] = $userData['rol'];

    
  }
}

?>