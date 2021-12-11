<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

require '../helpers/validator.php';

require '../layouts/header.php';

# Fetch Task Old Data....

$task_id=$_GET['id'];

# validate id 
if(!validate($task_id,'int')){
    echo "Invalid ID";
    header("Location: index.php");
}

# Query to Fetch Previous Task Data

$sql="select * from task where id=$task_id ";
$task_op=mysqli_query($con,$sql);
$prevData=mysqli_fetch_assoc($task_op);

# Fetch User Data (Employees) ... 
$sql="select * from users where role_id=3";
$emp_op=mysqli_query($con,$sql);


// var_dump($op);
// while($data=mysqli_fetch_assoc($op)){
//     foreach($data as $key => $value){
//         echo $key.'-->'.$value.'<br>';
//     }

// }
// exit();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $title       =  clean($_POST['title']);
    $content     =  clean($_POST['content']);
    $deadLine    =  $_POST['deadline'];
    $assignedTo  =  $_POST['emp_id'];


    # Image Details ..... 
    $ImageTmp   =  $_FILES['image']['tmp_name'];
    $ImageName  =  $_FILES['image']['name'];
    $ImageSize  =  $_FILES['image']['size'];
    $ImageType  =  $_FILES['image']['type']; 

    $TypeArray = explode('/',$ImageType);


    $errors=[];

    // #Title
    if(!validate($title,'empty')){
       $errors['title'] = " Title Field Required";
     }
   
  

    # Content
     if(!validate($content,'empty')){
       $errors['Content'] = " Content Field Required";
    }elseif(!validate($content,'size',20)){
       $errors['Content'] = " Content Length must be >= 20 ch ";

    }

    # date validation 
    if(!validate($deadLine,'empty')){
       $errors['Date'] = " Date Field Required";
    }
   
   
    # cat Validation ... 
    if(!validate($assignedTo,'empty')){
    $errors['AssignedTo'] = "Assigned To Field Required";
    }elseif(!validate($assignedTo,'int')){
    $errors['AssignedTo'] = "Invalid Assigned To";
    }

    # Image Validation 

    if(!validate($ImageName,'empty')){
        $errors['image'] = "Image Field Required";
        }elseif(!validate($TypeArray[1],'extension')){
        $errors['image'] = "Invalid Extension";
        }

    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;

       print_r($errors);

    }else{
        if(validate($ImageName,'empty')){

            $ImageName = rand(1,100).time().'.'.$TypeArray[1];
 
             $desPath = '../assets/uploads/'.$ImageName;

             if(move_uploaded_file($ImageTmp,$desPath)){
                  unlink('../assets/uploads/'.$_POST['prevPhoto']);
                
                }
                else{
                    $ImageName=$_POST['prevPhoto'];
                }

        }
        
    
               
                  
                    // code .... 
                    $deadLine = strtotime($deadLine);
                    $time=time();
                    $sql = "update task set title='$title', content='$content' , deadline='$deadLine' , assignedTo=$assignedTo , photo='$ImageName' , createdBy=4 , createDate='$time' where id = $task_id";
                    $op  = mysqli_query($con,$sql);

                        // echo mysqli_error($con);
                        // exit();

        
                    if($op){
                        $_SESSION['Message'] = ["Data Inserted"];
                        header("Location: index.php");
                        exit();
                    }else{
                    $_SESSION['Message'] = ['Error Inserting Data Try Again'];
                    }

              
    }



}






?>

<div class="wrapper d-flex align-items-stretch">
        
<?php

require '../layouts/sidebar.php';

?>

        <div id="content" class="p-4 p-md-5">

<?php

require '../layouts/navbar.php';

?>           


                
            <!-- Page Content  -->
            
            <div class="container">
                    <form action="editTask.php?id=<?php echo $prevData['id']; ?>" method="post"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Title"
                                value="<?php echo $prevData['title'];?>">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <input type="text" name="content" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Content"
                                value="<?php echo $prevData['content'];?>">
                        </div>

                      

                        <div class="form-group">
                            <label for="exampleInputEmail1">Deadline</label>
                            <input type="date" name="deadline" class="form-control" id="exampleInputName"
                            value="<?php echo date('Y-m-d',$prevData['deadline']);?>">
                        </div>

                       
                        

                        <div class="form-group">
                            <label for="exampleInputPassword1">Assign To</label>
                            <select name="emp_id" class="form-control">
                                <?php 
                                    while($data = mysqli_fetch_assoc($emp_op)){ 
                                ?>

                                <option value="<?php echo $data['id'];?>" <?php if($data['id'] === $prevData['assignedTo']){echo "selected";}?>> <?php echo $data['name']; ?> </option>

                                <?php } ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input type="file" name="image">
                            <br>
                            <img src="../assets/uploads/<?php echo $prevData['photo'];?>" width="100 px">

                        </div>
                        <input type="hidden" value="<?php echo $prevData['photo'];?>" name="prevPhoto">



                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>




        </div>

<?php

require '../layouts/scripts.php';

?>    



</div>
</body>

</html>