<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../assets/scripts/php/database.php";

    $controlNumber = $_POST["control-number"];
    $name = $_POST["name"];
    $lastName = $_POST["last-name"];

    $statement = $connection->prepare("SELECT id FROM request WHERE control_number = :control_number AND name = :name AND last_name = :last_name");
    $statement->execute([
        ":control_number" => $controlNumber,
        ":name" => $name,
        ":last_name" => $lastName
    ]);

    $error = null;

    if($statement->rowCount() == 0) {
        $error = "El usuario no existe";
    } else {
        require "../assets/scripts/php/url_format.php";

        $request = $statement->fetch(PDO::FETCH_ASSOC);
        $id = $request["id"];

        header("Location: validated.php?id=$id");
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
                <?php if($error): ?>
                    <p class="text text--red">
                        <?= $error?>
                    </p>
                <?php endif ?>
                <form class="form" method="POST" action="request.php">
                    <label for="control-number" hidden>Número de control</label>
                    <input class="input-text" type="text" id="control-number" name="control-number" minlength="" maxlength="9" placeholder="Número de control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="name" hidden>Nombre</label>
                    <input class="input-text" type="text" id="name" name="name" minlength="3" maxlength="30" placeholder="Nombre(s)" pattern="[A-Z .]+" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="last-name" hidden>Apellido paterno</label>
                    <input class="input-text" type="text" id="last-name" name="last-name" minlength="3" maxlength="30" placeholder="Apellido paterno" pattern="[A-Z .]+" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <button class="button button--green" type="submit">Confirmar</button>
                </form>
                <a class="button-link" href="../index.php">Cancelar</a>
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