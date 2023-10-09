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
    <form class="company-form" action="../controllers/formHandling.php" method="post">

      <label for="NewUser">Employee Username</label>
      <input type="text" name="NewUser" value="">
      <label for="roleOption">Employee Role</label>
      <select class="" name="roleOption">
        <?php

        foreach($bus_instance->ROLES as $role){
          $RoleID = $role["RoleID"];
          $RoleName = $role['RoleName'];
          echo "<option value='{$RoleID}'>{$RoleName}</option>";
        }

        ?>
      </select>
      <button type="submit" name="button" value="add-employee">submit</button>
    </form>
    
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
