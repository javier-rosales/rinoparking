<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require "assets/scripts/php/database.php";

    $controlNumber = $_POST["control-number"];
    $password = $_POST["password"];

    $statement = $connection->prepare("SELECT id, name, status FROM request WHERE control_number = :control_number AND password = :password");
    $statement->execute([
        ":control_number" => $controlNumber,
        ":password" => $password
    ]);

    $error = null;

    if($statement->rowCount() == 0) {
        $error = "Usuario y/o contraseña incorrectos";
    } else {
        require "assets/scripts/php/url_format.php";

        $request = $statement->fetch(PDO::FETCH_ASSOC);
        $id = $request["id"];
        $name = url_encode($request["name"]);
        $status = $request["status"];

        header("Location: status/$status.php?id=$id&name=$name");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de registro y acceso al estacionamiento de Tecnológico de Estudios Superiores de Cuautitlán Izcalli.">
        <title>Rinoparking | Inicio</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link rel="icon" href="assets/images/icons/rinoparking-icon.ico">
        <link rel="stylesheet" href="assets/styles/normalize.css">
        <link rel="stylesheet" href="assets/styles/styles.css">
    </head>
    <body>
        <header class="header">
            <img class="rinoparking-logo" src="assets/images/rinoparking-logo-450h.png" alt="">
            <h1 class="title-1 text--center">Rinoparking</h1>
        </header>
        <main class="main">
            <h2 class="title-2 text--center">Iniciar sesión</h2>
            <div class="card">
                <?php if($error): ?>
                    <p class="text text--red">
                        <?= $error?>
                    </p>
                <?php endif ?>
                <form class="form" method="POST" action="index.php">
                    <label for="control-number" hidden>Número de control</label>
                    <input class="input-text" type="text" id="control-number" name="control-number" minlength="4" maxlength="9" placeholder="Número de control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="password" hidden>Contraseña</label>
                    <input class="input-text" type="password" id="password" name="password" minlength="8" maxlength="16" placeholder="Contraseña" required>
                    <button class="button button--green" type="submit">Iniciar sesión</button>
                </form>
                <a class="text text--link text--center" href="recover-password/request.php">¿Olvidaste tu contraseña?</a>
                <a class="button-link" href="account/new-request.php">Crear nueva solicitud</a>
            </div>
        </main>
        <footer class="footer">
            <h3 class="title-3 text--center">Ayuda</h3>
            <p class="text  text--center">
                ¿No estás seguro de cómo funciona Rinoparking? Accede a nuestra <a class="text--link" href="assets/documents/pdf/quick-start-guide-rinoparking.pdf" target="_blank">guía rápida de inicio</a>.
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