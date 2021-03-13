<?php

ob_start();

 session_start(); 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "tidywork";

foreach($db as $key => $value){
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);

$query = "SET NAMES utf8";


?>