try {
    document.getElementById("signUp").addEventListener("click", checkUp);
} catch(e) {
    console.log('Currently on sign up page');
}

try {
    document.getElementById("signIn").addEventListener("click", checkIn);
} catch (e) {
    console.log('Currently on sign in page');
}

function checkIn() {
    if (signin()) {
        document.getElementById('sign-in-form').submit();
    }
}

function checkUp() {
    if (signup()) {
        document.getElementById('sign-up-form').submit();
    }
}

function signup() {
    // collecting data and assigning to variables
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("pass").value;
    let conpassword = document.getElementById("conpass").value;

    // checking if inputs are entered
    if (username == "" || email == "" || password == "" || conpassword == "") {
        createAlert("Please fill in all inputs");
    } else if (!validEmail(email)) {
        // checking if email is valid email type
        createAlert("You email address has an invalid format");
    } else if (password !== conpassword) {
        // checking if passwords math
        createAlert("The passwords do not match");
    } else {
        return true;        
    }
    return false;
}

// verifying email address format in regex
function validEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

function signin() {
    //     collecting the data
    let username = document.getElementById("username").value;
    let password = document.getElementById("pass").value;
    if (username == "" || password == "") {
        createAlert("Please fill in all inputs");
    } else {
        return true;
    }
    return false;
}

function closeModal()
 {
     document.getElementById('modal_background').style.display = "none";
     }

function createAlert(message) {
    document.getElementById('js_m_bg').style.display = "block";
    var paragraph = document.getElementById("js_m_text");
    var text = document.createTextNode(message);
    paragraph.innerHTML = "";
    paragraph.appendChild(text);
}

function closeJsAlert() {
    document.getElementById('js_m_bg').style.display = "none";
}
      