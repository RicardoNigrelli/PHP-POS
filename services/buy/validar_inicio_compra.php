<?php 
session_start();
$response=new stdClass();
if(isset($_SESSION['codusu'])) {
$response->state=false;
$response->detail="No está logueado";
$response->open_login=true;
} else {
    $response->state=true;
    $response->detail="Está logueado";
}

// mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);