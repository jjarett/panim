<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM delivery where delivery_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Delivery
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Deliveries</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Orders Found.</p>";
                } else {
                    echo "<br><br><h4>Delivery Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='deliveriesupdate' action='deliveries_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='delivery_id' class='col-sm-1 control-label'>Delivery ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='delivery_id' name='delivery_id' value='" . $row['delivery_id'] . "' readonly></div>";
                        echo "<label for='order_id' class='col-sm-1 control-label'>Order ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='order_id' name='order_id' value='" . $row['order_id'] . "' required ></div>";
                        echo "</div>";
                        

                        echo "<div class='form-group'>";
                        echo "<label for='courier_used' class='col-sm-1 control-label'>Courier Used: </label><div class='col-sm-3'><input type='text' class='form-control' id ='courier_used' name='courier_used' value='" . $row['courier_used'] . "' required></div>";
                        echo "<label for='delivery_fee' class='col-sm-1 control-label'>Delivery Fee: </label><div class='col-sm-3'><input type='text' class='form-control' id ='delivery_fee' name='delivery_fee' value='" . $row['delivery_fee'] . "' required></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='tracking_no' class='col-sm-1 control-label'>Tracking No: </label><div class='col-sm-3'><input type='text' class='form-control' id ='tracking_no' name='tracking_no' value='" . $row['tracking_no'] . "' required></div>";
                        echo "</div>";


                    }
                    echo "</form>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='deliveries.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='deliveriesupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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