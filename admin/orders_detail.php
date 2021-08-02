<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "pganim");

$oid = $_GET['oid'];


$query = "SELECT * FROM cust_orders where order_id = '$oid'";
$result = mysqli_query($con, $query);

?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Order Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Orders</li>
                    <li class="active">Order Details</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="box">
            <div class="box-body">
            <table id="orders-table" class="table table-bordered">
                                        <thead>
                                            <th>Product Name:</th>
                                            <th>Quantity:</th>
                                        </thead>
                                        <tbody>
                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>Order Details not found.</p>";
                } else {
                    echo "<br><br><h3> ORDER ID: ".$oid." </h3><br> <br>";
                    while ($row = mysqli_fetch_array($result)) {

                        $productID2Name = $row['product_id'];
                        $query3 = "SELECT product_name FROM products WHERE product_id = $productID2Name";
                        $result3 = mysqli_query($con, $query3);

                        foreach ($result3 as $product) {

                            echo "
                            <tr>
                            <td style='width:150px'>" . $product['product_name'] . "</td>
                            <td style='width:120px'>" . $row['quantity'] . "</td>
                            </tr>
                            ";
                        }
                    }
                }
                ?>
                </tbody>
            </table>
            </div>
            </div>

            </section>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
</body>

</html>