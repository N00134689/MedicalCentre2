function validateCreatePatient(form) {
    var name = form['name'].value;
    var address = form['address'].value;
    var mobile = form['mobile'].value;
    var email = form['email'].value;
    var birthday = form['birthday'].value;
    var ward = form['ward'].value;

    var spanElements = document.getElementsByClassName("error");
    for (var i = 0; i !== spanElements.length; i++) {
        spanElements[i].innerHTML = "";
    }

    var errors = new Object();

    if (name === "") {
        errors["name"] = "Username cannot be empty\n";
    }
    if (address === "") {
        errors["address"] = "Address cannot be empty\n";
    }
    if (mobile === "") {
        errors["mobile"] = "Moblie cannot be empty\n";
    }
    if (email === "") {
        errors["email"] = "Email cannot be empty\n";
    }
    if (birthday === "") {
        errors["birthday"] = "Birthday cannot be empty\n";
    }
    if (ward === "") {
        errors["ward"] = "Ward cannot be empty\n";
    }


    var valid = true;
    for (var index in errors) {
        valid = false;
        var errorMessage = errors[index];
        var spanElement = document.getElementById(index + "Error");
        spanElement.innerHTML = errorMessage;
    }
    return valid;
}







