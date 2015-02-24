window.onload = function() {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createPatientForm'
    //-------------------------------------------------------------------------
    var createPatientForm = document.getElementById('createPatientForm');
    if (createPatientForm !== null) {
        createPatientForm.addEventListener('submit', validatePatientForm);
    }

    function validatePatientForm(event) {
        var form = event.target;

        var name = form['name'].value;
        var address = form['address'].value;
        var mobile = form['mobile'].value;
        var email = form['email'].value;
        var birthday = form['birthday'].value;
        //var ward = form['ward'].value;

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
        //if (ward === "") {
        //    errors["ward"] = "Ward cannot be empty\n";
        //}


        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;
        }
        
        
        if (!valid || !confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }

    //-------------------------------------------------------------------------
    // define an event listener for the '#createPatientForm'
    //-------------------------------------------------------------------------
    var editPatientForm = document.getElementById('editPatientForm');
    if (editPatientForm !== null) {
        editPatientForm.addEventListener('submit', validatePatientForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deletePatient' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deletePatient');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this patient?")) {
            event.preventDefault();
        }
    }

};