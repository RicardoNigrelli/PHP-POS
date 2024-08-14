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
        <h3>Mis Pedidos</h3>
            <div class="body-pedidos" id="space-list">

            </div>
        <div class="container-monto">
          <h2>Monto Total: $</h2>
          <h2 id="montototal"> </h2>
        </div>
        <button onclick="procesar_compra()">Procesar compra</button>
    </div>

    </div>
    <script type="text/javascript">
     $(document).ready(function () {
        $.ajax({
          url: "services/pedido/get_procesados.php",
          type: "POST",
          data: {},
          success: function (data) {
            console.log(data);
            let html = "";
            let monto=0;
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
                if (data.datos[i].estado=="Por pagar") {
                  monto+=parseFloat(data.datos[i].prepro);
                }
            }
            document.getElementById("space-list").innerHTML=html;
            document.getElementById("montototal").innerHTML=monto;

          },
          error: function (error) {
            console.error(error);
          },
        });
      });
      function procesar_compra () {
        let dirusu=document.getElementById("dirusu").value;
        let telusu=$("#telusu").val();
        if (dirusu=="" || telusu=="") {
        alert("Complete los campos")
      }else{
        $.ajax({
          url: "services/pedido/confirm.php",
          type: "POST",
          data: {
            dirusu: dirusu,
            telusu: telusu
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
    </script>
  </body>
</html>
