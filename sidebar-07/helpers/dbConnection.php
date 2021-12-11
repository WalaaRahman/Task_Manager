<?php

session_start();

$server="localhost";
$dbName="taskmanagement_2";
$userName="root";
$password="";

$con=mysqli_connect($server,$userName,$password,$dbName);

if (!$con){
    echo "Error : ".mysqli_error($con);
}

?>