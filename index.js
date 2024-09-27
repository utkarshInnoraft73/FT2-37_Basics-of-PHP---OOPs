console.log(isNaN("76"));
/**
 * Make Funtion for checking input.
 * @returns true if all the inputs are correct otherwise false.
 */
function checkInputs(){
    var fname = document.getElementById("fname").value; // Store the first name.
    var lname = document.getElementById("lname").value; // Store the last name.
    var marks = document.getElementById("marks").value.trim(); // Store the subject marks pair.
    var fnameErr = document.getElementById("fnameErr"); // Store the first name error.
    var lnameErr = document.getElementById("lnameErr"); // Store the last name error.
    var marksErr = document.getElementById("marksErr"); // Store the phone number error.
    

    var namePatrn = /^[a-zA-Z'-]+$/; // Valid name pattern.


    // Cheking if the all field are filled or not.
    if((fname === "") || (lname === "")){
        errMsg.innerHTML = "Every field marked with * is required.";
        return false;
    }

    // Check if the name is given correctly or not.
    if(!namePatrn.test(fname) || !namePatrn.test(lname)){
        !namePatrn.test(fname)?fnameErr.innerHTML = "Invalid name input.":lnameErr.innerHTML = "Invalid name input.";
        return false;
    }
    
    var lines = marks.split('\n');
    var valid = true;

    for(var i = 0; i<lines.length; i++){
        var parts = lines[i].split('|');
        if(parts.length !==2 || parts[0].trim() === "" || !parts[1].trim() === "" || !isNaN(parts[0].trim()) || isNaN(parts[1].trim())){
            valid = false;
            break;
        }
        if(!namePatrn.test(parts[0])){
            valid = false;
            break;
        }
    }

    if (!valid){
        marksErr.innerHTML = "Invalid! Please enter the given format."
        return false;
    }

    // Return true if every field is correct.
    return true;

}