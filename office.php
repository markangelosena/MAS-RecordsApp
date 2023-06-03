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

    //pagination
    $result_per_page = 10;
    
    $query01 = 'SELECT * FROM office';
    
    $resultRows = mysqli_query($conn, $query01);
    
    $number_of_results = mysqli_num_rows($resultRows);  
    
    $number_of_page = ceil($number_of_results / $result_per_page);
    
    if(!isset($_GET['page'])){
        $page=1;
    }else{
        $page = $_GET['page'];
    }

    $page_first_result = ($page-1) * $result_per_page;

    //for the gui display datas'
    $query = "SELECT id, name, contactnum, email, address, city, country, postal FROM office ORDER BY name LIMIT $page_first_result, $result_per_page" ;

    $result = mysqli_query($conn, $query);

    $office = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
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
                            <div class="card strpied-tabled-with-hover">
                                <br/>
                                <div class="col-md-12">
                                    <a href="office-add.php">
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Add New Office</button>
                                    </a>
                                </div>

                                <div class="card-header">
                                    <h4 class="card-title">Offices</h4>
                                    <p class="card-category">records</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>NAME</th>
                                            <th>CONTACT NUMBER</th>
                                            <th>EMAIL</th>
                                            <th>ADDRESS</th>
                                            <th>CITY</th>
                                            <th>COUNTRY</th>
                                            <th>POSTAL</th>
                                            <th>ACTION</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($office as $offices): ?>
                                                <tr>
                                                    <td><?php echo $offices['name'];?></td>
                                                    <td><?php echo $offices['contactnum'];?></td>
                                                    <td><?php echo $offices['email'];?></td>
                                                    <td><?php echo $offices['address'];?></td>
                                                    <td><?php echo $offices['city'];?></td>
                                                    <td><?php echo $offices['country'];?></td>
                                                    <td><?php echo $offices['postal'];?></td>
                                                    <td>
                                                        <a href="office-edit.php?office_id=<?php echo $offices['id']?>">
                                                            <button type="submit" class="btn btn-warning btn-fill pull-right">EDIT</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        for($page=1; $page <= $number_of_page; $page++){
                            echo "<a href=\"office.php?page=$page\"'> $page</a>";
                        }
                    ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">

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
