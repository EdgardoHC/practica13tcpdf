<?php

$servername = "localhost";
//echo $servername;
$username = "root";
$password = "VTEChc4.4i";
$dbname = "Northwind";
// Create connection Object oriented style
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");// estrictamente para no tener problemas con las tildes y ñ
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
date_default_timezone_set('America/El_Salvador');