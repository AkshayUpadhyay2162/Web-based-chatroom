<?php
$servername = "localhost";
$hostname = "root";
$password = "";
$dbname = "ichat";


$conn = mysqli_connect($servername,$hostname,$password,$dbname);
if(!$conn){
    die("Connection failed".mysqli_connect_error());
}

?>