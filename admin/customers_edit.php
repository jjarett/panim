<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM customers where customer_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Customers
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Customers</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Orders Found.</p>";
                } else {
                    echo "<br><br><h4>Order Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='customersupdate' action='customers_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='customer_id' class='col-sm-1 control-label'>Customer ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='customer_id' name='customer_id' value='" . $row['customer_id'] . "' readonly></div>";
                        echo "</div>";
                        

                        echo "<div class='form-group'>";
                        echo "<label for='customer_fname' class='col-sm-1 control-label'>Customer First Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='customer_fname' name='customer_fname' value='" . $row['first_name'] . "' required ></div>";
                        echo "<label for='customer_lname' class='col-sm-1 control-label'>Customer Last Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='customer_lname' name='customer_lname' value='" . $row['last_name'] . "' required ></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='email' class='col-sm-1 control-label'>Email: </label><div class='col-sm-3'><input type='text' class='form-control' id ='email' name='email' value='" . $row['email'] . "'required></div>";
                        echo "<label for='mobile_number' class='col-sm-1 control-label'>Mobile Number: </label><div class='col-sm-3'><input type='text' class='form-control' id ='mobile_number' name='mobile_number' value='" . $row['mobile_number'] . "'required></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='address' class='col-sm-1 control-label'>Address: </label><div class='col-sm-7'><textarea name='address' rows='10' cols='133' class='form-control' id ='address'>". $row['address'] . "</textarea></div>";
                        echo "</div>";


                    }
                    echo "</form>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='customers.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='customersupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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