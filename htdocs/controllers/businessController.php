<?php
session_start();
require_once("../models/business.php");


/**
 *
 */
class BusinessController
{

  function handleRemove()
  {
    // code...
  }

}

$inst = new Business();

$controller = new BusinessController();

if (isset($_GET["removeEmployee"])){
  $controller->handleRemove();

}

?>
