<?php
require_once("../controllers/dbHandling.php");
$db_instance = new DatabaseHandler();
//profile Details
$id = $_SESSION['id'];
$profile_stmt = "SELECT * FROM useraccount WHERE UserID = '{$id}';";
$profile_res = $db_instance->indirectQuery($profile_stmt);

//company Details
$company_stmt = "SELECT *, business.BusinessDescription FROM business
inner join useraccount on useraccount.BusinessID = business.BusinessID
WHERE useraccount.UserID = '{$id}';";
$company_res = $db_instance->indirectQuery($company_stmt);
//my posts
$user_posts = "SELECT * FROM ";
/*
foreach ($profile_res as $value){
  echo $value["UserName"];
}
foreach ($company_res as $obj){
  echo $obj["BusinessName"];
}*/

?>
