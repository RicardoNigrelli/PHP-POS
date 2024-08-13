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
      <div><a href="carrito.php"><i class="fa fa-shopping-cart" id="icon-fa" aria-hidden="true"></i></a></div>
    </header>
    <div class="main-content">
      <div class="content-page">
        <section>
            <div class="part1">
                <img id="idimg" src="" alt="">
            </div>
            <div class="part2">
                <h2 id="idtitle"></h2>
                <h3 id="idprice"></h3>
                <h4 id="iddescription"></h4>
                <button onclick="iniciar_compra()">Comprar</button>
            </div>

        </section>
        <div class="title-section">Productos</div>
        <div class="products-list" id="space-list">

        </div>
      </div>
    </div>
    <script>
        let p='<?php echo $_GET["p"]; ?>';
    </script>
    <script type="text/javascript">
      $(document).ready(function () {
        $.ajax({
          url: "services/products/get_all_products.php",
          type: "POST",
          data: {},
          success: function (data) {
            console.log(data);
            let html = "";
            for (let i = 0; i < data.datos.length; i++) {
                if (data.datos[i].codpro==p) {
                    document.getElementById("idimg").src=data.datos[i].rutimapro;
                    document.getElementById("idtitle").innerHTML=data.datos[i].nompro;
                    document.getElementById("idprice").innerHTML=data.datos[i].prepro;
                    document.getElementById("iddescription").innerHTML=data.datos[i].despro;
                    
                    
                }
                html +=
                '<div class="product-box">' +
                '<a href="producto.php?p='+data.datos[i].codpro+'">' +
                '<div class="product">' +
                '<img src="' +
                data.datos[i].rutimapro +
                '" alt="" />' +
                '<div class="detail-title">' +
                data.datos[i].nompro +
                "</div>" +
                '<div class="detail-description">' +
                data.datos[i].despro +
                "</div>" +
                '<div class="detail-price"> $' +
                data.datos[i].prepro +
                "</div>" +
                "</div>" +
                "</a>" +
                "</div>";
            }
            document.getElementById("space-list").innerHTML=html;
          },
          error: function (error) {
            console.error(error);
          },
        });
      });

      function iniciar_compra() {
                $.ajax({
          url: "services/buy/validar_inicio_compra.php",
          type: "POST",
          data: {
            codpro:p
          },
          success: function (data) {
            if (data.state) {
              alert(data.detail);
            } else {
              alert(data.detail);
              if (data.open_login) {
                open_login()
              }
            }
          },
          error:function(err){
            console.error(err)
          }
      })}

      function open_login(){
        window.location.href="login.php"
      }
    </script>
  </body>
</html>
