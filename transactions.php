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
    error_reporting(0);
    require "config/config.php";
    require "config/db.php";

    $search = $_GET['search'];

    $result_per_page = 10;

    $query01 = "SELECT * FROM transaction";

    $result01 = mysqli_query($conn, $query01);

    $resultRows = mysqli_num_rows($result01);

    $number_of_page = ceil($resultRows / $result_per_page);

    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }

    $first_page_number = ($page - 1) * $result_per_page;
    
    if(strlen($search) > 0){
        $query = "SELECT 
            b.datelog,
            b.documentcode,
            b.action,
            b.office_id,
            a.name AS 'office',
            concat(c.lastname, ', ' , c.firstname) As 'employee',
            b.remarks
            
        FROM
            office a,
            transaction b,
            employee c
        WHERE
            a.id = b.office_id AND
			c.id = b.employee_id AND
            b.documentcode = $search
			ORDER BY b.documentcode, b.datelog
            
        LIMIT $first_page_number, $result_per_page";
    }else{
        $query = "SELECT 
            b.datelog,
            b.documentcode,
            b.action,
            b.office_id,
            a.name AS 'office',
            concat(c.lastname, ', ' , c.firstname) As 'employee',
            b.remarks
            
        FROM
            office a,
            transaction b,
            employee c
            
        WHERE
            a.id = b.office_id AND
			c.id = b.employee_id
			ORDER BY employee
            
        LIMIT $first_page_number, $result_per_page";
    }

    $result = mysqli_query($conn, $query);

    $transaction = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <div class="card strpied-tabled-with-hover">
                                <br/>
                                <form class="col-md-4" action="transactions.php" method="GET">
                                    <input type="text" name="search" class="form-control" placeholder="Search here"/>
                                    <input type="submit" value="Search" class="btn btn-info btn-fill"/>
                                </form>
                                <div class="col-md-12">
                                    <a href="transactions-add.php">
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Add New Transaction</button>
                                    </a>
                                </div>
                                <div class="card-header">
                                    <h4 class="card-title">Transactions</h4>
                                    <p class="card-category">record</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>DATELOG</th>
                                            <th>DOCUMENT CODE</th>
                                            <th>ACTION</th>
                                            <th>OFFICE</th>
                                            <th>EMPLOYEE</th>
                                            <th>REMARKS</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($transaction as $transactions): ?>
                                                <tr>
                                                    <td><?php echo $transactions['datelog'];?></td>
                                                    <td><?php echo $transactions['documentcode'];?></td>
                                                    <td><?php echo $transactions['action'];?></td>
                                                    <td><?php echo $transactions['office'];?></td>
                                                    <td><?php echo $transactions['employee'];?></td>
                                                    <td><?php echo $transactions['remarks'];?></td>
                                                </tr>
                                            <?php endforeach ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php 
                                for($page=1; $page <= $number_of_page; $page++){
                                    echo "<a href=\"transactions.php?page=$page\"> $page</a>";
                                }
                            ?>
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
