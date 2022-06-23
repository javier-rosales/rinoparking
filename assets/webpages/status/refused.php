<?php
require "../../scripts/php/url_format.php";

$id = $_GET["id"];
$name = url_decode($_GET["name"]);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de registro y acceso al estacionamiento de Tecnológico de Estudios Superiores de Cuautitlán Izcalli.">
        <title>Rinoparking | Solicitud rechazada</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link rel="icon" href="../../images/icons/rinoparking-icon.ico">
        <link rel="stylesheet" href="../../styles/normalize.css">
        <link rel="stylesheet" href="../../styles/styles.css">
    </head>
    <body>
        <header class="header">
            <img class="rinoparking-logo" src="../../images/rinoparking-logo-450h.png" alt="">
            <h1 class="title-1 text--center">Rinoparking</h1>
        </header>
        <main class="main">
            <div class="card">
                <h4 class="title-4 text--center">BIENVENIDO <?= $name ?></h4>
                <p class="text text--center">
                    Estado: <strong class="text--red">Rechazado</strong>
                </p>
                <p class="text text--justify">
                    Tu solicitud fue rechazada. Por favor, revisa la nota que dejamos a continuación y modifica tu solicitud (Tendrás que subir nuevamente los archivos PDF).
                </p>
                <p class="text text--center text--bold">
                    La licencia de conducir carece de calidad de imagen. No se aprecian los datos correctamente.
                </p>
                <a class="button-link" href="../account/modify-request.php?id=<?= $id ?>">Modificar solicitud</a>
                <a class="button-link button-link--red" href="../../../index.php">Salir</a>
            </div>
        </main>
        <footer class="footer">
            <h3 class="title-3 text--center">Ayuda</h3>
            <p class="text text--center">
                ¿Tienes dudas o requieres atención especializada? Comunícate con nosotros.
            </p>
            <p class="text text--center">
                Correo electrónico:<br>
                rinoparking.ayuda@tesci.mx<br>
            </p>
            <p class="text text--center">
                Teléfonos:<br>
                5570801009<br>
                5547832018
            </p>
            <p class="text text--bold text--big text--center">
                Tecnológico de Estudios Superiores de Cuautitlán Izcalli
            </p>
        </footer>
    </body>
</html>