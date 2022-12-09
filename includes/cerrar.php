<?php
	if(isset($_GET['cerrar'])) {

		//vaciar variables de la sesion
		$_SESSION['nickName'] = NULL;
		$_SESSION['nombre'] = NULL;
		$_SESSION['apellidos'] = NULL;
		$_SESSION['correo'] = NULL;
		$_SESSION['contrasena'] = NULL;
		unset($_SESSION['nickName']);
		unset($_SESSION['nombre']);
		unset($_SESSION['apellidos']);
		unset($_SESSION['correo']);
		unset($_SESSION['contrasena']);

		//redireccionamos a la pagina principal
		header('Location: index.php')

	}

?>