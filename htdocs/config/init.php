<?php
/* Inititlise DB, server, cookies, and auth */

/* DATABASE */

//test db connection
try{
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($mysqli->connect_error){
    throw new Exception($mysqli->connect_error, 1);
  }
}
//catch error, restore database from backup
catch (Exception $error){
  if(str_contains($error->getMessage(),"Unknown database")){
    $restore = new mysqli(DB_HOST, DB_USER, DB_PASS);
    $restore->multi_query(file_get_contents(__DIR__ . "\Agora_Schema.sql"));

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  } else {
    exit($error->getMessage());
  }
}

//check if default business exists
//if not then set it and the default roles
$bus_res = $mysqli->query("SELECT * FROM business WHERE BusinessID = 0;");
$res = $bus_res->fetch_assoc();
if (!$res["BusinessName"]){
 $default_query =
 "
INSERT INTO business (BusinessID, BusinessName, BusinessDescription, CompanyLogo)
VALUES(0, 'DefaultCompany', 'You have are not registered with a company. please connect with one, or create one', NULL);
"
.
"
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (0, 1, 1, 1, 'ADMIN', 'Admin');
"
.
"
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (0, 0, 0, 1, 'BUYER', 'Buyer');
"
.
"
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (0, 1, 1, 1, 'SELLER', 'Seller');
";

if ($mysqli->multi_query($default_query) === TRUE){
  echo "Database restored Successfully";
} else {
  echo "Error" . $default_query . "<br>" . $mysqli->error;
}
}



/* SERVER */
session_start();
/* Cookies */

/* Auth */

/* queries */
//create default company
/*
INSERT INTO business (BusinessID, Businessname, BusinessDescription, CompanyLogo)
VALUES(0, "DefaultCompany", "You have are not registered with a company. please connect with one, or create one", NULL);
*/

//create new company
/*
INSERT INTO business (BusinessID, Businessname, BusinessDescription, CompanyLogo)
VALUES(randint(1,999), $_POST["companyName"], $_POST["companyDescription"], NULL);
*/
//put default buyer seller and admin into new compnay
/*
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (5, 1, 1, 1, "ADMIN", "Admin");
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (5, 0, 0, 1, "BUYER", "Buyer");
INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
VALUES (5, 1, 1, 1, "SELLER", "Seller");
*/
//apply permissions to users
/*
INSERT INTO userpermission (RoleID, UserID, UserPermID)
VALUES($_POST['RoleID'], $_SESSION['UserID'], $_SESSION['UserID']. $_post['RoleID']);
*/
//update company
/*
UPDATE business
SET BusinessName = $_POST['businessname'], BusinessDescription = $_POST['BusinessDescription'], CompanyLogo = $_POST['companyLogo']
WHERE BusinessID = $_SESSION['BusinessID'];
*/
// get all employees
/*
SELECT useraccount.UserName, rolepermission.RoleName, rolepermission.CanView, rolepermission.CanUpdate, rolepermission.CanDelete
FROM business
INNER JOIN useraccount ON useraccount.BusinessID = business.businessID
INNER JOIN rolepermission ON rolepermission.BusinessID = business.businessID
INNER JOIN userpermission ON userpermission.RoleID = rolepermission.RoleID
WHERE useraccount.BusinessID = $_SESSION['BusinessID']
ORDER BY rolepermission.RoleName ASC;
*/
//create permissions


//update Post
/*
UPDATE Post
SET PostTitle = $_POST['PostTitle'], _Description = $_POST['PostDescription']
WHERE PostID = $_POST['PostID'];
*/
//delete post
/*
DELETE FROM Post WHERE PostID = $_POST['PostID'] AND UserName = $_SESSION['username'];
*/


?>
