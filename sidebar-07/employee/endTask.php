<?php 
    require '../helpers/dbConnection.php';
    require '../helpers/functions.php';
    require '../helpers/checkLogin.php';


    $task_id=$_GET['id'];

    $sql="select * from task where id = $task_id ";
    $op=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($op);


    if($data['startDate'] > 0){

        $time=time();
        $sql="update  task set endDate='$time' where id = $task_id ";
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

    }
    else{
        echo "Start Task First";
        $_SESSION['Message']="Start Task First";
    }
    

   


?>