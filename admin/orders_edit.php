<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];
$custid = $_GET['custid'];

$query = "SELECT * FROM orders where order_id = '$id'";
$result = mysqli_query($con, $query);
$queryCustomer = "SELECT * FROM customers where customer_id = $custid";
$resultCustomer = mysqli_query($con, $queryCustomer);



?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Orders
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Orders</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Orders Found.</p>";
                } else {
                    echo "<br><br><h4>Order Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='ordersupdate' action='orders_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='order_id' class='col-sm-1 control-label'>Order ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='order_id' name='order_id' value='" . $row['order_id'] . "' readonly></div>";
                        foreach ($resultCustomer as $customers) {
                        echo "<label for='customer_name' class='col-sm-2 control-label'>Customer Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='customer_name' name='customer_name' value='" . $customers['first_name'] . "' readonly ></div>";
                        }
                        echo "</div>";

                        echo "<div class='form-group'>";
                        // foreach ($resultProduct as $products) {
                        //     echo "<label for='product_name' class='col-sm-1 control-label'>Product Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='product_name' name='product_name' value='" . $products['product_name'] . "' readonly></div>";
                        // }
                        echo "<label for='price' class='col-sm-1 control-label'>Price: </label><div class='col-sm-3'><input type='text' class='form-control' id ='price' name='price' value='" . $row['price'] . "' readonly></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        // echo "<label for='quantity' class='col-sm-1 control-label'>Quantity: </label><div class='col-sm-3'><input type='text' class='form-control' id ='quantity' name='quantity' value='" . $row['quantity'] . "'readonly></div>";
                        echo "<label for='order_status' class='col-sm-1 control-label'>Order Status: </label><div class='col-sm-3'><input type='text' class='form-control' id ='order_status' name='order_status' value='" . $row['order_status'] . "' required></div>";
                        echo "</div>";


                    }
                    echo "</form>";
                    echo "<br>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='orders.php'><button type='button' class='btn btn-default btn-flat pull-left' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-6'><button type='submit' form='ordersupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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