<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../assets/scripts/php/database.php";
    
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

    $name = trim($name);
    $lastName = trim($lastName);
    $secondLastName = trim($secondLastName);
    $controlNumber = trim($controlNumber);

    $error = null;

    $request = $connection->prepare("SELECT control_number FROM request WHERE control_number = :control_number");
    $request->execute([":control_number" => $controlNumber]);

    if($password == $passwordConfirmation) {
        if($request->rowCount() == 0) {
            $statement = $connection->prepare("INSERT INTO request(name, last_name, second_last_name, student_credential_name, student_credential_mime, student_credential_data, academic_program_name, academic_program_mime, academic_program_data, drivers_license_name, drivers_license_mime, drivers_license_data, control_number, password, status) values(:name, :last_name, :second_last_name, :student_credential_name, :student_credential_mime, :student_credential_data, :academic_program_name, :academic_program_mime, :academic_program_data, :drivers_license_name, :drivers_license_mime, :drivers_license_data, :control_number, :password, \"pending\")");
        
            $statement->execute([
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
        ?>
        <script src="../assets/scripts/javascript/new-request.js"></script>
        <?php
        } else {
            $error = "Este n??mero de control ya est?? registrado";
        }
    } else {
        $error = "Las contrase??as no coinciden";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de registro y acceso al estacionamiento de Tecnol??gico de Estudios Superiores de Cuautitl??n Izcalli.">
        <title>Rinoparking | Nueva solicitud</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link rel="icon" href="../assets/images/icons/rinoparking-icon.ico">
        <link rel="stylesheet" href="../assets/styles/normalize.css">
        <link rel="stylesheet" href="../assets/styles/styles.css">
        <script src="../assets/scripts/javascript/set-filename.js" defer></script>
        <script src="../assets/scripts/javascript/confirmation.js" async></script>
    </head>
    <body>
        <header class="header">
            <img class="rinoparking-logo" src="../assets/images/rinoparking-logo-450h.png" alt="">
            <h1 class="title-1 text--center">Rinoparking</h1>
        </header>
        <main class="main">
            <h2 class="title-2 text--center">Nueva solicitud</h2>
            <div class="card">
                <?php if($error): ?>
                    <p class="text text--red">
                        <?= $error ?>
                    </p>
                <?php endif ?>
                <form class="form" method="POST" action="new-request.php" enctype="multipart/form-data" onsubmit="return confirmNewRequest()">
                    <label for="name" hidden>Nombre</label>
                    <input class="input-text" type="text" id="name" name="name" minlength="3" maxlength="30" placeholder="Nombre(s)" pattern="[A-Z .]+" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="last-name" hidden>Apellido paterno</label>
                    <input class="input-text" type="text" id="last-name" name="last-name" minlength="3" maxlength="30" placeholder="Apellido paterno" pattern="[A-Z .]+" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="second-last-name" hidden>Apellido materno</label>
                    <input class="input-text" type="text" id="second-last-name" name="second-last-name" minlength="3" maxlength="30" placeholder="Apellido materno" pattern="[A-Z .]+" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                    <p class="text text--center text--green-theme filename"></p>
                    <label for="student-credential" class="input-file-label">Credencial de estudiante (PDF)</label>
                    <input class="input-file" type="file" id="student-credential" name="student-credential" accept="application/pdf" required>
                    <p class="text text--center text--green-theme filename"></p>
                    <label for="academic-program" class="input-file-label">Carga acad??mica (PDF)</label>
                    <input class="input-file" type="file" id="academic-program" name="academic-program" accept="application/pdf" required>
                    <p class="text text--center text--green-theme filename"></p>
                    <label for="drivers-license" class="input-file-label">Licencia de conducir (PDF)</label>
                    <input class="input-file" type="file" id="drivers-license" name="drivers-license" accept="application/pdf" required>
                    <label for="control-number" hidden>N??mero de control</label>
                    <input class="input-text" type="text" id="control-number" name="control-number" minlength="" maxlength="9" placeholder="N??mero de control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
                    <label for="password" hidden>Contrase??a (8-16 caracteres)</label>
                    <input class="input-text" id="password" name="password" type="password" minlength="8" maxlength="16" placeholder="Contrase??a (8-16 caracteres)" required>
                    <label for="password-confirmation" hidden>Confirmar contrase??a</label>
                    <input class="input-text" id="password-confirmation" name="password-confirmation" type="password" minlength="8" maxlength="16" placeholder="Confirmar contrase??a" required>
                    <button id="button-submit" class="button button--green" type="submit">Confirmar</button>
                </form>
                <a class="text text--link text--center" href="../index.php">??Ya tienes una cuenta?</a>
            </div>
        </main>
        <footer class="footer">
            <h3 class="title-3 text--center">Ayuda</h3>
            <p class="text  text--center">
                ??No est??s seguro de c??mo funciona Rinoparking? Accede a nuestra <a class="text--link" href="../assets/documents/pdf/quick-start-guide-rinoparking.pdf" target="_blank">gu??a r??pida de inicio</a>.
            </p>
            <p class="text text--center">
                ??Tienes dudas o requieres atenci??n especializada? Comun??cate con nosotros.
            </p>
            <p class="text text--center">
                Correo electr??nico:<br>
                rinoparking.ayuda@tesci.mx<br>
            </p>
            <p class="text text--center">
                Tel??fonos:<br>
                5570801009<br>
                5547832018
            </p>
            <p class="text text--bold text--big text--center">
                Tecnol??gico de Estudios Superiores de Cuautitl??n Izcalli
            </p>
        </footer>
    </body>
</html>