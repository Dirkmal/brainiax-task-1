



function signup() {
    // collecting data and assigning to variables
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("pass").value;
    let conpassword = document.getElementById("conpass").value;

    // comparing email in regex
    function validEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
    // checking if inputs are entered
    if (username == "" || email == "" || password == "" || conpassword == "") {
        alert("input fields should be filled properly")
    } else if (password !== conpassword) {
        // checking if passwords math
        console.log("password no match")
    } else if (!validEmail(email)) {
        // checking if email is valid email type
        alert(" wrong email")
    } else {
        // prepare data to be sent to the backend
        let data = {
            username: username,
            email: email,
            password: password
        }
        console.log(data)
    }
}

function signin() {
    //     collecting the data
    let username = document.getElementById("signinuser").value;
    let password = document.getElementById("signinpass").value;
    if (username == "" || password == "") {
        alert("input fields should be filled properly")
    } else {
        // prepare data to be sent to the back end
        let data = {
            username: username,
            password: password
        }
        console.log(data)
    }


}

function closeModal()
 {
     document.getElementById('modal_background').style.display = "none";
     }