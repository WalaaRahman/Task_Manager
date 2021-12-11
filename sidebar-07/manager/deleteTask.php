<?php 
    require '../helpers/dbConnection.php';
    require '../helpers/functions.php';
require '../helpers/checkLogin.php';


    $task_id=$_GET['id'];

    $sql="delete from task where id=$task_id";
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