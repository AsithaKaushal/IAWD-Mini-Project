function validateVolunteerForm() {
    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;
    let location = document.getElementById("location").value;
    let terms = document.getElementById("terms").checked;

   
    if (name === "") {
        alert("Please enter your name.");
        return false;
    }

    
    if (age < 18 || age > 60) {
        alert("Age must be between 18 and 60.");
        return false;
    }

    
    if (location === "") {
        alert("Please select a location.");
        return false;
    }

    
    if (!terms) {
        alert("You must accept the terms and conditions.");
        return false;
    }

    return true; 
}

function validateContactForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;

   
    if (name === "") {
        alert("Please enter your name.");
        return false;
    }

    
    if (email === "") {
        alert("Please enter your email.");
        return false;
    }

    
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("Please enter a valid email.");
        return false;
    }

    if (message === "") {
        alert("Please enter a message.");
        return false;
    }

    return true;
}
