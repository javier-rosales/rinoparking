let filename = document.querySelectorAll(".filename");

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
    filename[0].textContent = studentCredentialUploadButton.files[0].name;
    reader.onload = () => {
        css(filename[0], {
            "display": "initial"
        });
        filename[0].textContent = studentCredentialUploadButton.files[0].name;
    }
}

academicProgramUploadButton.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(academicProgramUploadButton.files[0]);
    filename[1].textContent = academicProgramUploadButton.files[0].name;
    reader.onload = () => {
        css(filename[1], {
            "display": "initial"
        });
        filename[1].textContent = academicProgramUploadButton.files[0].name;
    }
}

driversLicenseUploadButton.onchange = () => {
    let reader = new FileReader();
    reader.readAsDataURL(driversLicenseUploadButton.files[0]);
    filename[2].textContent = driversLicenseUploadButton.files[0].name;
    reader.onload = () => {
        css(filename[2], {
            "display": "initial"
        });
        filename[2].textContent = driversLicenseUploadButton.files[0].name;
    }
}