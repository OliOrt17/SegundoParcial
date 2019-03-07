<?php 
session_start();
$sesion = $_SESSION['activo'];

if($sesion != "1" ){
	echo 'Acceso denegado';
	header("Location: ../index.php");
}
require_once '../includes/_db.php';
require_once '../includes/_funciones.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Dashboard Template · Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="../css/estilo.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" id="signOut" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="home"></span>
                Dashboard 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="../usuarios/">
                <span data-feather="file"></span>
                Usuarios<span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../servicios/">
                <span data-feather="file"></span>
                Servicios<span class="sr-only">(current)</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="../meet/">
                <span data-feather="file"></span>
                Meet<span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../skills/">
                <span data-feather="file"></span>
                Skills<span class="sr-only">(current)</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="../portafolio/">
                <span data-feather="file"></span>
                Portafolio<span class="sr-only">(current)</span>
              </a>
            </li>

          </ul>
        </div>
      </nav>

      <main id="main" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <h2>Usuarios
          <button type="button" id="btn_nuevo" class="btn btn-outline-primary">Nuevo</button>
        </h2>
        <div class="table-responsive view" id="mostrar_datos">
          <table class="table table-striped table-sm" id="table_datos">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $usuarios = $db->select("usuarios","*",["status_usr" => 1]);
              foreach ($usuarios as $usuario => $usr) {
                ?>
                <tr>
                  <td><?php echo $usr["nombre_usr"]; ?></td>
                  <td><?php echo $usr["telefono_usr"]; ?></td>
                  <td>
                    <a href="#" class="editar_registro"data-id="<?php echo $usr["id_usr"]; ?>">Editar</a>
                    <a href="#" class="eliminar_registro" data-id="<?php echo $usr["id_usr"]; ?>">Eliminar</a></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div id="formulario_datos" class="view">
            <form action="#" id="frm_datos">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                  </div>
                  <div class="form-group">
                    <label for="correo">Correo Eléctronico</label>
                    <input type="email" class="form-control" name="correo" id="correo">
                  </div>
                  <div class="form-group">
                    <label for="trabajo">Trabajo</label>
                    <input type="text" class="form-control" name="trabajo" id="trabajo">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion">
                  </div>
                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="text" class="form-control" name="foto" id="foto">
                  </div>
                  <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" class="form-control" name="tipo" id="tipo">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter">
                  </div>
                  <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" id="linkedin">
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook">
                  </div>
                  <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-outline-danger cancelar">Cancelar</button>
                  <button type="button" class="btn btn-outline-success" id="registrar">Guardar</button>
                  
                </div>
              </div>
            </form>
          </div>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    
    <script>
                
      change_view();
      function change_view(vista = "mostrar_datos"){
        $("#main").find(".view").each(function(){
          $(this).addClass('d-none');
          let id = $(this).attr("id");
          if(id == vista){
            $(this).removeClass("d-none");
          }
        });
      }
      $("#btn_nuevo").click(function(){
        change_view("formulario_datos");
      });
      $("#main").find(".cancelar").click(function(){
        $("#frm_datos")[0].reset();
        change_view();
      });
         $("#main").on("click",".editar_registro", function(e){
        e.preventDefault();
            change_view("formulario_datos");
        let id=$(this).data("id")
        let obj={
            "accion" : "consulta_usuarios",
            "registro" : $(this).data("id")
        }
         $.post("../includes/_funciones.php", obj, function(data){
        $("#nombre").val(data.nombre_usr);
        $("#correo").val(data.correo_usr);
        $("#trabajo").val(data.tbj_usr);
        $("#descripcion").val(data.descp_usr);
        $("#foto").val(data.foto_usr);
        $("#tipo").val(data.tipo_usr);
        $("#password").val(data.password_usr);
        $("#twitter").val(data.twitter_usr);
        $("#linkedin").val(data.linkedin_usr);
        $("#facebook").val(data.faceb_usr);
        $("#telefono").val(data.telefono_usr);
         }, "JSON");
     $("#frm_datos").find("input").keyup(function(){
          $(this).removeClass("error");
        });
      $("#registrar").click(function(){
          
          let nombre=$("#nombre").val();
        let correo=$("#correo").val();
        let trabajo=$("#trabajo").val();
        let descripcion=$("#descripcion").val();
        let foto=$("#foto").val();
        let tipo=$("#tipo").val();
        let password=$("#password").val();
        let twitter=$("#twitter").val();
        let linkedin=$("#linkedin").val();
        let facebook=$("#facebook").val();
        let telefono=$("#telefono").val();
        let obj = {
          "accion" : "insertar_usuarios",
            "nombre" : nombre,
            "correo" : correo,
            "trabajo" : trabajo,
            "descripcion" : descripcion,
            "foto" : foto,
            "tipo" : tipo,
            "password" : password,
            "twitter" : twitter,
            "linkedin" : linkedin,
            "facebook" : facebook,
            "telefono" : telefono
        };
          
       
        $("#frm_datos").find("input").each(function(){
          $(this).removeClass("error");
          if($(this).val() == ""){
            $(this).addClass("error").focus();
            return false;
          }else{
            obj[$(this).prop("name")] = $(this).val();
          }
          
        });
          if($(this).data("edicion")==1){
                obj["accion"]="editar_servicios";
                obj["registro"]=$(this).data("registro");
              $(this).text("Guardar").removeData("edicion").removeData("registro");
             }
          
          if(nombre.length==0 || correo.length==0 || trabajo.length==0 || descripcion.length==0 || foto.length==0 || tipo.length==0 || password.length==0 || twitter.length==0 || linkedin.length==0 ||facebook.length==0 || telefono.length==0){
              alert("Por favor no dejes campos vacios");
              
          }else{
              $.post("../includes/_funciones.php", obj, function(data){
                  alert(data);
                 change_view(); 
                    mostrar_servicios();
                   $("#frm_datos")[0].reset();  
              });
              
          }
          
      });
      $("#main").on("click",".eliminar_registro",function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let obj = {
          "accion" : "eliminar_usuarios",
          "usuario" : id
        }
        $.post("../includes/_funciones.php",obj, function(data){
          mostrar_usuarios();
        });
      });
      function mostrar_usuarios(){
        let obj = {
          "accion" : "mostrar_usuarios"
        }
        
        $.post("../includes/_funciones.php",obj, function(data){
          let template = ``; 
          $.each(data, function(e,elem){
            template += `
            <tr>
            <td>${elem.nombre_usr}</td>
            <td>${elem.telefono_usr}</td>
            <td>
            <a href="#" class="editar_registro"data-id="${elem.id_usr}">Editar</a>
            <a href="#" class="eliminar_registro" data-id="${elem.id_usr}">Eliminar</a></td>
            </tr>ﬂﬂﬂ
            `;
          });
          $("#table_datos tbody").html(template);
        },"JSON");      
      }
                       
    $("#signOut").click(function(){
     <?php   
	 #session_destroy();
        $_SESSION['activo']="0";
     header("Location:../index.php");
     ?>
    });          
             
    </script>
    </html>