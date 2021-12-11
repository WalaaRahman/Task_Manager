<?php 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

require '../layouts/header.php';
$task_id=$_GET['id'];

$sql  =  "select * from task where id=$task_id  ";
$op   =  mysqli_query($con,$sql);
$data=mysqli_fetch_assoc($op);

// while($data=mysqli_fetch_assoc($op)){

//     foreach($data as $key => $value){
//         echo $key.'-->'.$value.',';
//     }
//     echo '<br>';

// }
// exit;



// while($data=mysqli_fetch_assoc($op)){
    // echo mysqli_error($con);
    // exit;
//   $deadLine_timeStamp=strtotime($data['deadline']) ;
//   echo $deadLine_timeStamp.'--->'; 
$deadLine=date('d-m-Y',$data['deadline']);  
    // echo $deadLine.'<br>';
    // exit;




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
            <h2 class="mb-4"><?php echo $data['title'];?></h2>
               <div class="container"> 
              
                <div class="card m-3 p-3">
                    
                    <!-- <div class="row "> -->
                    
                        <div class="col-md-4 m-2">
                            <img src="../assets/uploads/<?php echo $data['photo']?>" class="w-100 h-50">
                        </div>
                        <div class="col-md-8 px-3">
                           
                            <div class="card-block px-3">
                                <h4 class="card-title"><?php echo $data['title'];?></h4>
                                <h5 class="card-text" style=" text-decoration: underline; text-decoration-color: #FFC312;"><?php echo "Deadline : ".$deadLine;?></h5>
                                <p class="card-text"><?php echo $data['content'];?>
                                
                                </p>
                                
                                <br>
                                <a href="startTask.php?id=<?php echo $task_id ?>" class="btn btn-warning mb-3" >Start</a>
                                <a href="endTask.php?id=<?php echo $task_id ?>" class="btn btn-danger mb-3" >END</a>


                            </div>

                        </div>

                    <!-- </div> -->
                </div>
               
             </div>

        </div>

<?php

require '../layouts/scripts.php';

?>    



</div>
</body>

</html>