<?php
require './helpers/dbConnection.php';
require './helpers/functions.php';
require './helpers/validator.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $password   =  clean($_POST['password']);
    $email      =  clean($_POST['email']);
    
    
       $errors = [];
    
    
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
    
    
    
    
      if(count($errors) > 0){
          foreach($errors as $key => $val ){
              echo '* '.$key.' :  '.$val.'<br>';
          }
      }else{
          
         // db code .... 
    
         $password = md5($password);
    
         $sql = "select * from users where email = '$email' and password = '$password'";
         $op  =  mysqli_query($con,$sql);
        //  echo mysqli_error($con);
        //  exit;
    
    
          if(mysqli_num_rows($op) == 1){
              // code 
            $data = mysqli_fetch_assoc($op);
    
             $_SESSION['user'] = $data;

             $user_role_id  = $_SESSION['user']['role_id'];

            //  echo $user_role_id;
            //  exit;
            // var_dump($_SESSION['user']['role_id'] == 1);
            // exit;

             if($_SESSION['user']['role_id'] == 1){
    
                header("Location: ".url('admin/index.php'));

            }
            elseif($_SESSION['user']['role_id'] == 2){
                header("Location: ".url('manager/index.php'));

            }
            elseif($_SESSION['user']['role_id'] == 3){
                header("Location: ".url('employee/index.php'));

            }
    
          }else{
              echo 'Error in Your Account Data , Try Again.';
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
    <title>Login</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .headerbg {
            background: url("office-bg.jpg");
            background-size: cover;
            position: relative;
            height: 625px;
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
            <img src="logo.png" style="margin-left: 25%;">
            <div class="container d-flex justify-content-center align-content-center" style="border-radius:50px;">


                <!-- Login Card 2 -->
                <div class="col-md-7 rounded" style="background-color: #edebe8; margin-left: 3%;margin-top: 5%;">

                    <div class="card-body p-5">
                        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>




                                <input type="text" class="form-control"  name="email" placeholder="Enter Your Email">



                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>



                                <input type="password" name="password" class="form-control" placeholder="Enter Your password">
                            </div>




                            <div class="form-group">
                                <input type="submit" value="Login" class="btn login_btn" >
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            Don't have an account?<a href="signup.html">Sign Up</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>