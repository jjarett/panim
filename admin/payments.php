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
                    Payments
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Payments</li>
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
                                    <table id="payments-table" class="table table-bordered">
                                        <thead>
                                            <th>Payment ID</th>
                                            <th>Order ID</th>
                                            <th>Payment Date & Time</th>
                                            <th>Amount</th>
                                            <th>Transaction ID</th>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $query = "SELECT * FROM payments";
                                            $result = mysqli_query($con, $query);



                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<p>No Payments Found.</p>";
                                            } else {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $txn_id = $row['txn_id'];
                                                    $paymentid = $row['payment_id'];
                                                    echo "
                            <tr>
                            <td style='width:120px'>" . $row['payment_id'] . "</td>
                            <td style='width:150px'>" . $row['order_id'] . "</td>
                            <td style='width:150px'>" . $row['payment_dateTime'] . "</td>
                            <td style='width:150px'>" . $row['amount'] . "</td>
                            <td style='width:120px'>" . $row['txn_id'] . "</td>
                           </tr>
                            ";
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

    <div class="modal fade" id="transaction_id">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add/Edit Transaction ID</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <form method="POST" action="payment_txnid.php" id="add_txnid">
                    <label for="txnid" class="col-sm-3 control-label" >Transaction ID</label>
                        <div class=" col-sm-5 offset-2">
                        <!-- <label for="txnid">Transaction ID</label> -->
                        <input type="hidden" name="payment_id" value="<?php echo $paymentid; ?>">
                        <input type="text" class="form-control" id="txnid" name="txnid" <?php if(isset($txn_id)){?>value="<?php echo $txn_id?>"<?php }?> required>
                            
                        </div>
                    </form>
                    <br><br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_txnid" name="save" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function searchFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("payments-table");
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