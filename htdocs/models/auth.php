<?php

class Authenticator
{
  function __construct()
  {
    session_start();
  }

  //Define session vars
  public function newSession($username, $id)
  {
    /*if(!isset($_SESSION["username"])){
      session_start();*/
      session_regenerate_id();
      $_SESSION["username"] = $username;
      $_SESSION["id"] = $id;
      $_SESSION["loggedin"] = True;

      /* would like features */
      require_once("business.php");
      $user_business = new business();
      $_SESSION["business"] = serialize($user_business);

      require_once("user.php");
      $user_inst = new User($id);
      $_SESSION["user-info"] = serialize($user_inst);

      //logging session time to db
      $_SESSION["lastLoggedIn"] = date("Y-m-d H-m-s");

  }

  public function checkSession()
  {
    echo $_SESSION["username"];
    echo ($_SESSION["id"]);
    echo $_SESSION["loggedin"];
  }

  public function terminateSession()
  {
    session_destroy();
    header("location: ../routes/landingpage.php");
  }

  /* SHOULD HAVE FEATURE */
  //fetch sessions for admin page
  private function fetchSessions()
  {

  }
  //fetch specific user session for admin
  private function fetchSession()
  {

  }
}


?>
