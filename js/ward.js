window.onload = function() {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createWardForm'
    //-------------------------------------------------------------------------
    var createWardForm = document.getElementById('createWardForm');
    if (createWardForm !== null) {
        createWardForm.addEventListener('submit', validateWardForm);
    }

    function validateWardForm(event) {
        var form = event.target;

        var name = form['name'].value;
        var numBeds = form['numBeds'].value;
        var nurse = form['nurse'].value;
        //var ward = form['ward'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (name === "") {
            errors["name"] = "Name cannot be empty\n";
        }
        if (numBeds === "") {
            errors["numBeds"] = "NumBeds cannot be empty\n";
        }
        if (nurse === "") {
            errors["nurse"] = "Nurse cannot be empty\n";
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
    // define an event listener for the '#createWardForm'
    //-------------------------------------------------------------------------
    var editWardForm = document.getElementById('editWardForm');
    if (editWardForm !== null) {
        editWardForm.addEventListener('submit', validateWardForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteWard' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteWard');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this ward?")) {
            event.preventDefault();
        }
    }

};