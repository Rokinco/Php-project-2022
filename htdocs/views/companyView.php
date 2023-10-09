<?php

if (!isset($bus_instance->businessName)){
  include("components/companyDefault.php");
}
else {
  include("components/setCompany.php");
}

?>
