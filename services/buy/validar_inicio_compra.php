<?php 
session_start();
$response=new stdClass();

if(!isset($_SESSION['codusu'])) {
$response->state=false;
$response->detail="No está logueado";
$response->open_login=true;
} else {
    include_once('../_conexion.php');
    $codusu=$_SESSION['codusu'];
    $codpro=$_POST['codpro'];
    $sql="INSERT INTO pedido (codusu, codpro, fecped, estado, dirusuped, telusuped)
    VALUES
    ($codusu,$codpro,now(), 1,'','')";
    $result=mysqli_query($con, $sql);
    if($result) {
        $response->state=true;
        $response->detail="Producto Agregado";
    } else {
        $response->state=false;
        $response->detail="No se pudo agregar producto";
    }
    mysqli_close($con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>