<?php  
require_once '_db.php';
if(isset($_POST["accion"])){
	switch ($_POST["accion"]) {
		case 'login':
		login($_POST["usuario"], $_POST["password"]);
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
function login($usuario, $password){
    global $db;
    $conpassword=$db->select("usuarios","*",["password_usr"=>$password]);#consulta para la contraseña
    $conuser=$db->select("usuarios","*",["correo_usr"=>$usuario]);#consulta para usuario
    
      if ( filter_var($usuario,FILTER_VALIDATE_EMAIL) ){#funcion para validar el email sanear
           if(!$conuser){
               echo 2;
               return false;
           }elseif(!$conpassword){
               echo 0;
               return false;
           }else{
               echo 1;
               return;
           }
        } else {
            echo 3;
          return false;
        }
    
    
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


