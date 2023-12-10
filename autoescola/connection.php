<?php
$dbname = "autoescola";
$host = "localhost";
$username = "root";
$password = "";

try{
    $PDO = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);
}
catch(Exception $er)
{
    echo $er;
}