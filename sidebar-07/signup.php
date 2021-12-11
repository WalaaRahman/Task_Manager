<?php
require './helpers/dbConnection.php';
require './helpers/functions.php';
require './helpers/validator.php';


#Fetch Roles from DB
$sql="select * from roles";
$role_op=mysqli_query($con,$sql);

#Fetch Departments from DB
$sql1="select * from department";
$dep_op=mysqli_query($con,$sql1);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username   =  clean($_POST['username']);
    $email      =  clean($_POST['email']);
    $password   =  clean($_POST['password']);

    $role_id    =  $_POST['roleID'];
    $dep_id     =  $_POST['depID'];
    
    
       $errors = [];
    
     # Username Validation ... 
     if(!validate($username,'empty')){
        $errors['Username'] = "Field Required";
    }

      # Password Validation ... 
      if(!validate($password,'empty')){
          $errors['Password'] = "Field Required";
      }elseif(!validate($password,'size') ){
          $errors['Password'] = "Password Length Must >= 6 ch";
      }
    
        # Email Validation ... 
        if(!validate($email,'empty')){
          $errors['Email'] = "Field Required";
      }elseif(!validate($email,'email')){
          $errors['Email'] = "Invalid Email";
      }

      #Role ID 
      if(!validate($role_id,'empty')){
        $errors['roleID'] = "Field Required";
    }elseif(!validate($role_id,'int')){
        $errors['roleID'] = "Invalid Role";

    }
      

      #Department ID Validation
      if(!validate($dep_id,'empty')){
        $errors['roleID'] = "Field Required";
    }elseif(!validate($dep_id,'int')){
        $errors['roleID'] = "Invalid Role";

    }

    
    
    
      if(count($errors) > 0){
          foreach($errors as $key => $val ){
              echo '* '.$key.' :  '.$val.'<br>';
          }
      }else{
          
         // db code .... 
    
          $password = md5($password);
    
         $sql = "insert into  users (name,email,password,role_id,Dep_ID) values ('$username','$email','$password',$role_id,$dep_id)";
         $op  =  mysqli_query($con,$sql);
        //  echo mysqli_error($con);
        //  exit();
    
            if($op){
            //     if($role_id == 1){
    
            //         header("Location: ".url('admin/index.php'));
    
            //     }
            //     elseif($role_id == 2){
            //         header("Location: ".url('manager/index.php'));
    
            //     }
            //     elseif($role_id == 3){
            //         header("Location: ".url('employee/index.php'));
    
            //     }
              header("Location: ".url('login.php'));

             }
    
          else{
              echo 'Error Inserting  Data , Try Again.';
          }
    
    
         # close connection ... 
         mysqli_close($con);
    
         }
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .headerbg {
            background: url("office-bg.jpg");
            background-size: cover;
            position: relative;
            height: 925px;
        }
        
        .headerbg .overlay {
            position: absolute !important;
            width: 100%;
            height: 100%;
            background-color: rgb(64 63 60 / 50%);
        }
    </style>
</head>

<body>
    <div class="headerbg">
        <div class="overlay">


            <!-- Login Card 2 -->
            <img src="logo.png" style="margin-left: 25%;">

            <div class="container d-flex justify-content-center align-content-center" style="border-radius:50px;">
                <div class="card m-5 shadow " style="background-color: #edebe8;width:840px;height: 700px;">
                    <div class="row no-gutters">
                        <div class="col-md-10">
                            <div class="card-body p-5">
                                <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">

                                    <div class="form-group">

                                        <label for="exampleInputEmail1">User Name</label>
                                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sign Up as</label>
                                <select name="roleID" class="form-control">
                                    <?php 
                                        while($data = mysqli_fetch_assoc($role_op)){ 
                                    ?>

                                    <option  value="<?php echo $data['id'];?>"> <?php echo $data['role']; ?> </option>

                                    <?php } ?>
                                </select>
                            </div>

                            <!-- <h6>Department </h6> -->

                            <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                <select name="depID" class="form-control">
                                    <?php 
                                        while($data = mysqli_fetch_assoc($dep_op)){ 
                                    ?>

                                    <option value="<?php echo $data['id'];?>"> <?php echo $data['title']; ?> </option>

                                    <?php } ?>
                                </select>
                        </div>

                                    <br>
                                    <button type="submit" class="btn" style="background-color:#FFC312;color: black;">Save</button>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-md-5 ml-4 p-5">

                            <!-- <h6 class="mt-4 ml">Sign Up as</h6> -->

                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Sign Up as</label>
                                <select name="roleID" class="form-control">
                                    <?php 
                                        while($data = mysqli_fetch_assoc($role_op)){ 
                                    ?>

                                    <option  value="<?php echo $data['id'];?>"> <?php echo $data['role']; ?> </option>

                                    <?php } ?>
                                </select>
                            </div> -->

                            <!-- <h6>Department </h6> -->

                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                <select name="depID" class="form-control">
                                    <?php 
                                        while($data = mysqli_fetch_assoc($dep_op)){ 
                                    ?>

                                    <option value="<?php echo $data['id'];?>"> <?php echo $data['title']; ?> </option>

                                    <?php } ?>
                                </select>
                        </div>  -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>

</html>