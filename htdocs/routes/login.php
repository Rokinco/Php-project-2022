<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora</title>
    <link href="../public/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
</head>

<body>
    <header>
        <nav>
            <div id="logo">
                <h1 id="logo-h1">Agora</h1>
                <img src="../public/images/Logo.svg" alt="AgoraLogo">
            </div>
            <div id="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>
    <main>
        <div id="background"></div>
        <div id="signup-box">
            <h1>Ecommerce Your Way</h1>
            <div id="bottom-boxes">
                <div id="box1">
                    <img src="../public/images/RandomLady.png" alt="RandomLady">
                </div>
                <div id="box2">
                    <h2>Login</h2>
                    <form action="../views/loginView.php" method="POST">
                        <input type="text" name="username" placeholder="username">
                        <input type="password" name="password" placeholder="password">
                        <h5>By reading this you accept the <a href="#">Terms & Conditions</a></h5>
                        <button type="submit">Login</button>
                        <h5><a href="#">Forgot password?</a></h5>
                    </form>
                </div>
            </div>
        </div>
        <h3 id="signup">Dont have an account?<br> sign up <a href="signup.php">here</a></h3>
    </main>
</body>

</html>
