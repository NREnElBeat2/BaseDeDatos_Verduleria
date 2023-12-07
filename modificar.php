<?php
//Se crea la funcion editar_registro y recibe conexion
function editar_registro($conexion) {

    //Es un if que recibe los datos del formulario con metodo post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Son 2 for que recorren fila por fila actualizando los datos de ARTICULO segun el id
        foreach ($_POST['articulo'] as $id => $nuevoArticulo) {
            $id = mysqli_real_escape_string($conexion, $id);
            $nuevoArticulo = mysqli_real_escape_string($conexion, $nuevoArticulo);

            $consultaActualizar = "UPDATE verduleria SET articulo = '$nuevoArticulo' WHERE id = $id";
            mysqli_query($conexion, $consultaActualizar);
            
        }
        //Son 2 for que recorren fila por fila actualizando los datos de PRECIO segun el id
        foreach ($_POST['precio'] as $id1 => $nuevoPrecio) {
            $id = mysqli_real_escape_string($conexion, $id1);
            $nuevoPrecio = mysqli_real_escape_string($conexion, $nuevoPrecio);

            $consultaActualizar1 = "UPDATE verduleria SET precio = '$nuevoPrecio' WHERE id = $id1";
            mysqli_query($conexion, $consultaActualizar1);
            
        }
        //Te redirecciona a la pagina php.php
        header("Location: php.php");
        exit();
    }
}





$conexion = mysqli_connect("localhost", "root", "", "prueba");
$consulta = "SELECT * FROM verduleria";
$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php

//Es un if que si detecta que la columna es mayor a 0
if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo'<form method="post" action="">';
        
        //el while con la consulta mysqli_fetch_assoc te toma todos los valores de la tabla dentro de la base de datos
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<input class="cur" style="all: unset;" value="' . $fila['articulo'] . ' "></input>';
            echo '<input class="cur" style="background-color: #dc3545;" type="text" name="id[' . $fila['id'] . ']" value="' . $fila['id'] . ' "readonly>';
            echo '<input style="background-color: #198754;" type="text" name="articulo[' . $fila['id'] . ']" value="' . $fila['articulo'] . '">';
            echo '<input style="background-color: #198754;;" type="text" name="precio[' . $fila['id'] . ']" value="' . $fila['precio'] . ' "><br><br>';
        }
        
    echo'<button type="submit">Guardar Cambios</button><br><br><br><br>';
    echo'</form>';
}else{
    echo'No hay articulos agregados';
}
 ?>
 <!--Es un formulario que envia el ID que ingreses al eliminar.php-->
    <form method="POST" action= "eliminar.php">
        <h3>¿Que producto desea eliminar? Inserte id:</h3>
        <input type="text" name="idleer"><br><br>
        <button type="submit">Eliminar Producto</button>
    </form>
    <br><br>
    <a href="php.php"><button >Volver</button></a>

    <?php

    //envia el parametro con el valor de conexion a la funcion editar_registro()
    editar_registro($conexion);


    mysqli_free_result($resultado);
    mysqli_close($conexion);
    ?>
</body>
</html>
