<?php
/**
 *
 * PHP verision 8.0.1^
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @author  Rohan Kinraid
 * @since   12/11/2022
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 *
*/

/* INIT CONFIG */
require('./config/config.php');
require('./config/init.php');

/* server */

 if(!empty($_SERVER['HTTPS']) && ("on" == $_SERVER["HTTPS"])){
   $uri = "https://";
 } else {
   $uri = "http://";
 }
 $uri .= $_SERVER["HTTP_HOST"];
 //header("location : ".$uri."/home/");
 //exit;

/* Redirect index */
 if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_SESSION["loggedin"])){
 header("location: routes/landingpage.php");
} else {
  header("location: routes/home.php");
}


 if($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/signup"){
   header("location: routes/signup.php");
 }

 if($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/login"){
   header("location: routes/login.php");
 }

 if($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/home"){
   header("location: routes/signup.php");
 }
?>
