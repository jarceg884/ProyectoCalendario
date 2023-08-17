<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Navegacion por pestañas</title>

		    <!-- Bootstrap CSS v5.0.2 -->
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

			<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
			<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>


	<link rel="stylesheet" href="styles/estilos.css">
	<script src="js/script.js" defer></script>






</head>
<body>
	<div class="nav">
		<div class="logo">
            <img class="goes" src="img/goesGG.png" alt="">
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Cellphone = $result['Cellphone'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>

	<div class="menu">
	<p data-target="#inicio">Inicio</p>
	<p data-target="#calendario">Calendario</p>
	<p data-target="#Foro">Foro</p>
	<p data-target="#perfil">Perfil de Usuario</p>
	<p data-target="#usuarios">Usuarios</p>

	</div>

	<div class="content">

		<div data-content id="inicio" class="active">
			<h1>Inicio</h1>
			
			    <!-- Agregar los datos del usuario aquí -->
				<div id="datos-usuario">
					<div style="float: left; margin-right: 15px;">
						<img src="img/goesGG.png" alt="Imagen de perfil" style="width: 100px; height: 100px; border-radius: 50%;">
					</div>
					<p class="pI"><strong>Nombre de usuario:</strong> <?php echo $res_Uname; ?></p>
					<p class="pI"><strong>Email:</strong> <?php echo $res_Email; ?></p>
					<p class="pI"><strong>Teléfono:</strong> <?php echo $res_Cellphone; ?></p>

					<h2>Gobiernos Estudiantiles en ULACIT</h2>
					<p>Los gobiernos estudiantiles en la ULACIT juegan un papel crucial en la representación estudiantil y en el desarrollo de actividades extracurriculares. Estos son algunos aspectos clave:</p>
					<ul>
					<li>Funcionan como el principal canal de comunicación entre los estudiantes y la administración universitaria.</li>
					<li>Organizan eventos, charlas y actividades que enriquecen la vida estudiantil.</li>
					<li>Promueven la participación activa de los estudiantes en la toma de decisiones universitarias.</li>
					<li>Fomentan el liderazgo, el trabajo en equipo y otras habilidades blandas entre sus miembros.</li>
				</div>


		</div>

		<div data-content id="calendario">
			<h1>Calendario</h1>
						<div class="cont">


				<div class="col-md-8 offset-md-2 ">

				<div id='calendar'></div>
				
				</div>

				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalEvento">
				Launch
				</button>
				
				<!-- Modal -->
				<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Datos del evento </h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
					<div class="modal-body">
						<div class="container-fluid">
						
						<form action="" method="post">

						<div class="mb-3 visually-hidden ">
							<label for="id" class="form-label">ID:</label>
							<input type="text"
							class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
						</div>

						<div class="mb-3">
							<label for="titulo" class="form-label">Título</label>
							<input type="text"
							class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
							
						</div>
						<div class="mb-3 visually-hidden">
							<label for="" class="form-label">Fecha:</label>
							<input type="text"
							class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha:">
							
						</div>

						<div class="mb-3">
							<label for="hora" class="form-label">Hora del evento:</label>
							<input type="time"
							class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora:">
							
						</div>

						<div class="mb-3">
							<label for="descripcion" class="form-label">Descripción</label>
							<textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
						</div>

						<div class="mb-3">
							<label for="color" class="form-label">Color:</label>
							<input type="color"
							class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Color:">
							
						</div>

						</form>


						</div>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="borrarEvento()" class="btn btn-danger" id="btnBorrar" data-bs-dismiss="modal">Borrar</button>
						<button type="button" onclick="agregarEvento()" id="btnGuardar" class="btn btn-primary">Guardar</button>
					</div>
					</div>
				</div>
				</div>
				


			</div>
			<!-- Bootstrap JavaScript Libraries -->
				<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
			
		</div>

		<div data-content id="Foro">
			<h1>Foro</h1>
			<!-- Formulario para enviar comentarios -->
			<form action="agregar_comentario.php" method="post" class="comment-form">
            <textarea name="comentario" placeholder="Escribe tu comentario aquí"></textarea>
            <button type="submit">Enviar comentario</button>
           </form>
			
		       <!-- Mostrar los comentarios existentes -->
			<?php
			// Consultar los comentarios desde la base de datos
			$query = mysqli_query($con, "SELECT * FROM comentarios ORDER BY fecha_publicacion DESC");
			while ($comentario = mysqli_fetch_assoc($query)) {
				$nombre_usuario = $comentario['nombre_usuario'];
				$contenido = $comentario['contenido'];
				$fecha_publicacion = $comentario['fecha_publicacion'];

				// Mostrar cada comentario en el foro
				echo "<div class='comentario'>";
				echo "<p><strong>$nombre_usuario:</strong></p>";
				echo "<p>$contenido</p>";
				echo "<p class='fecha'>$fecha_publicacion</p>";
				echo "</div>";
			}
			?>

		</div>

		<div data-content id="perfil">
				<div class="container mt-5">
				<?php 
		

		include("php/config.php");
		if(!isset($_SESSION['valid'])){
			header("Location: Menu.php");
		}

		$id = $_SESSION['id'];
		$query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id");

		$user = mysqli_fetch_assoc($query);

		?>
			<h2>Perfil de Usuario</h2>
			
			<hr>

			<div class="Perfil">
				<div class="row">
				<div class="col-md-4">
					<!-- Foto de perfil del usuario -->
					<img src="img/goesGG.png" alt="Imagen de perfil" class="img-thumbnail">
					<a href="edit.php?Id=<?php echo $user['Id']; ?>" class="btn btn-primary mt-3">Editar Perfil</a>
				</div>

				<div class="col-md-8">
					<div class="mb-3">
						<label><strong>Nombre de usuario:</strong></label>
						<p><?php echo $user['Username']; ?></p>
					</div>

					<div class="mb-3">
						<label><strong>Email:</strong></label>
						<p><?php echo $user['Email']; ?></p>
					</div>

					<div class="mb-3">
						<label><strong>Teléfono:</strong></label>
						<p><?php echo $user['Cellphone']; ?></p>
					</div>
				</div>
				</div>
			</div>

			<hr>
			<a href="php/logout.php" class="btn btn-danger">Cerrar Sesión</a>

		</div>
		

</body>
</html>

<script>
  
  var modalEvento;
  
  modalEvento= new bootstrap.Modal( document.getElementById('modalEvento'),{ keyboard:false } );
  var calendar;

  document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth', 
    locale:"es", 
    headerToolbar:{
      left:'prev,next today', 
      center:'title', 
      right:'dayGridMonth,timeGridWeek,timeGridDay'
    }, 
    dateClick:function(informacion){
      
      limpiarFormulario(informacion.dateStr);
      // alert("Presionaste "+informacion.dateStr);
      modalEvento.show();

    }, 
    eventClick:function(informacion){
      console.log(informacion);
      modalEvento.show();
      recuperarDatosEvento(informacion.event);

    },
    events:"api.php"
  });
  calendar.render();
});
</script>
<script>
function recuperarDatosEvento(evento){
  limpiarErrores();
  var fecha= evento.startStr.split("T");
  var hora= fecha[1].split(":");

  document.getElementById('id').value=evento.id;
  document.getElementById('titulo').value=evento.title;
  document.getElementById('fecha').value=fecha[0];
  document.getElementById('hora').value=hora[0]+":"+hora[1];
  document.getElementById('descripcion').value=evento.extendedProps.descripcion;
  document.getElementById('color').value=evento.backgroundColor;

  document.getElementById('btnBorrar').removeAttribute('disabled',"");
  document.getElementById('btnGuardar').removeAttribute('disabled',"");


}
function borrarEvento(){
    enviarDatosApi("borrar");

}
function agregarEvento(){

  if(document.getElementById('titulo').value==""){
    document.getElementById('titulo').classList.add('is-invalid');
    return true;
  }
    


  accion= (document.getElementById("id").value==0)?"agregar":"actualizar";
  enviarDatosApi(accion);

}
function enviarDatosApi(accion){
        fetch("api.php?accion="+accion,{
            method:"POST",
            body:recolectarDatos()
          })
          .then(data=>{
            console.log(data);
            calendar.refetchEvents();
            modalEvento.hide();
          })
          .catch(error=>{
            console.log(error);
          });
}

function recolectarDatos(){
  var evento=new FormData(); 
  evento.append("title", document.getElementById('titulo').value);
  evento.append("fecha", document.getElementById('fecha').value);
  evento.append("hora", document.getElementById('hora').value);
  evento.append("descripcion", document.getElementById('descripcion').value);
  evento.append("color", document.getElementById('color').value);
  evento.append("id", document.getElementById('id').value);
  return evento;
}
function limpiarFormulario(fecha){
  limpiarErrores();
  document.getElementById('titulo').value="";
  document.getElementById('fecha').value=fecha;
  document.getElementById('hora').value="12:00";
  document.getElementById('descripcion').value="";
  document.getElementById('color').value="";
  document.getElementById('id').value="";
  document.getElementById('btnBorrar').setAttribute('disabled',"disabled");
}
function limpiarErrores(){
  document.getElementById('titulo').classList.remove('is-invalid');
}

</script>