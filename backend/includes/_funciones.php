<?php  
require_once '_db.php';
if(isset($_POST["accion"])){
	switch ($_POST["accion"]) {
		case 'login':
		login();
		break;
		
		case 'eliminar_usuarios':
		eliminar_usuarios($_POST["usuario"]);
		break;

		case 'mostrar_usuarios':
		mostrar_usuarios();
		break;
            
        case 'insertar_usuarios':
            insertar_usuarios($_POST["nombre"], $_POST["correo"], $_POST["telefono"], $_POST["password"], $_POST["trabajo"], $_POST["descripcion"], $_POST["tipo"], $_POST["facebook"], $_POST["twitter"], $_POST["linkedin"], $_POST["foto"]);
            
		default:
		break;
	}
}
function mostrar_usuarios(){
	global $db;
	$consultar = $db->select("usuarios","*",["status_usr" => 1]);
	echo json_encode($consultar);
}
function login(){
		// Recibir y Sanear las variables
		// Conectar a la base de datos
		// Verificar si existe usuario
			// Si el usuario existe
					// Si la contraseña es válida, imprimir 1
					// Si la contraseña no es válida, imprimir un 0
			// Si el usuario no existe, imprimir un 2
		// Cerrar la conexión
}
function eliminar_usuarios($usuario){
	global $db;
	$eliminar_usuarios = $db->delete("usuarios",["id_usr" => $usuario]);
	if($eliminar_usuarios){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_usuarios($nombre, $correo, $telefono, $password, $trabajo, $descripcion, $tipo, $facebook, $twitter, $linkedin, $foto){
 
    global $db;
  $insertar_usuarios=$db ->insert("usuarios",["nombre_usr" => $nombre,
                                           "correo_usr" => $correo,
                                            "telefono_usr" => $telefono,
                                            "password_usr" => $password,
                                            "status_usr" => 1,
                                             "tbj_usr" => $trabajo,
                                             "descp_usr" => $descripcion,
                                             "tipo_usr" => $tipo,
                                             "faceb_usr" => $facebook,
                                              "twitter_usr" => $twitter,
                                              "linkedin_usr" => $linkedin,
                                              "foto_usr" => $foto
                                             ]);
    if($insertar_usuarios){
		echo 1;
	}else{
		echo 0;
	}
 
}
?>


