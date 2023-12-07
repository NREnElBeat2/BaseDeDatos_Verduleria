<?php
$eliminar = $_POST['idleer'];
$conexion = mysqli_connect("localhost", "root", "", "prueba");
$consulta="DELETE FROM `verduleria` WHERE id=$eliminar;" ;

$resultado = mysqli_query($conexion, $consulta);

if ($resultado == true){
    header('Location: modificar.php');
}

?>