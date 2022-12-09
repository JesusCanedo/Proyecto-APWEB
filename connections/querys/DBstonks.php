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
//funcion para iniciar la sesion comparando la contraseña y email
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
//funcion para modificar usuario
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
//funcion para recargar la sesion
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
  //seleccionamos todos los datos de la tabla
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
    return ($resdata);
  }
}
//inserta una nueva venta en la tabla ventas
function stonksInsertarVenta($connection, $idJuego, $idUsuario)
{
  //se puede ejecutar el query directamente dado que no hay nesesidad de proteccion
  mysqli_query($connection, "INSERT INTO venta (idJuego, idUsuario) VALUES ($idJuego, $idUsuario)");
  //insertanmos el juego en la bibliteca del usuario
  stonksInsertarBiblioteca($connection, $idJuego, $idUsuario);
}
function stonksInsertarBiblioteca($connection, $idJuego, $idUsuarios)
{
  //se puede ejecutar el query directamente dado que no hay nesesidad de proteccion
  mysqli_query($connection, "INSERT INTO biblioteca (idJuego, idUsuario	) VALUES ($idJuego, $idUsuarios)");
}
//obtiene la lista de la tabla biblioteca del usuario en especifico
function stonksGetBibliotecaUsuario($connection,$idUsuario){
  //query para obtener la biblioteca del usuario
  $queryGetBibliotecaUsuario = "SELECT * FROM biblioteca WHERE idUsuario = $idUsuario";
  //ejecutamos el query
  $resulset = mysqli_query($connection, $queryGetBibliotecaUsuario);

  //Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resulset)) {
    // Hacemos un fetch del recordset
    $data = mysqli_fetch_all($resulset);
      //recorremos todos los datos
    foreach ($data as $key => $value) {
      //obtenemos los datos del juego, genero y desarrollador asociado
      $dataJuegos = stonksGetJuego($connection,$data[$key][1]);
      $dataGenero = stonksGetDatos($connection, $dataJuegos['idGenero'],"genero");
      $dataDesarrolador = stonksGetDatos($connection, $dataJuegos['idDesarrolador'], "usuarios");
      $resdata[$key]['id'] = $data[$key][0];
      //asignamos todos los valores correspondientes
      //empezmos con los datos del juego
      $resdata[$key]['idJuego']['id'] = $data[$key][1];
      $resdata[$key]['idJuego']['nombre'] = $dataJuegos['nombre'];
      //empezamos con los datos de genero y lo ponemos dentro de idGenero
      $resdata[$key]['idJuego']['idGenero']['id'] = $dataGenero['id'];
      $resdata[$key]['idJuego']['idGenero']['nombre'] = $dataGenero['nombre'];
      $resdata[$key]['idJuego']['idGenero']['descripcion'] = $dataGenero['descripcion'];
      //empezamos desarrollador dentro de id juegos
      $resdata[$key]['idJuego']['idDesarrollador']['id'] = $dataDesarrolador['id'];
      $resdata[$key]['idJuego']['idDesarrollador']['userName'] = $dataDesarrolador['userName'];
      $resdata[$key]['idJuego']['idDesarrollador']['nombre'] = $dataDesarrolador['nombre'];
      $resdata[$key]['idJuego']['idDesarrollador']['apellidos'] = $dataDesarrolador['apellidos'];
      $resdata[$key]['idJuego']['idDesarrollador']['correo'] = $dataDesarrolador['correo'];
      $resdata[$key]['idJuego']['idDesarrollador']['rol'] = $dataDesarrolador['rol'];      
      //se termina desarrolador
      $resdata[$key]['idJuego']['descripcion'] = $dataJuegos['descripcion'];
      //seguimos datos normal
      $resdata[$key]['idUsuario'] = $data[$key][2];
      $resdata[$key]['horasJuego'] = $data[$key][3];
      
    }
    //retun de resultado de la matriz cuatri dimencional
    return ($resdata);
  }

}
//obtiene los datos de el juego conforme su id
function stonksGetJuego($connection,$idJuego){
  $queryGetJuego = "SELECT * FROM juegos WHERE id = $idJuego";
  $resulset = mysqli_query($connection,$queryGetJuego);
  $data = mysqli_fetch_assoc($resulset);
  return($data);
}
//obtiene el los datos de una columna especifica en la tabla seleccionada
function stonksGetDatos($connection,$id,$tabla){
  $queryGet = "SELECT * FROM $tabla WHERE id = $id";
  $resulset = mysqli_query($connection,$queryGet);
  $data = mysqli_fetch_assoc($resulset);
  return($data);


}




?>