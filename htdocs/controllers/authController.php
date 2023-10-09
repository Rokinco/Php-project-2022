<?php

class AuthController
{
  //validate user in database, create session, redirect home
  function handleLogin($username, $password)
  {
    require_once("dbHandling.php");
    $db_instance = new DatabaseHandler();
    if($db_instance->CheckHash($username, $password))
    {
      $id = $db_instance->getUserID($username);

      require_once("../models/auth.php");
      $auth_instance = new Authenticator();
      $auth_instance->newSession($username, $id);
      $auth_instance->checkSession();


      header("location: ../routes/home.php");
    } else {
      require_once("../loginView.php");
    }
  }

  //destroy session and redirect landingpage
  function handleLogout()
  {
    require_once("../models/auth.php");
    $auth_instance = new Authenticator();
    $auth_instance->terminateSession();
  }
}


 ?>
