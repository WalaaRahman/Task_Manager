<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

require '../helpers/validator.php';

require '../layouts/header.php';




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

    #Title
    if(!validate($role,'empty')){
       $errors['role'] ="* Role Field Required";
     }
  

   

    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;

       print_r($errors);

    }else{
        
                  
                    // code .... 
                   
                    $sql = "insert into roles (role) values ('$role')";
                    $op  = mysqli_query($con,$sql);

                        // var_dump($op);
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" name="role" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Role">
                        </div>

                        

                       

                        


                        <button type="submit" class="btn " style="background-color:#FFC312;">Add</button>
                    </form>
                </div>




        </div>

<?php

require '../layouts/scripts.php';

?>    



</div>
</body>

</html>