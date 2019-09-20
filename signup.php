<?php
    require_once 'controller.php';

    $tsk = new Task1;

    if(isset($_POST['sign-up'])){
		$username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $stat = $tsk->signUp($email, $username, $pass);
        $stat = $tsk->getResponse($stat);

        $alert_type = 2;
        $alert_link = "";
        $alert_link_text = "";
        if ($stat->status) {
            $alert_type = 1;
            $alert_link = "index.php";
            $alert_link_text = "Sign in here";
        } else {
            $alert_type = 0;
        }
        $tsk->alert($stat->message, $alert_type, $alert_link, $alert_link_text);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Brainiax | Sign Up</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header class="header">
    <div>
        <a class="logo" href="#"><img src="images/logo.png" width="200" height="55"></a>
    </div>
    <nav>
        <ul>
            <li class="head-btn">
            <a class="head-btn" href="index.php"> Sign In </a>
            </li>
        </ul>
    </nav>
</header>

<body>
    <div class="container">
        <h2> Sign Up</h2>
        <h4> Already have an account? <a class="signup-link" href="index.html">Sign In here</a></h4>
        <form action="signup.php" method="post" id="sign-up-form">
            <input type="text" placeholder=" Username" name="username" id="username" autofocus required> <br>
            <input type="email" placeholder=" Email" name="email" id="email" required> <br>
            <input type="password" placeholder=" Password" name="password" id="pass" required> <br>
            <input type="password" placeholder="Confirm Password" id="conpass" required>
            <button class="hide" type="submit" name="sign-up">Sign Up</button>
            <button class="div-btn" id="signUp" type="button">Sign Up</button>
        </form>
    </div>

    <div id='js_m_bg' onclick='closeJsAlert();'>
        <div class='alert alert-info'>
            <span class='closebtn' onclick='closeJsAlert();'>&times;</span>
            <p>
                <span class='alert-title'>Info!</span>
                <span id="js_m_text"></span>
            </p>
        </div>
    </div>
    <script type="text/javascript" src="javascript/signup.login.js"></script>
</body>

</html>