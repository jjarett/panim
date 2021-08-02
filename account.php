<!DOCTYPE html>
<html>

<?php
include 'includes/session.php';
//Get header
include 'header.php';
include 'includes/orderdetails_modal.php';
?>

<body>


    <?php

    $con = mysqli_connect("localhost", "admin", null, "pganim");

    $custid = $_SESSION['cust_id'];
    $queryCust = "SELECT * FROM customers WHERE customer_id = $custid";
    $resultCust = mysqli_query($con, $queryCust);

    $queryOrder = "SELECT * FROM orders WHERE customer_id = $custid";
    $resultOrder = mysqli_query($con, $queryOrder);

    ?>

    <!-- page wrapper class -->
    <div class="page-wrapper quicksand-font">

        <!-- START BELOW HERE -->
        <br>
        <br>
        <div class="container">

            <div class="row">
                <div class="col-11">
                    <h3>My Account</h3>
                </div>
                <div class="col-1">
                    <a type='button' class='btn btn-secondary' href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>LOGOUT</a>
                </div>
            </div>

            <br>
            <div class="row">

                <p>Welcome back, <?php echo $_SESSION['full_name'] ?></p>

            </div>
            <br><br>
            <div class="row">

                <div class="col-8">

                    <h5>My Orders</h5>
                    <hr>
                    <div class="row">

                        <?php

                        $query = "SELECT * FROM orders WHERE customer_id = $custid";
                        $result = mysqli_query($con, $query);





                        if (mysqli_num_rows($result) == 0) {
                            echo "<p>No orders found.</p>";
                        } else {
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <th>Order ID</th>
                                    <th>Product Details</th>
                                    <th>Amount Paid</th>
                                    <th>Transaction ID</th>
                                    <th>Order Status</th>
                                    <th>Tracking Number</th>
                                </thead>
                                <tbody>
                                <?php

                                while ($row = mysqli_fetch_array($result)) {

                                    $order_id = $row['order_id'];

                                    $queryPayment = "SELECT * FROM payments WHERE order_id = $order_id";
                                    $resultPayment = mysqli_query($con, $queryPayment);
                                    $payment = mysqli_fetch_array($resultPayment);

                                    $queryDelivery = "SELECT * FROM delivery WHERE order_id = $order_id";
                                    $resultDelivery = mysqli_query($con, $queryDelivery);
                                    $delivery = mysqli_fetch_array($resultDelivery);

                                    echo "
                            <tr>
                            <td style='width:120px'>" . $row['order_id'] . "</td>
                            <td style='width:70px'><a href='#'  onclick='ShowModalProduct(" . $row['order_id'] . ")' id='orderdetails'><i class='fa fa-info-circle fa-lg'></i></a></td>
                            <td style='width:120px'>RM " . number_format($row['price'], 2) . "</td>
                            <td style='width:120px'>" . $payment['txn_id'] . "</td>
                            <td style='width:120px'>" . $row['order_status'] . "</td>";

                                    if ($delivery['tracking_no'] == 'N/A') {
                                        echo "<td style='width:120px'>N/A</td>
                                        </tr>
                                        ";
                                    } else {

                                        echo "<td style='width:120px'><a target='_blank' href='https://www.jtexpress.my/track.php?awbs=" . $delivery['tracking_no'] . "'>" . $delivery['tracking_no'] . "</a></td>
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
                <div class="col-1">
                </div>
                <div class="col-3">

                    <h5>Profile Details</h5>
                    <hr>

                    <?php
                    if (mysqli_num_rows($resultCust) == 0) {
                        echo "<p>No Details Found.</p>";
                    } else {
                        while ($row = mysqli_fetch_array($resultCust)) {


                            echo "<div class='row'>";
                            echo "<p>" . $row['first_name'] . " " . $row['last_name'] . "</p>";
                            echo "</div>";

                            echo "<div class='row'>";
                            echo "<p>" . $row['email'] . "</p>";
                            echo "</div>";

                            echo "<div class='row'>";
                            echo "<p>" . $row['mobile_number'] . "</p>";
                            echo "</div>";

                            echo "<div class='row'>";
                            echo "<p>" . $row['address'] . "</p>";
                            echo "</div>";

                            echo "<div class='row'>";
                            echo "<p><a href='accountdetails.php'><button type='button' class='btn btn-secondary'>Edit Profile Details</button></a></p>";
                            echo "</div>";
                        }
                    }
                    ?>

                </div>

            </div>

        </div>



        <!-- END HERE -->
    </div>


    <!--Get footer -->
    <?php
    include 'footer.php';
    ?>

    <script>
        function ShowModalProduct(id) {

            $.ajax({
                url: 'getorderdetails.php',
                type: 'get',
                data: {
                    'id': id
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response == null) {
                        alert('Details Not Found');
                    } else {

                        data = response;
                        console.log(data);
                        $('#orderdetails').modal('show');
                        $('#orders').html(data);

                    }
                }
            });
        }
    </script>
</body>

</html>