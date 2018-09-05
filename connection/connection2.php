<?php
define('DB_SERVER', "localhost");
define('DB_USER', "id5177535_admin");
define('DB_PASSWORD', "ad12345");
define('DB_DATABASE', "id5177535_cakehouse");
define('DB_DRIVER', "mysql");

$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

date_default_timezone_set("Asia/Taipei");


 ?>
