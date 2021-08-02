<!DOCTYPE html>
<html>


<?php

include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if ($_SESSION['role'] == 'ITAdmin') {

                ?>
                
                <div class="row">
                <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">

                                    <p>Total Users</p>

                                    <?php
                                    $queryEmployees = "select count(employee_id) from employees";
                                    $resultEmployees = mysqli_query($con, $queryEmployees);
                                    while ($employeesRow = mysqli_fetch_array($resultEmployees)) {
                                        $employeesCount = $employeesRow["count(employee_id)"];
                                    }

                                    echo "<h3>" . $employeesCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                </div>


                <?php
                }
                ?>

                <?php

                if ($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Employee') {

                ?>

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">

                                    <p>Total Orders</p>

                                    <?php
                                    $queryOrders = "select count(order_id) from orders";
                                    $resultOrders = mysqli_query($con, $queryOrders);
                                    while ($ordersRow = mysqli_fetch_array($resultOrders)) {
                                        $ordersCount = $ordersRow["count(order_id)"];
                                    }

                                    echo "<h3>" . $ordersCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="orders.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">

                                    <p>Number of Products</p>

                                    <?php
                                    $queryProduct = "select count(product_id) from products";
                                    $resultProduct = mysqli_query($con, $queryProduct);
                                    while ($productRow = mysqli_fetch_array($resultProduct)) {
                                        $productCount = $productRow["count(product_id)"];
                                    }

                                    echo "<h3>" . $productCount . "</h3>";
                                    ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-o"></i>
                                </div>
                                <a href="products.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">

                                    <p>Number of Customers</p>

                                    <?php
                                    $queryCust = "select count(customer_id) from customers";
                                    $resultCust = mysqli_query($con, $queryCust);
                                    while ($custRow = mysqli_fetch_array($resultCust)) {
                                        $custCount = $custRow["count(customer_id)"];
                                    }

                                    echo "<h3>" . $custCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="customers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-navy">
                                <div class="inner">

                                    <p>Number of Collections</p>

                                    <?php
                                    $queryCollections = "select count(collection_id) from collections";
                                    $resultCollections = mysqli_query($con, $queryCollections);
                                    while ($collectionRow = mysqli_fetch_array($resultCollections)) {
                                        $collectionCount = $collectionRow["count(collection_id)"];
                                    }

                                    echo "<h3>" . $collectionCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-star"></i>
                                </div>
                                <a href="collections.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">

                                    <p>Number of Categories</p>

                                    <?php
                                    $queryCat = "select count(category_id) from categories";
                                    $resultCat = mysqli_query($con, $queryCat);
                                    while ($catRow = mysqli_fetch_array($resultCat)) {
                                        $catCount = $catRow["count(category_id)"];
                                    }

                                    echo "<h3>" . $catCount . "</h3>";
                                    ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                </div>
                                <a href="category.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">

                                    <p>Number of Deliveries</p>

                                    <?php
                                    $queryDeli = "select count(delivery_id) from delivery";
                                    $resultDeli = mysqli_query($con, $queryDeli);
                                    while ($deliRow = mysqli_fetch_array($resultDeli)) {
                                        $deliCount = $deliRow["count(delivery_id)"];
                                    }

                                    echo "<h3>" . $deliCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <a href="deliveries.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">

                                    <p>Number of Payments</p>

                                    <?php
                                    $queryPayments = "select count(payment_id) from payments";
                                    $resultPayments = mysqli_query($con, $queryPayments);
                                    while ($paymentsRow = mysqli_fetch_array($resultPayments)) {
                                        $paymentsCount = $paymentsRow["count(payment_id)"];
                                    }

                                    echo "<h3>" . $paymentsCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-barcode"></i>
                                </div>
                                <a href="payments.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">

                                    <p>Number of Feedbacks</p>

                                    <?php
                                    $queryFeedbacks = "select count(feedback_id) from feedback";
                                    $resultFeedbacks = mysqli_query($con, $queryFeedbacks);
                                    while ($feedbacksRow = mysqli_fetch_array($resultFeedbacks)) {
                                        $feedbacksCount = $feedbacksRow["count(feedback_id)"];
                                    }

                                    echo "<h3>" . $feedbacksCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-comments-o"></i>
                                </div>
                                <a href="feedbacks.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                <?php

                }

                ?>


            </section>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
</body>

</html>