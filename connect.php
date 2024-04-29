<?php 
session_start();
define('SERVERNAME', 'localhost');
define('USERNAME', 'username');
define('PASSWORD', '');
define('DATABASE', 'blogger');

$connect= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
if(!$connect){
    die("connection cannot be made".mysqli_connect_error());
}

?>