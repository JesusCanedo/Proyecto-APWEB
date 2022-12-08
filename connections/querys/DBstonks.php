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
  //the cake is a lie

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
//funcion para añadir nuevo genero
function stonksNewGenero($connection, $nombre, $descripcion)
{

  $queryNewGenero = sprintf(
    "INSERT INTO genero (nombre, descripcion) VALUES ('%s', '%s')",
    mysqli_real_escape_string($connection, trim($nombre)),
    mysqli_real_escape_string($connection, trim($descripcion))

  );

  //mysqli_query($connection, $queryNewGenero) or trigger_error("El query para registrar usuarios falló");

}
//Funcion que devuelve matriz con datos de la tabla genero
function stonksGetGeneros($connection)
{


  $queryGetGenero = "SELECT id, nombre, descripcion FROM genero";

  // Ejecutamos el query
  $resueryGetGenero = mysqli_query($connection, $queryGetGenero) or trigger_error("Login query failed");
  //the cake is a lie

  //Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resueryGetGenero)) {
    // Hacemos un fetch del recordset

    //return (mysqli_num_rows($resueryGetGenero));
    for ($i = 1; $i <= mysqli_num_rows($resueryGetGenero); $i++) {
      $queryGetGeneroFor = "SELECT id, nombre, descripcion FROM genero WHERE id = $i";
      $resQueryGetGeneroFor = mysqli_query($connection, $queryGetGeneroFor) or trigger_error("Login query failed");
      $data = mysqli_fetch_assoc($resQueryGetGeneroFor);
      $generos[$i]['id'] = $data['id'];
      $generos[$i]['nombre'] = $data['nombre'];
      $generos[$i]['descripcion'] = $data['descripcion'];
    }
    return ($generos);

  }
}
//funcion para insertar nuevo juego
function stonksNewJuego($connection, $nombre, $idGenero, $idDesarrollador, $descripcion)
{
  //iniciamos el query
  $queryNewGame = sprintf(
    "INSERT INTO juegos (nombre, idGenero, idDesarrolador, descripcion) VALUES ('%s', $idGenero, $idDesarrollador, '%s')",
    mysqli_real_escape_string($connection, trim($nombre)),
    mysqli_real_escape_string($connection, trim($descripcion))

  );

  mysqli_query($connection, $queryNewGame) or trigger_error("El query para insertar juegos falló");


}
//Obitiene una matriz de los juegos
function stonksGetNombreJuegos($connection)
{

  $queryGetNombreJuegos = "SELECT * FROM juegos";

  // Ejecutamos el query
  $resQueryGetNombreJuegos = mysqli_query($connection, $queryGetNombreJuegos) or trigger_error("Login query failed");
  //the cake is a lie

  //Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resQueryGetNombreJuegos)) {
    // Hacemos un fetch del recordset
    $data = mysqli_fetch_all($resQueryGetNombreJuegos);
    foreach ($data as $key => $value) {
      $resdata[$key]['id'] = $data[$key][0];
      $resdata[$key]['nombre'] = $data[$key][1];
      $resdata[$key]['idGenero'] = $data[$key][2];
      $resdata[$key]['idDesarrollador'] = $data[$key][3];
      $resdata[$key]['descripcion'] = $data[$key][4];
    }
    return($resdata);
  }
}

?>