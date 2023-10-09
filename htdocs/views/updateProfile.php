<?php
include("../models/user.php");
session_start();

if(!isset($_SESSION["loggedin"])){
  header("location: ../routes/signup.php");
}
//include("../controllers/businessController.php");
include("profileView.php");
$user_obj = unserialize($_SESSION["user-info"]);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Agora</title>
      <link href="../public/css/company.css" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
  </head>

  <body>
    <!-- fetch header component -->
    <?php require("../public/components/header.php"); ?>
    <style><?php include('../public/css/header.css');?></style>

  <main>
    <form class="company-form" action="../controllers/formHandling.php" method="post">

      <label for="username">Username</label>
      <input type="text" name="username" value=<?php echo $_SESSION["username"]; ?>>
      <label for="firstName">First Name</label>
      <input type="text" name="firstName" value="<?php echo $user_obj->_firstName;?>">
      <label for="lastName">Last Name</label>
      <input type="text" name="lastName" value="<?php echo $user_obj->_lastName;?>">
      <label for="email">Email</label>
      <input type="text" name="email" value="<?php echo $user_obj->email;?>">

      <button type="submit" name="button" value="update-profile">submit</button>
    </form>
    <?php
    ?>
  </main>
  <script>
      var subnav = document.getElementById("subnav");
      var hamburger = document.getElementById("hamburger");

      hamburger.addEventListener("click", ()=>{
          subnav.classList.toggle("active");
      });
  </script>
  </body>
</html>
