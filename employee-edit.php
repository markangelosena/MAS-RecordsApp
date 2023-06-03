<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Records App</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
</head>
    <?php
        require "config/config.php";
        require "config/db.php";

        //for editing datas'
        $id = $_GET['id'];
        
        $query_Id = "SELECT * FROM employee WHERE id=$id";

        $result_Id = mysqli_query($conn, $query_Id);

        if(count(array($result_Id))==1){
            $employee = mysqli_fetch_array($result_Id);
            $firstname  = $employee['firstname'];
            $lastname = $employee['lastname'];
            $office_id = $employee['office_id'];
            $address = $employee['address'];
        }

        mysqli_free_result($result_Id);

        $query = "SELECT 
                    id,name 
                From 
                    office";
        $employee = mysqli_query($conn, $query);

        if(isset($_POST['submit'])){
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $office_id = mysqli_real_escape_string($conn, $_POST['office']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);

            $query_update = "UPDATE employee SET lastname = '$lastname', firstname = '$firstname', office_id = $office_id, address = '$address' WHERE id = $id";

            if(mysqli_query($conn, $query_update)){
            }else{
                echo "ERROR: " . mysqli_error($conn); 
                echo $query;
            }

            mysqli_close($conn);   
        }
    ?>
<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php')?>
            </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <?php include('includes/navbar.php'); ?>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action=<?php $_SERVER['PHP_SELF']?>>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $lastname; ?>" name="lastname">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $firstname; ?>" name="firstname">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">Office</label>
                                                    <select class="form-control" name="office">
                                                        <option>Select</option>
                                                        <?php while($employee_ = mysqli_fetch_assoc($employee)):?>
                                                            <?php if($employee_['id'] == $office_id):?>
                                                                <option value="<?php echo $employee_['id']; ?>" selected>
                                                                    <?php echo $employee_['name']; ?>
                                                                </option>  
                                                            <?php else:?>
                                                                <option value="<?php echo $employee_['id']; ?>">
                                                                    <?php echo $employee_['name']; ?>
                                                                </option>
                                                            <?php endif?>
                                                        <?php endwhile;?>
                                                    </select>
                                                </div>        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" value="<?php echo $address ?>" name="address">
                                                    </div>
                                                </div>
                                            </div>
                                        <button type="submit" value="submit" class="btn btn-info btn-fill pull-right" name="submit">Save</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
</html>
