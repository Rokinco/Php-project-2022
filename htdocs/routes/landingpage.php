<?php

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora</title>
    <link href="../public/css/landingpage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>

<body>
    <!--fetch header component -->
    <?php require("../public/components/header.php"); ?>
    <style><?php include('../public/css/header.css'); ?></style>

    <script>
        var subnav = document.getElementById("subnav");
        var hamburger = document.getElementById("hamburger");

        hamburger.addEventListener("click", ()=>{
            subnav.classList.toggle("active");
        });
    </script>


    <main>
      <div id="signup-box">
        <div class="card">
          <h1 id="slogan">Ecommerce your way.</h1>
          <div class="gradient-divider">

        </div>
        <button type="button" name="button" onclick= "location.href='signup.php'">Signup Now</button>
        <p>already have an account? <a href="login.php">login here</a></p>
        </div>
      </div>
      <div class="gif-box">
        <div class="mask-1">
          <!--<img src="../public/images/image 3.png" alt="?">-->
          <video autoplay loop muted src="../public/images/resources/bg1.mp4"></video>
        </div>
        <div class="mask-2">
          <!--<img src="../public/images/image 5.png" alt="?">-->
          <video autoplay loop muted src="../public/images/resources/bg2.mp4"></video>

        </div>
        <div class="mask-3">
          <!--<img src="../public/images/image 4.png" alt="?">-->
          <video autoplay loop muted src="../public/images/resources/bg3.mp4"></video>
        </div>
      </div>
    </main>
</body>

</html>
