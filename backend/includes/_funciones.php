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
            break;
        case 'eliminar_skills':
            eliminar_skills($_POST["skills"]);
            break;
        case 'mostrar_skills':
            mostrar_skills();
            break;
        case 'insertar_skills':
            insertar_skills();
            break;
            
         case 'consulta_individualskl':
            consulta_individualskl($_POST["registro"]);
            break;
         case 'editar_skl':
            editar_skl();
            break;
            
        case 'eliminar_cliente':
            eliminar_cliente($_POST["people"]);
            break;
            
        case 'mostrar_cliente':
            mostrar_cliente();
        
        case 'insertar_cliente':
            insertar_cliente();
            break;
          
        case 'consulta_individual':
            consulta_individual($_POST["registro"]);
            break;
        
         case 'editar_cliente':
            editar_cliente();
            break;
            
        default:
		break;
	}
}

function insertar_cliente(){
    global $db;
    extract($_POST);
    $insertar = $db->insert("people", ["nombre_ppl" => $nombre,
                                    "titulo_ppl" => $pto,
                                    "descripcion_ppl" => $descripcion,
                                    "status_ppl" => 1,
                                    "foto_ppl" => $foto]);
    
    if($insertar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
    }

}

function eliminar_cliente($people){
    global $db;
    $eliminar=$db -> delete("people", ["id_ppl" =>$people]);
    if($eliminar){
        echo "Cliente eliminado";
    }else{
        echo "Ocurrio un problema";
    }
}

function mostrar_cliente(){
    global $db;
    $consultar = $db -> select("people","*",["status_ppl"=>1]);
    echo json_encode($consultar);
}

function consulta_individual($id){
    global $db;
    $consultar = $db -> get("people","*",["AND" => ["status_ppl"=>1, "id_ppl"=>$id]]);
    echo json_encode($consultar);
}

function editar_cliente(){
    global $db;
    extract($_POST);
    $editar = $db->update("people", ["nombre_ppl" => $nombre,
                                    "titulo_ppl" => $pto,
                                    "descripcion_ppl" => $descripcion,
                                    "status_ppl" => 1,
                                    "foto_ppl" => $foto],["id_ppl"=>$registro]);
    
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
    }

}

function mostrar_skills(){
    global $db;
    $consultar=$db->select("skills","*",["status_skl" =>1]);
    echo json_encode($consultar);
}
function eliminar_skills($skills){
    
	global $db;
	$eliminar_skills = $db->delete("skills",["id_skl" => $skills]);
	if($eliminar_skills){
		echo 0;
	}else{
		echo 1;
	}

}
function insertar_skills(){
        global $db;
    extract($_POST);
  $insertar_skills=$db ->insert("skills",["nombre_skl" => $nombre,
                                              "por_skl"=>$porcentaje,
                                              "status_skl"=>1
                                             ]);
    if($insertar_skills){
		echo "Registro existoso";
	}else{
		echo "Se ocasiono un error";
	}
}

function consulta_individualskl($id){
    global $db;
    $consultar = $db -> get("skills","*",["AND" => ["status_skl"=>1, "id_skl"=>$id]]);
    echo json_encode($consultar);
}

function editar_skl(){
    global $db;
    extract($_POST);
    $editar = $db->update("skills", ["nombre_skl" => $nombre,
                                    "por_skl" => $porcentaje,
                                    "status_skl" => 1], ["id_skl"=>$registro]);
    
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
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


