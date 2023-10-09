<?php
/* SITE DIRECTORIES */
define('SITE_NAME', "Agora");
define("APP_ROOT", dirname(dirname(__FILE__)));
define("URL_ROOT", "/");
define("URL_SUBFOLER","");


/* DATABASE CONFIG */
define("DB_HOST","localhost");
define("DB_USER", "root");
define("DB_PASS","");
define("DB_NAME","agora_schema");

/* SERVER CONFIG */
define("DOMAIN", $_SERVER["SERVER_ADDR"]);
define("PORT", ($_SERVER["SERVER_PORT"] = 80));
define("GATEWAY", $_SERVER["GATEWAY_INTERFACE"]);
define("NAME", ($_SERVER["SERVER_NAME"] = "Agora"));
define("SOFTWARE", $_SERVER["SERVER_SOFTWARE"]);
define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]);
define("ADMIN", ($_SERVER["SERVER_ADMIN"] = "simon-lau@localhost"));


 ?>
