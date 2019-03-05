<?php  
require_once '_db.php';
if(isset($_POST["accion"])){
	switch ($_POST["accion"]) {
            
		case 'eliminar_portafolio':
		eliminar_portafolio($_POST["portafolio"]);
		break;

		case 'mostrar_portafolio':
		mostrar_portafolio();
		break;
            
        case 'insertar_portafolio':
            insertar_portafolio($_POST["nombre"],$_POST["descripcion"],$_POST["foto"]);
            
		default:
		break;
	}
}
function mostrar_portafolio(){
	global $db;
	$consultar = $db->select("portafolio","*",["status" => 1]);
	echo json_encode($consultar);
}

function eliminar_portafolio($portafolio){
	global $db;
	$eliminar_servicios = $db->delete("portafolio",["Id" => $servicios]);
	if($eliminar_servicios){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_portafolio($nombre, $descripcion,$foto){
 
    global $db;
  $insertar_servicios=$db ->insert("servicios",["nombre" => $nombre,
                                             "descripcion" => $descripcion,
                                              "foto" => $foto,
                                              "status" => 1
                                             ]);
    if($insertar_servicios){
		echo 1;
	}else{
		echo 0;
	}
 
}
?>

