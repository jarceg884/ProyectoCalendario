<?php
header("Content-Type: application/json");

$pdo= new PDO("mysql:host=buiguowxmsxwe150g4dx-mysql.services.clever-cloud.com;dbname=buiguowxmsxwe150g4dx","u3pcepfrwufekq2l","2jgydnYwrk4wBOnwdZGc");



$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){

    case 'leer':
        
        $sentenciaSQL= $pdo->prepare("SELECT * FROM tbleventos");
        $sentenciaSQL->execute();
        $resultado=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($resultado));

    break;
    case 'agregar':
        
        $sentenciaSQL= $pdo->prepare("INSERT INTO `tbleventos` (`id`, `title`, `descripcion`, `color`, `start`, `end`) VALUES (NULL,:title,:descripcion,:color, :start,:end);");
        $sentenciaSQL->execute( array(
            "title"=>$_POST['title'], 
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "start"=>$_POST['fecha']." ".$_POST['hora'].":00",
            "end"=>$_POST['fecha']." ".$_POST['hora'].":00"
        ) );
        print_r($_POST);
    break;
    case "borrar":
        $sentenciaSQL= $pdo->prepare("DELETE FROM `tbleventos` WHERE `id`=:id");
        $sentenciaSQL->execute( array(
            "id"=>$_POST['id']
        ) );
        print_r($_POST);
    break;
    case "actualizar":
        $sentenciaSQL= $pdo->prepare("UPDATE `tbleventos` SET `title`=:title,`descripcion`=:descripcion,`color`=:color,`start`=:start,`end`=:end WHERE `id`=:id");
       
        $sentenciaSQL->execute( array(
            "title"=>$_POST['title'], 
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "start"=>$_POST['fecha']." ".$_POST['hora'].":00",
            "end"=>$_POST['fecha']." ".$_POST['hora'].":00",
            "id"=>$_POST['id']
        ) );
        
        print_r($_POST);
    break;


}





?> 