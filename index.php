<?php
    require_once 'controller.php';

    $tsk = new Task1;

    if(isset($_POST['sign-in'])){
		$username = $_POST['username'];
		$pass = $_POST['password'];

        $stat = $tsk->signIn($username, $pass);
        $stat = $tsk->getResponse($stat);

        $alert_type = 2;
        if ($stat->status) {
            $alert_type = 1;
        } else {
            $alert_type = 0;
        }
        $tsk->alert($stat->message, $alert_type);
	}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Brainiax | Sign In</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header class="header">
    <div>
        <a class="logo" href="#"><img src="images/logo.png" width="200" height="55"></a>
    </div>
    <nav>
        <ul>
            <li class="head-btn">
                <a href="signup.php"> Sign Up </a>
            </li>
        </ul>
    </nav>
</header>

<body>

    <div class="container">
        <h2> Sign In</h2>
        <h3> New to Brainiax? <a class="signup-link" href="signup.php">Sign Up here</a></h3>
        <form action="index.php" method="post" id="sign-in-form">
            <input type="text" placeholder=" Username" name="username" id="username" autofocus required> <br>
            <input type="password" placeholder=" Password" name="password" id="pass" required>
            <button class="hide" type="submit" name="sign-in">Sign In</button>
            <button class="div-btn" id="signIn" type="button">Sign In</button>
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