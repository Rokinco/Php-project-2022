<?php
include("../models/business.php");
session_start();

if(!isset($_SESSION["loggedin"])){
  header("location: ../routes/signup.php");
}
//include("../controllers/businessController.php");
include("profileView.php");
$bus_instance =  unserialize($_SESSION["business"]);

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
    <form class="company-form" action="../controllers/formHandling.php" method="post" enctype="multipart/form-data">

      <label for="compName">Company Name</label>
      <input type="text" name="compName" value="">
      <label for="compDes">Company Description</label>
      <input type="text" name="compDes" value="">
      <label for="compLogo">Company Logo</label>
      <input type="file" name="compLogo" value="" accept="image/*">
      <button type="submit" name="button" value="compCreate">submit</button>
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
