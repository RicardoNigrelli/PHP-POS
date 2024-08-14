<?php
    session_start();
    if (!isset($_SESSION['codusu'])) {
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POS</title>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Sen:wght@400..800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Sen&display=swap"
      rel="stylesheet"
    />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="styles/index.css" />
  </head>
  <body>
    <header class="header-container">
      <div class="logo-place"><img src="assets/logo.png" alt="logo" /></div>
      <div><a href="pedidos.php"><i class="fa fa-shopping-cart" id="icon-fa" aria-hidden="true"></i></a></div>
    </header>
    <div class="main-content">
    <div class="content-page">
        <h3>Mi Carrito</h3>
            <div class="body-pedidos" id="space-list">

            </div>
        <input class="inp-buy" type="text" id="dirusu" placeholder="Direccion">
        <br>
        <input class="inp-buy" type="text" id="telusu" placeholder="Telefono">
        <br>
        <h4>Forma de pago</h4>
        <div class="metodo-pago">
                    <input type="radio" name="tipopago" value="1" id="tipo1">
          <label for="tipo1">Pago por transferencia</label>
                    <input type="radio" name="tipopago" value="2" id="tipo2">
          <label for="tipo2">Pago en Efectivo</label>
                    <input type="radio" name="tipopago" value="3" id="tipo3">
          <label for="tipo3">Pago por Mercado Pago</label>
        </div>
        <button onclick="procesar_compra()" style="margin-top: 10px;">Procesar compra</button>
    </div>
    </div>
    <script type="text/javascript">
     $(document).ready(function () {
        $.ajax({
          url: "services/pedido/get_pendientes.php",
          type: "POST",
          data: {},
          success: function (data) {
            console.log(data);
            let html = "";
            let sumaMonto=0
            for (let i = 0; i < data.datos.length; i++) {
              html +=
                '<div class="item-pedido">'+
                    '<div class="pedido-img">'+
                        '<img src="'+ data.datos[i].rutimapro +'" alt="">'+
                    '</div>'+
                    '<div class="pedido-detalle">'+
                        '<h3>'+ data.datos[i].nompro +'</h3>'+
                        '<p><b>Precio:</b>'+ data.datos[i].prepro +'</p>'+
                        '<p><b>Fecha:</b>'+ data.datos[i].fecped +'</p>'+
                        '<p><b>Estado:</b>'+ data.datos[i].estado +'</p>'+
                        '<p><b>Direccion:</b>'+ data.datos[i].dirusuped +'</p>'+
                        '<p><b>Teléfono:</b>'+ data.datos[i].telusuped +'</p>'+
                        
                    '</div>'+
                '</div>';
              sumaMonto+=parseInt()
            }
            document.getElementById("space-list").innerHTML=html;
          },
          error: function (error) {
            console.error(error);
          },
        });
      });
      function procesar_compra () {
        let dirusu=document.getElementById("dirusu").value;
        let telusu=$("#telusu").val();
        let tipopago=1;
        if (document.getElementById("tipo2").checked){
          tipopago=2;
        }
        if (document.getElementById("tipo3").checked){
          tipopago=3;
        }
        if (dirusu=="" || telusu=="") {
        alert("Complete los campos")
      }else{
        if (!document.getElementById("tipo1").checked && !document.getElementById("tipo2").checked && !document.getElementById("tipo3").checked) {
          alert("Seleccione un método de pago")
        } else {
          $.ajax({
            url: "services/pedido/confirm.php",
            type: "POST",
            data: {
              dirusu: dirusu,
              telusu: telusu,
              tipopago: tipopago
          },
          success: function (data) {
            console.log(data);
            if(data.state) {
              window.location.href="pedido.php";
            } else {
              alert(data.detail);
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }
      }
    }
    </script>
  </body>
</html>
