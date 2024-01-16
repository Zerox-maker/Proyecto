<?php
$nombre = $_POST['nombre'];
$postal = $_POST['postal'];
$calle = $_POST['calle'];
$numeroex = $_POST['numero'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$cantidad = $_POST['cantidad'];

if(!empty($nombre) || !empty($postal) || !empty($calle) || !empty($numeroex) || !empty($email) || !empty($telefono) || !empty($cantidad))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "Ropa";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error())
    {
        die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT telefono from formulario where telefono = ? limit 1";
        $INSERT = "INSERT INTO formulario(nombre,postal,calle,numeroex,email,telefono,cantidad) values(?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt -> bind_param("i", $telefono);
        $stmt -> execute();
        $stmt -> bind_result($telefono);
        $stmt -> store_result();
        $rnum = $stmt->num_rows;
        if($rnum == 0){
            $stmt ->close();
            $stmt = $conn->prepare($INSERT);
            $stmt -> bind_param("sisssii", $nombre,$postal,$calle,$numeroex,$email,$telefono,$cantidad);
            $stmt -> execute();
            echo "Compra Completada.";
        }
        else{
            echo "Alguien registro ese numero.";
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo "todos los datos son Obligatorios";
    die();
}
