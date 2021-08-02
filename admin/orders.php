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
                    Orders
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Orders</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                                </div>

                                <div class="box-body">
                                    <br>&nbsp;<br>
                                    <table id="orders-table" class="table table-bordered">
                                        <thead>
                                            <th>Order ID:</th>
                                            <th>Customer Name:</th>
                                            <th>Amount Paid</th>
                                            <th>Order Status</th>
                                            <th>Details</th>
                                            <th>Tools</th>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $query = "SELECT * FROM orders";
                                            $result = mysqli_query($con, $query);



                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<p>No orders found.</p>";
                                            } else {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $customerName2ID = $row['customer_id'];
                                                    $query2 = "SELECT * FROM customers WHERE customer_id = $customerName2ID";
                                                    $result2 = mysqli_query($con, $query2);

                                                    // $productID2Name = $row['product_id'];
                                                    // $query3 = "SELECT product_name FROM products WHERE product_id = $productID2Name";
                                                    // $result3 = mysqli_query($con, $query3);

                                                    foreach ($result2 as $customer) {

                                                        echo "
                            <tr>
                            <td style='width:120px'>" . $row['order_id'] . "</td>
                            <td style='width:150px'>" . $customer['first_name'] . " " . $customer['last_name'] . "</td>
                            <td style='width:120px'>RM " . number_format($row['price'], 2) . "</td>
                            <td style='width:120px'>" . $row['order_status'] . "</td>
                            <td style='width:70px'><a href='orders_detail.php?oid=" . $row['order_id'] . "' id='orderdetails' ><i class='fa fa-info-circle fa-lg'></i></a></td>
                            <td style='width:150px'>
                            <a href ='orders_edit.php?id=" . $row['order_id'] . "&custid=" . $row['customer_id'] . "'><button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['order_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                            </td>
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
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </div>

    <script>
        function searchFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("orders-table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                let rowTds = tr[i].getElementsByTagName("td")
                for (j = 0; j < rowTds.length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</body>

</html>