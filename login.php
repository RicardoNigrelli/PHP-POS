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
    <link
      rel="stylesheet"
      type="text/css"
      href="font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="styles/index.css" />
    <style>
        form {
            max-width:460px;
            width: calc(100% - 40px);
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            margin:auto;
        }
        form h3 {
        margin: 5px 0;
        }
        form input {
        padding: 7px 10px;
        width: calc(100% - 22px);
        margin-bottom:10px;
        }
        form button {
        padding: 10px 15px;
        width: calc(100%);
        background: #d86a6a;
        border: none;
        color: #fff;
        cursor:pointer;
        }

        form p {
        margin: 0;
        margin-bottom: 5px;
        font-size: 14px;
        color: #d86a6a;

        }

    </style>
  </head>
  <body>
    <header>
      <div class="logo-place"><a href="index.php">
        <img src="assets/logo.png" alt="logo" />
      </a>
    </div>    </header>
    <div class="main-content">
        <div class="content-page">
            <form action="services/login.php" method="POST">
                <h3>Iniciar Sesión</h3>
                <input type="text" name="emausu" placeholder="Email">
                <input type="password" name="pasusu" placeholder="Contraseña">
                <?php
                    if (isset($_GET['e'])) {
                        switch($_GET['e']) {
                            case '1':
                                echo '<p>Error de conexión</p>';
                                break;
                            case '2':
                                echo '<p>Email Inválido</p>';
                                break;
                            case '3':
                                echo '<p>Contraseña Incorrecta</p>';
                                break;
                            default:
                                echo '<p>Error desconocido</p>';
                                break;
                        }
                    }
                ?>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    <script type="text/javascript">
    </script>
  </body>
</html>
