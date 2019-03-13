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
        case 'consulta_usuarios':
            consulta_usuarios($_POST["registro"]);
            break;
        case 'editar_usuarios':
            editar_usuarios();
            break;
            
        //Servicios  
            case 'eliminar_servicios':
		eliminar_servicios($_POST["servicios"]);
		break;

		case 'mostrar_servicios':
		mostrar_servicios();
		break;
            
        case 'insertar_servicios':
            insertar_servicios($_POST["nombre"], $_POST["descripcion"],$_POST["foto"]);
            break;
        case 'consulta_individual':
            consulta_individual($_POST["registro"]);
            break;
        case 'editar_servicios':
            editar_servicios();
            break;
            //portafolio
        case 'eliminar_portafolio':
		eliminar_portafolio($_POST["portafolio"]);
		break;

		case 'mostrar_portafolio':
		mostrar_portafolio();
		break;
            
        case 'insertar_portafolio':
            insertar_portafolio($_POST["nombre"], $_POST["descripcion"],$_POST["foto"]);
            break;
        case 'consulta_individualpfp':
            consulta_individualpfp($_POST["registro"]);
            break;
        case 'editar_portafolio':
            editar_portafolio();
            break;
            //Epieza skills
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
        case 'editar_skills':
            editar_skills();
            break;
          //meet
        case 'eliminar_crew':
		eliminar_crew($_POST["crew"]);
		break;

		case 'mostrar_crew':
		mostrar_crew();
		break;

        case 'insertar_crew':
            insertar_crew();
						break;
        case 'consulta_individualcr':
            consulta_individualcr($_POST["registro"]);
            break;
        case 'editar_crew':
            editar_crew();
            break;

            //empiez funciones del modulo clientes
        case 'eliminar_clientes':
		eliminar_clientes($_POST["people"]);
		break;

		case 'mostrar_clientes':
		mostrar_clientes();
		break;
            
        case 'insertar_clientes':
            insertar_clientes();
            break;
        case 'consulta_clientes':
            consulta_clientes($_POST["registro"]);
            break;
        case 'editar_clientes':
            editar_clientes();
            break;            
        case 'insertar_comentario':
		  insertar_comentario($_POST["nombre"], $_POST["correo"], $_POST["mensaje"]);
		    break;  
        case 'carga_foto':
            carga_foto();
		   
      default:
		    break;
	}
}

function carga_foto(){
    if(isset($_FILES["archivo"])){
        $foto=$_FILES["archivo"]["name"];
        $temporal=$_FILES["archivo"]["tmp_name"];
        $carpeta="../../img/";
        $arreglo["texto"]="Error";
        $arreglo["satus"]=0;
        if(move_uploaded_file($temporal , $carpeta.$foto)){
            $arreglo["texto"]="Subida exitosa";
            $arreglo["archivo"]=$carpeta.$foto;
            $arreglo["status"]=1;
        }
        echo json_encode($arreglo);
    }
}

//funciones de meet
function consulta_individualcr($id){
    global $db;
    $consultar = $db -> get("crew","*",["AND" => ["status_cr"=>1, "id_cr"=>$id]]);
    echo json_encode($consultar);
}

function editar_crew(){
    global $db;
    extract($_POST);
    $editar = $db->update("crew", ["nombre_cr" => $nombre,
                                    "descripcion_cr" => $descripcion,
                                    "foto_cr" => $foto,
                                    "status_cr" => 1],["id_cr"=>$registro]);
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Error al registrar";
    }
}

function mostrar_crew(){
	global $db;
	$consultar = $db->select("crew","*",["status_cr" => 1]);
	echo json_encode($consultar);
}

function eliminar_crew($crew){
	global $db;
	$eliminar_crew = $db->delete("crew",["id_cr" => $crew]);
	if($eliminar_crew){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_crew(){
  global $db;
	extract ($_POST);
  $insertar_crew=$db ->insert("crew",["nombre_cr" => $nombre,
                                             "descripcion_cr" => $descripcion,
                                              "foto_cr" => $foto,
                                              "status_cr" => 1
                                             ]);
  if($insertar_crew){
		echo "Registro exitoso";
	}else{
		echo "Error al registrar";
	}
}
//funciones de clientes
function mostrar_clientes(){
    global $db;
    $consultar=$db->select("people","*",["status_ppl" =>1]);
    echo json_encode($consultar);
}
function eliminar_clientes($people){
    
	global $db;
	$eliminar = $db->delete("people",["id_ppl" => $people]);
	if($eliminar){
		echo "Registro eliminado";
	}else{
		echo "Ocurrio un error";
	}

}
function insertar_clientes(){
        global $db;
    extract($_POST);
  $insertar=$db ->insert("people",["nombre_ppl" => $nombre,
                                                "titulo_ppl"=>$pto,
                                                "descripcion_ppl"=>$descp,
                                                "foto_ppl"=>$foto,
                                              "status_ppl"=>1
                                             ]);
    if($insertar){
		echo "Registro existoso";
	}else{
		echo "Se ocasiono un error";
	}
}

function consulta_clientes($id){
    global $db;
    $consultar = $db -> get("people","*",["AND" => ["status_ppl"=>1, "id_ppl"=>$id]]);
    echo json_encode($consultar);
}

function editar_clientes(){
    global $db;
    extract($_POST);
    $editar = $db->update("people", ["nombre_ppl" => $nombre,
                                    "titulo_ppl" => $pto,
                                     "descripcion_ppl" => $descp,
                                     "foto_ppl"=>$foto,
                                    "status_ppl" => 1], ["id_ppl"=>$registro]);
    
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
    }

}
//skills
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

function editar_skills(){
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
//Usuarios
function mostrar_usuarios(){
	global $db;
	$consultar = $db->select("usuarios","*",["status_usr" => 1]);
	echo json_encode($consultar);
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
		echo "Registro existoso";
	}else{
		echo "Se ocasiono un error";
	}
}
function consulta_usuarios($id){
    global $db;
    $consultar = $db -> get("usuarios","*",["AND" => ["status_usr"=>1, "id_usr"=>$id]]);
    echo json_encode($consultar);
}
function editar_usuarios(){
 
    global $db;
    extract($_POST);
  $editar=$db ->update("usuarios",["nombre_usr" => $nombre,
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
                                             ],["id_usr"=>$registro]);
    if($editar){
		echo "Registro existoso";
	}else{
		echo "Se ocasiono un error";
	}
}
//Portafolio
function consulta_individualpfp($id){
    global $db;
    $consultar = $db -> get("portafolio","*",["AND" => ["status"=>1, "id"=>$id]]);
    echo json_encode($consultar);
}

function editar_portafolio(){
    global $db;
    extract($_POST);
    $editar = $db->update("portafolio", ["nombre" => $nombre,
                                    "descripcion" => $descripcion,
                                    "imagen" => $foto,
                                    "status" => 1],["id"=>$registro]);
    
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
    }

}
function mostrar_portafolio(){
	global $db;
	$consultar = $db->select("portafolio","*",["status" => 1]);
	echo json_encode($consultar);
}

function eliminar_portafolio($portafolio){
	global $db;
	$eliminar = $db->delete("portafolio",["id" => $portafolio]);
	if($eliminar){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_portafolio($nombre, $descripcion, $foto){
 
    global $db;
  $insertar=$db ->insert("portafolio",["nombre" => $nombre,
                                             "descripcion" => $descripcion,
                                              "imagen" => $foto,
                                              "status" => 1
                                             ]);
    
    if($insertar){
		echo "registro exitoso";
	}else{
		echo "se produjo un error";
	}
 
}
//Servicios
function consulta_individual($id){
    global $db;
    $consultar = $db -> get("servicios","*",["AND" => ["status_svc"=>1, "id_svc"=>$id]]);
    echo json_encode($consultar);
}

function editar_servicios(){
    global $db;
    extract($_POST);
    $editar = $db->update("servicios", ["nombre_svc" => $nombre,
                                    "descripcion_svc" => $descripcion,
                                    "foto_svc" => $foto,
                                    "status_svc" => 1],["id_svc"=>$registro]);
    
    if($editar){
        echo "Registro exitoso";
    }else{
        echo "Ocurrio un problema";
    }

}
function mostrar_servicios(){
	global $db;
	$consultar = $db->select("servicios","*",["status_svc" => 1]);
	echo json_encode($consultar);
}

function eliminar_servicios($servicios){
	global $db;
	$eliminar_servicios = $db->delete("servicios",["id_svc" => $servicios]);
	if($eliminar_servicios){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_servicios($nombre, $descripcion, $foto){
 
    global $db;
  $insertar_servicios=$db ->insert("servicios",["nombre_svc" => $nombre,
                                             "descripcion_svc" => $descripcion,
                                              "foto_svc" => $foto,
                                              "status_svc" => 1
                                             ]);
    
    if($insertar_servicios){
		echo "registro exitoso";
	}else{
		echo "se produjo un error";
	}
 
}

function insertar_comentario($nombre, $correo, $mensaje){ 
    global $db;
  $insertar_comentario=$db ->insert("comentarios",
											["nombre" => $nombre,
                                           "correo" => $correo,
                                            "mensaje" => $mensaje
                                             ]);
    if($insertar_comentario){
		echo 1;
	}else{
		echo 0;
	} 
}

//login
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
               $_SESSION['activo'] = "1";
				$_SESSION['usuario'] = $usuario;
			   echo 1;			   	
               return;
           }
        } else {
            echo 3;
          return false;
        }
    
    
}
?>


