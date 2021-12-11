<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/validator.php';

require '../layouts/header.php';

# Fetch Task Old Data....

$role_id=$_GET['id'];

# validate id 
if(!validate($role_id,'int')){
    echo "Invalid ID";
    header("Location: index.php");
}

# Query to Fetch Previous Task Data

$sql="select * from roles where id=$role_id ";
$role_op=mysqli_query($con,$sql);
$prevData=mysqli_fetch_assoc($role_op);




// var_dump($op);
// while($data=mysqli_fetch_assoc($op)){
//     foreach($data as $key => $value){
//         echo $key.'-->'.$value.'<br>';
//     }

// }
// exit();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $role       =  clean($_POST['role']);
   


    $errors=[];

    // #Title
    if(!validate($role,'empty')){
       $errors['role'] = " Title Field Required";
     }
   
  

    

    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;

       print_r($errors);

    }else{
    

        
        
    
               
                  
                    // code .... 
                   
                    $sql = "update roles set role='$role' where id = $role_id";
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
                    <form action="editRole.php?id=<?php echo $prevData['id']; ?>" method="post"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" name="role" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Title"
                                value="<?php echo $prevData['role'];?>">
                        </div>


                        
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