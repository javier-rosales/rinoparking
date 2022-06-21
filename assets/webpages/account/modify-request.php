<?php
require "../../../database.php";

$id = $_GET["id"];

$statement = $connection->prepare("SELECT * FROM user WHERE id = :id");
$statement->execute([":id" => $id]);

if($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $lastName = $_POST["last-name"];
    $secondLastName = $_POST["second-last-name"];
    $studentCredentialName = $_FILES["student-credential"]["name"];
    $studentCredentialType = $_FILES["student-credential"]["type"];
    $studentCredentialData = file_get_contents($_FILES["student-credential"]["tmp_name"]);
    $academicProgramName = $_FILES["academic-program"]["name"];
    $academicProgramType = $_FILES["academic-program"]["type"];
    $academicProgramData = file_get_contents($_FILES["academic-program"]["tmp_name"]);
    $driversLicenseName = $_FILES["drivers-license"]["name"];
    $driversLicenseType = $_FILES["drivers-license"]["type"];
    $driversLicenseData = file_get_contents($_FILES["drivers-license"]["tmp_name"]);
    $controlNumber = $_POST["control-number"];
    $password = $_POST["password"];
    $passwordConfirmation = $_POST["password-confirmation"];

    $error = null;

    if($password == $passwordConfirmation) {
        $statement = $connection->prepare("UPDATE user SET email = :email, name = :name, last_name = :last_name, second_last_name = :second_last_name, student_credential_name = :student_credential_name, student_credential_mime = :student_credential_mime, student_credential_data = :student_credential_data, academic_program_name = :academic_program_name, academic_program_mime = :academic_program_mime, academic_program_data = :academic_program_data, drivers_license_name = :drivers_license_name, drivers_license_mime = :drivers_license_mime, drivers_license_data = :drivers_license_data, control_number = :control_number, password = :password, status = \"pending\" WHERE id = :id");

        $statement->execute([
            ":id" => $id,
            ":email" => $email,
            ":name" => $name,
            ":last_name" => $lastName,
            ":second_last_name" => $secondLastName,
            ":student_credential_name" => $studentCredentialName,
            ":student_credential_mime" => $studentCredentialType,
            ":student_credential_data" => $studentCredentialData,
            ":academic_program_name" => $academicProgramName,
            ":academic_program_mime" => $academicProgramType,
            ":academic_program_data" => $academicProgramData,
            ":drivers_license_name" => $driversLicenseName,
            ":drivers_license_mime" => $driversLicenseType,
            ":drivers_license_data" => $driversLicenseData,
            ":control_number" => $controlNumber,
            ":password" => $password
        ]);

        header("Location: ../../../index.php?action=modify-request");
        return;
    } else {
        $error = "Las contraseñas no coinciden";
    }
} else {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de registro y acceso al estacionamiento de Tecnológico de Estudios Superiores de Cuautitlán Izcalli.">
        <title>Rinoparking | Modificar solicitud</title>
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
            <h2 class="title-2 text--center">Modificar solicitud</h2>
            <div class="card">
                <?php if($error): ?>
                    <p class="text text--red">
                        <?= $error?>
                    </p>
                <?php endif ?>
                <form class="form" method="POST" action="modify-request.php?id=<?= $id ?>" enctype="multipart/form-data">
                    <label for="email" hidden>Correo electrónico</label>
                    <input class="input-text" type="email" id="email" name="email" maxlength="50" placeholder="Correo electrónico" required value="<?= $user["email"] ?>">
                    <label for="name" hidden>Nombre</label>
                    <input class="input-text" type="text" id="name" name="name" minlength="3" maxlength="30" placeholder="Nombre(s)" required value="<?= $user["name"] ?>">
                    <label for="last-name" hidden>Apellido paterno</label>
                    <input class="input-text" type="text" id="last-name" name="last-name" minlength="3" maxlength="30" placeholder="Apellido paterno" required value="<?= $user["last_name"] ?>">
                    <label for="second-last-name" hidden>Apellido materno</label>
                    <input class="input-text" type="text" id="second-last-name" name="second-last-name" minlength="3" maxlength="30" placeholder="Apellido materno" value="<?= $user["second_last_name"] ?>">
                    <label for="student-credential" class="input-file-label">Credencial de estudiante (PDF)</label>
                    <input class="input-file" type="file" id="student-credential" name="student-credential" accept="application/pdf" required>
                    <label for="academic-program" class="input-file-label">Carga académica (PDF)</label>
                    <input class="input-file" type="file" id="academic-program" name="academic-program" accept="application/pdf" required>
                    <label for="drivers-license" class="input-file-label">Licencia de conducir (PDF)</label>
                    <input class="input-file" type="file" id="drivers-license" name="drivers-license" accept="application/pdf" required>
                    <label for="control-number" hidden>Número de control</label>
                    <input class="input-text" type="text" id="control-number" name="control-number" minlength="" maxlength="9" placeholder="Número de control" required value="<?= $user["control_number"] ?>">
                    <label for="password" hidden>Contraseña (8-16 caracteres)</label>
                    <input class="input-text" id="password" name="password" type="password" minlength="8" maxlength="16" placeholder="Contraseña (8-16 caracteres)" required value="<?= $user["password"] ?>">
                    <label for="password-confirmation" hidden>Confirmar contraseña</label>
                    <input class="input-text" id="password-confirmation" name="password-confirmation" type="password" minlength="8" maxlength="16" placeholder="Confirmar contraseña" required>
                    <button class="button button--green" type="submit">Confirmar</button>
                </form>
                <a class="button-link" href="../status/refused.php?id=<?= $id ?>">Cancelar</a>
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