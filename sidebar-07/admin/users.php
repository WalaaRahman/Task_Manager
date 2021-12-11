<?php 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

require '../layouts/header.php';

$sql="SELECT users.* , roles.role from users INNER JOIN roles on users.role_id = roles.id ";
// $sql  =  "select * from users where role_id != 1  ";
$op   =  mysqli_query($con,$sql);
$data =  mysqli_fetch_assoc($op); // array
// var_dump($data);
///$userID =$data['createdBy']; 
// echo $userID;
// exit;

# Fetch user who created the Task
// $sql2       =  "select * from users where id=$userID";
// $op2        =  mysqli_query($con,$sql2);
// $user_data  =  mysqli_fetch_assoc($op2);   /


// while($data=mysqli_fetch_assoc($op)){

//     foreach($data as $key => $value){
//         echo $key.'-->'.$value.'<br>';
//     }

//     echo '<br>';
    

//  }
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
           

    <!-- Body -->

                <div>

                    
    
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <!-- <th scope="col">Action</th> -->
                                <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
    
                    
                            <tbody>
                            <?php
                    
                    while($data=mysqli_fetch_assoc($op)){


                    
                    ?>
                                <tr>
                                <th ><?php echo $data['id'];?></th>
                                <td><?php echo $data['name'];?></td>
                                <td><?php echo $data['email'];?></td>
                                <td><?php echo $data['role'];?></td>
                                <!-- <td>
                                    <a href='deleteUser.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                    <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>

                                </td> -->
                                </tr>
                            </tbody>
                            <?php }?> 
                        </table>
                        </div>

                    

                   
                
                
                

               


<?php

require '../layouts/scripts.php';

?>    

      


</div>
</body>

</html>