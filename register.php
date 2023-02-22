<?php
include 'connection.php';
//$nombre='kk';
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
 

 //echo $nombre."-".$apellido."-".$carnet."-".$telefono."-".$genero."-".$fechaNacimiento."-".$correo."-".$password;

$sql =  "INSERT INTO `direccion` (`id`, `latitud`, `longitud`) VALUES (NULL, '$latitud', '$longitud' );
        ";

$result = $connect->query($sql);

if($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}