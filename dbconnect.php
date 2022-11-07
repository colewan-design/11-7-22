<?php
// Database Host
$host = 'localhost';
// Database Username
$username = 'root';
// Database Password
$password = '';
// Selected Database Name
$dbName = 'crud';

$conn= new mysqli($host, $username, $password,$dbName);
if(!$conn){
    die("Database Connection Error: ".$conn->error);
}

