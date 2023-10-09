<?php
/**
 *
 */
class usercontroller
{
  /*function __construct()
  {
    session_start();
    require_once("../models/user.php");
    $user = new User($_SESSION["username"]);

  }*/
  function getProfile($id)
  {
    require_once("dbHandling.php");
    $db_instance = new DatabaseHandler();

  }
  function getPosts()
  {

  }

  function getCompany()
  {

  }
}


 ?>
