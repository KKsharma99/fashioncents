<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
session_start();

var_dump($_SESSION);
var_dump($_COOKIE['fashioncents']);
?>