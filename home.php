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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>


    <link rel="stylesheet" href="styles/style.css">
    <title>Home</title>
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
    <main>
         
        <!-- Div para información del usuario -->
          <div class="usuario">
          <p class="top">
        <p class="box">
            Hello <b><?php echo $res_Uname ?></b>, Welcome
        </p>
        <p class="box">
            Your email is <b><?php echo $res_Email ?></b>.
        </p>
    </p>
    <p class="bottom">
        <p class="box">
            Your cellphone is: <b><?php echo $res_Cellphone ?> </b>.
        </p>
    </p>
</p>
          </div>


         <!-- CALENDARIO HTML -->

         <div class="calendar">


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


    </main>

   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>





<!-- METODOS DEL CALENDARIO -->
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

</body>
</html>