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
            break;    
        case 'consulta_individual':
            consulta_individual($_POST["registro"]);
            break;
        case 'editar_portafolio':
            editar_portafolio();
            break;            
		default:
		break;
	}
}
function consulta_individual($id){
    global $db;
    $consultar = $db -> get("portafolio","*",["AND" => ["status"=>1, "Id"=>$id]]);
    echo json_encode($consultar);
}

function editar_portafolio(){
    global $db;
    extract($_POST);
    $editar = $db->update("portafolio", ["nombre" => $nombre,
                                    "descripcion" => $descripcion, 
                                         "imagen"=>$foto,
                                         "status" => 1],["Id"=>$registro]);
    
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
	$eliminar = $db->delete("portafolio",["Id" => $portafolio]);
	if($eliminar){
		echo 0;
	}else{
		echo 1;
	}
}

function insertar_portafolio($nombre, $descripcion,$foto){
 
    global $db;
  $insertar=$db ->insert("portafolio",["nombre" => $nombre,
                                             "descripcion" => $descripcion,
                                              "imagen" => $foto,
                                              "status" => 1
                                             ]);
    if($insertar){
		echo "Registro exitoso";
	}else{
		echo 0;
	}
 
}
?>

