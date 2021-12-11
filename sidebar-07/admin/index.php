<?php 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


require '../layouts/header.php';

$sql  =  "select * from task ";
$op   =  mysqli_query($con,$sql);
$data =  mysqli_fetch_assoc($op); // array
// var_dump($data);
// exit;
//$userID =$data['createdBy']; 
// echo $userID;
// exit;

# Fetch user who created the Task
// $sql2       =  "select * from users where id=$userID";
// $op2        =  mysqli_query($con,$sql2);
// $user_data  =  mysqli_fetch_assoc($op2);   /


// while($data=mysqli_fetch_assoc($op)){

//     foreach($data as $key => $value){
//         echo $key.'-->'.$value.',';
//     }
//     echo '<br>';

// }

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
            <h2 class="mb-4">Tasks</h2>
               <div class="container"> 
                <?php
                    while($data=mysqli_fetch_assoc($op)){
                        // echo mysqli_error($con);
                        // exit;
                    //   $deadLine_timeStamp=strtotime($data['deadline']) ;
                    //   echo $deadLine_timeStamp.'--->'; 
                    $deadLine=date('d-m-Y',$data['deadline']);  
                        // echo $deadLine.'<br>';
                        // exit;
                        $userID =$data['createdBy'];
                     # Fetch user who created the Task
                         $sql2       =  "select * from users where id=$userID";
                         $op2        =  mysqli_query($con,$sql2);
                         $user_data  =  mysqli_fetch_assoc($op2);   //array
   

                    
                ?>
                <div class="card m-3 p-3">
                    
                    <!-- <div class="row "> -->
                    
                        <div class="col-md-4 m-2">
                            <img src="../assets/uploads/<?php echo $data['photo']?>" class="w-100 h-50">
                        </div>
                        <div class="col-md-8 px-3">
                           
                            <div class="card-block px-3">
                                <h4 class="card-title"><?php echo $data['title'];?></h4>
                                <h5 class="card-text" style=" text-decoration: underline; text-decoration-color: #FFC312;"><?php echo "Deadline : ".$deadLine;?></h5>
                                <p class="card-text"><?php echo substr($data['content'],0,40).' ...';?>
                                <a href="taskDetails.php?id=<?php echo $data['id']; ?>">Read more</a>
                                </p>
                                <span>Added By <?php echo $user_data['name'];?></span>
                                
                                <br>
                                <!-- <a href="#" class="btn btn-primary mb-3" >Edit</a>
                                <a href="#" class="btn btn-danger mb-3" >Delete</a> -->


                            </div>

                        </div>

                    <!-- </div> -->
                </div>
                <?php   }?>
             </div>

        </div>

<?php

require '../layouts/scripts.php';

?>    



</div>
</body>

</html>