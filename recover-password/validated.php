<?php
require "../assets/scripts/php/database.php";

$id = $_GET["id"];

$statement = $connection->prepare("SELECT password FROM request WHERE id = :id");
$statement->execute([
    ":id" => $id
]);

if($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
}

$request = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de registro y acceso al estacionamiento de Tecnológico de Estudios Superiores de Cuautitlán Izcalli.">
        <title>Rinoparking | Recuperar contraseña</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link rel="icon" href="../assets/images/icons/rinoparking-icon.ico">
        <link rel="stylesheet" href="../assets/styles/normalize.css">
        <link rel="stylesheet" href="../assets/styles/styles.css">
    </head>
    <body>
        <header class="header">
            <img class="rinoparking-logo" src="../assets/images/rinoparking-logo-450h.png" alt="">
            <h1 class="title-1 text--center">Rinoparking</h1>
        </header>
        <main class="main">
            <h2 class="title-2 text--center">Recuperar contraseña</h2>
            <div class="card">
                <p class="text text--center">
                    Tu contraseña es:
                </p>
                <p class="text text--center">
                    <strong><?= $request["password"] ?></strong>
                </p>
                <a class="button-link" href="../index.php">Regresar</a>
            </div>
        </main>
        <footer class="footer">
            <h3 class="title-3 text--center">Ayuda</h3>
            <p class="text  text--center">
                ¿No estás seguro de cómo funciona Rinoparking? Accede a nuestra <a class="text--link" href="../assets/documents/pdf/quick-start-guide-rinoparking.pdf" target="_blank">guía rápida de inicio</a>.
            </p>
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