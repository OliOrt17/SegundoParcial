<?php  
require_once '_db.php';
if(isset($_POST["accion"])){
	switch ($_POST["accion"]) {
            
		case 'eliminar_servicios':
		eliminar_servicios($_POST["servicios"]);
		break;

		case 'mostrar_servicios':
		mostrar_servicios();
		break;
            
        case 'insertar_servicios':
            insertar_servicios($_POST["nombre"],$_POST["descripcion"],$_POST["foto"]);
            
		default:
		break;
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

function insertar_servicios($nombre, $descripcion,$foto){
 
    global $db;
  $insertar_servicios=$db ->insert("servicios",["nombre_svc" => $nombre,
                                             "descripcion_svc" => $descripcion,
                                              "foto_svc" => $foto,
                                              "status_svc" => 1
                                             ]);
    if($insertar_servicios){
		echo 1;
	}else{
		echo 0;
	}
 
}
?>

