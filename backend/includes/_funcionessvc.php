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
            insertar_servicios();
            break;
        case 'consulta_individual':
            consulta_individual($_POST["registro"]);
            break;
        case 'editar_servicios':
            editar_servicios();
            break;
		default:
		break;
	}
}

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

function insertar_servicios(){
 
    global $db;
    extract ($_POST);
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
?>

