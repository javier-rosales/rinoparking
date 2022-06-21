let studentCredentialFilename = document.getElementById("student-credential-filename");
let academicProgramFilename = document.getElementById("academic-program-filename");
let driversLicenseFilename = document.getElementById("drivers-license-filename");

let studentCredentialUploadButton = document.getElementById("student-credential");
let academicProgramUploadButton = document.getElementById("academic-program");
let driversLicenseUploadButton = document.getElementById("drivers-license");

function css(element, style) {
    for (const property in style)
        element.style[property] = style[property];
}

studentCredentialUploadButton.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(studentCredentialUploadButton.files[0]);
    studentCredentialFilename.textContent = studentCredentialUploadButton.files[0].name;
    reader.onload = () => {
        css(studentCredentialFilename, {
            "display": "initial"
        });
        studentCredentialFilename.textContent = studentCredentialUploadButton.files[0].name;
    }
}

academicProgramUploadButton.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(academicProgramUploadButton.files[0]);
    academicProgramFilename.textContent = academicProgramUploadButton.files[0].name;
    reader.onload = () => {
        css(academicProgramFilename, {
            "display": "initial"
        });
        academicProgramFilename.textContent = academicProgramUploadButton.files[0].name;
    }
}

driversLicenseUploadButton.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(driversLicenseUploadButton.files[0]);
    driversLicenseFilename.textContent = driversLicenseUploadButton.files[0].name;
    reader.onload = () => {
        css(driversLicenseFilename, {
            "display": "initial"
        });
        driversLicenseFilename.textContent = driversLicenseUploadButton.files[0].name;
    }
}