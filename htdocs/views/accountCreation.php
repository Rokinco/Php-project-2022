<?php

/**
 *
 */
class SignUp
{
  /* Fields */
  protected static $_HANDLER;

  /* Methods */
  function __construct(){
    //call handler
    /*include_once(__DIR__"../controllers/formHandling.php");
    async self::_HANDLER = FormHandler::accountCreation();
    await (self::_HANDLER::_COMPLETED === TRUE);*/
    //
    $this->usernameAlreadyExists();
    $this->invalidUsername();
    $this->emailAlreadyExists();
    $this->InvalidEmailSyntax();
    $this->invalidPassword();
  }
  public function usernameAlreadyExists(){

  }
  public function invalidUsername(){

  }

  public function emailAlreadyExists(){

  }

  public function InvalidEmailSyntax(){

  }

  public function invalidPassword(){

  }

  private function validRedirect(){
    //remember to do auth first and automatically log user in
    header("location: ../routes/home.php");
  }

  private function invalidRedirect(){
    header("location: ../routes/signup.php");
  }

}

/* script */
include "../controllers/formHandling.php";
// must include username, firstname, lastname, email, and password.
$instance = new FormHandler();
$instance->accountCreation();


 ?>
