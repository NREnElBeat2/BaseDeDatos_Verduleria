<?php


$id = $_POST["id"];
$articulo = $_POST["articulo"];
$precio = $_POST["precio"];


$conexion = mysqli_connect("localhost", "root", "", "prueba");
$consulta = "INSERT INTO verduleria (id, articulo, precio) VALUES 
    ('$id','$articulo','$precio')"; 
$resultado = mysqli_query($conexion, $consulta);

if ($resultado == true) {
    header('Location: php.php');
}

?>
