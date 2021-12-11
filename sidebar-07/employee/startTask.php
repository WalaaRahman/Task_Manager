<?php 
    require '../helpers/dbConnection.php';
    require '../helpers/functions.php';
require '../helpers/checkLogin.php';


    $task_id=$_GET['id'];

    $time=time();
    $sql="update  task set startDate='$time' where id = $task_id ";
    $op=mysqli_query($con,$sql);
    // echo mysqli_error($con);
    // exit;
    if($op){
        header("Location: index.php");
    }
    else{
        echo "Error Starting Task...";
        $_SESSION['Message']="Error Starting Task...";
        
    }


?>