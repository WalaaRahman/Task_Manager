<?php 
    require '../helpers/dbConnection.php';
    require '../helpers/functions.php';
require '../helpers/checkLogin.php';


    $role_id=$_GET['id'];

    $sql="delete  from roles where id=$role_id";
    $op=mysqli_query($con,$sql);
    // echo mysqli_error($con);
    // exit;
    if($op){
        header("Location: index.php");
    }
    else{
        echo "Error Deleting Task...";
    }


?>