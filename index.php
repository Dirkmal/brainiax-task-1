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
        <form action="index.php" method="post">
            <input type="text" placeholder=" Username" name="username" autofocus required> <br>
            <input type="password" placeholder=" Password" name="password" required>
            <button class="div-btn" type="submit" name="sign-in">Sign In</button>
        </form>
    </div>

    <script type="text/javascript" src="javascript/signup.login.js"></script>
</body>

</html>