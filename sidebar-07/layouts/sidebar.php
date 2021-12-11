<nav id="sidebar" class="active">
            <h1><a href="index.html" class="logo">TM.</a></h1>
            <ul class="list-unstyled components mb-5">

                        <?php 

                                # Admin  = 1   , Manager = 2 , Employee =3 
                                if($_SESSION['user']['role_id'] == 1){

                                    $modules = ["Tasks" =>"http://localhost/TaskManagement/layouts/sidebar-07/admin/index.php",
                                                "Users" =>"http://localhost/TaskManagement/layouts/sidebar-07/admin/users.php",
                                                "Roles" => "http://localhost/TaskManagement/layouts/sidebar-07/admin/roles.php",
                                                "Add Role" => "http://localhost/TaskManagement/layouts/sidebar-07/admin/addRole.php"];

                                }
                                elseif($_SESSION['user']['role_id'] == 2){

                                    $modules = ["Tasks" => "http://localhost/TaskManagement/layouts/sidebar-07/manager/index.php",
                                    "Create Task" => "http://localhost/TaskManagement/layouts/sidebar-07/manager/createTask.php",
                                    "Submitted Tasks" => "http://localhost/TaskManagement/layouts/sidebar-07/manager/submittedTasks.php"];
                                }
                                
                                elseif($_SESSION['user']['role_id'] == 3){

                                    $modules = ["Tasks" => "http://localhost/TaskManagement/layouts/sidebar-07/employee/index.php",
                                                "In Progress" => "http://localhost/TaskManagement/layouts/sidebar-07/employee/inprogress.php",
                                      "Submitted Tasks" => "http://localhost/TaskManagement/layouts/sidebar-07/employee/submittedTask.php"];
                                    
                               }


                                foreach ($modules as $key => $value) {
                                    
                            
                        ?>  

                              <h5><a href="<?php echo $value?>" style="color: white;margin-left:5 px;"><?php echo $key?></a> </h5>
                                    <br>
                           <?php } ?>         

                <!-- <li>
                    <a href="#"><span class="fa fa-user"></span> Profile </a>
                </li>

                <li>
                    <a href="submittedTasks.html"><span class="fa fa-sticky-note"></span> Submitted Tasks</a>
                </li> -->
            </ul>

            <div class="footer">
                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="icon-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                </p>
            </div>
        </nav>
