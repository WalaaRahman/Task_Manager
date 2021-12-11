
<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn" style="background-color:#FFC312;">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h4 style="margin-left:5%; color: rgb(56, 52, 52);">Task Management</h4>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <h4 style="display:inline;"><?php echo $_SESSION['user']['name']; ?></h4>
                                <a class="nav-link" href="../logout.php">Logout</a>
                            </li>

                            
                        </ul>
                    </div>
                </div>
</nav>