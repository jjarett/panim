<!DOCTYPE html>
<html>
<?php
include 'includes/session.php';
include 'header.php';
?>


<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<style>
    .receipt-content .logo a:hover {
        text-decoration: none;
        color: #7793C4;
    }

    .receipt-content .invoice-wrapper {
        background: #FFF;
        border: 1px solid #CDD3E2;
        box-shadow: 0px 0px 1px #CCC;
        padding: 40px 40px 60px;
        margin-top: 40px;
        border-radius: 4px;
    }

    .receipt-content .invoice-wrapper .payment-details span {
        color: #A9B0BB;
        display: block;
    }

    .receipt-content .invoice-wrapper .payment-details a {
        display: inline-block;
        margin-top: 5px;
    }

    .receipt-content .invoice-wrapper .line-items a {
        display: inline-block;
        border: 1px solid #9CB5D6;
        padding: 13px 13px;
        border-radius: 5px;
        color: #708DC0;
        font-size: 13px;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }

    .receipt-content .invoice-wrapper .line-items a:hover {
        text-decoration: none;
        border-color: #333;
        color: #333;
    }

    .receipt-content {
        background: #ECEEF4;
    }


    .receipt-content .logo {
        text-align: center;
        margin-top: 50px;
    }

    .receipt-content .logo a {
        font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
        font-size: 36px;
        letter-spacing: .1px;
        color: #555;
        font-weight: 300;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }

    .receipt-content .invoice-wrapper .intro {
        line-height: 25px;
        color: #444;
    }

    .receipt-content .invoice-wrapper .payment-info {
        margin-top: 25px;
        padding-top: 15px;
    }

    .receipt-content .invoice-wrapper .payment-info span {
        color: black;
    }
    .receipt-content .invoice-wrapper .payment-info span strong {
        color: black;
    }

    .receipt-content .invoice-wrapper .payment-info strong {
        display: block;
        color: #444;
        margin-top: 3px;
    }


    .receipt-content .invoice-wrapper .payment-details {
        border-top: 2px solid #EBECEE;
        margin-top: 30px;
        padding-top: 20px;
        line-height: 22px;
    }

    .receipt-content .invoice-wrapper .line-items {
        margin-top: 40px;
    }

    .receipt-content .invoice-wrapper .line-items .headers {
        color: #A9B0BB;
        font-size: 13px;
        letter-spacing: .3px;
        border-bottom: 2px solid #EBECEE;
        padding-bottom: 4px;
    }

    .receipt-content .invoice-wrapper .line-items .items {
        margin-top: 8px;
        border-bottom: 2px solid #EBECEE;
        padding-bottom: 8px;
    }

    .receipt-content .invoice-wrapper .line-items .items .item {
        padding: 10px 0;
        color: #696969;
        font-size: 15px;
    }


    .receipt-content .invoice-wrapper .line-items .items .item .amount {
        letter-spacing: 0.1px;
        color: #84868A;
        font-size: 16px;
    }


    .receipt-content .invoice-wrapper .line-items .total {
        margin-top: 30px;
    }

    .receipt-content .invoice-wrapper .line-items .total .extra-notes {
        float: left;
        width: 40%;
        text-align: left;
        font-size: 13px;
        color: #7A7A7A;
        line-height: 20px;
    }


    .receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
        display: block;
        margin-bottom: 5px;
        color: #454545;
    }

    .receipt-content .invoice-wrapper .line-items .total .field {
        margin-bottom: 7px;
        font-size: 14px;
        color: #555;
    }

    .receipt-content .invoice-wrapper .line-items .total .field.grand-total {
        margin-top: 10px;
        font-size: 16px;
        font-weight: 500;
    }

    .receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
        color: #20A720;
        font-size: 16px;
    }

    .receipt-content .invoice-wrapper .line-items .total .field span {
        display: inline-block;
        margin-left: 20px;
        min-width: 85px;
        color: #84868A;
        font-size: 15px;
    }

    .receipt-content .invoice-wrapper .line-items {
        margin-top: 50px;
        text-align: left;
    }



    .receipt-content .invoice-wrapper .line-items a i {
        margin-right: 3px;
        font-size: 14px;
    }

    .receipt-content .footer {
        margin-top: 40px;
        margin-bottom: 110px;
        text-align: center;
        font-size: 12px;
        color: #969CAD;
    }


</style>
<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

date_default_timezone_set("Asia/Kuala_Lumpur");
$payDate =  date('d-m-Y');
$totalpaid = $_SESSION['total'];

$custid = $_SESSION['cust_id'];
$queryCust = "SELECT * FROM customers WHERE customer_id = $custid";
$resultCust = mysqli_query($con, $queryCust);
$custDetails = mysqli_fetch_array($resultCust);

$queryfrCart = "SELECT * FROM cart WHERE customer_id = $custid";
$resultfrCart = mysqli_query($con, $queryfrCart);


?>


<body>


    <!-- page wrapper class -->
    <div class="page-wrapper quicksand-font">

        <!-- START BELOW HERE -->

        <!-- receipt -->
        <h3 class="text-center">Your Invoice</h3>

        <div class="receipt-content" id= "printDiv">
            <div class="container bootstrap snippets bootdey">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-wrapper">

                            <div class="payment-info">
                                <div class="row">
                                    <div class="col-6">
                                        <span>Transaction ID</span>
                                        <strong><?php echo $_SESSION['txnid']; ?></strong><br>
                                        <span>Order ID</span>
                                        <strong><?php echo $_SESSION['oid']; ?></strong>
                                    </div>

                                    <div class="col-6 text-right">
                                        <span style="margin-left:150px">Payment Date</span>
                                        <strong><span style="margin-left:150px"><?php echo $payDate; ?></span></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-details">
                                <div class="row">
                                    <div class="col-6">
                                        <span>Client</span>
                                        <strong>
                                            <?php echo $custDetails['first_name'] . " " . $custDetails['last_name']; ?>
                                        </strong>
                                        <p>
                                            <?php echo $custDetails['address']; ?><br>
                                            <?php echo $custDetails['mobile_number']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="line-items">
                                <div class="headers clearfix">
                                    <div class="row">
                                        <div class="col-5">Product Name</div>
                                        <div class="col-3">Quantity</div>
                                        <div class="col-4 text-right">Amount</div>
                                    </div>
                                </div>

                                <div class="items">

                                    <?php while ($rowCart = mysqli_fetch_array($resultfrCart)) {
                                        $prodIDfrCart = $rowCart['product_id'];
                                        $quantityfrCart = $rowCart['quantity'];
                                        $queryProduct = "SELECT * FROM products WHERE product_id = $prodIDfrCart";
                                        $resultProduct = mysqli_query($con, $queryProduct);
                                        $product = mysqli_fetch_array($resultProduct);

                                        $productID2Name = $prodIDfrCart;
                                        $query2 = "SELECT * FROM products WHERE product_id = $productID2Name";
                                        $result2 = mysqli_query($con, $query2);

                                        foreach ($result2 as $product) {
                                            $productName = $product['product_name'];
                                            $productPrice = $product['price'];
                                        }

                                        echo '<div class="row item">';
                                        echo '<div class="col-5 desc">';
                                        echo $productName;
                                        echo '</div>';

                                        echo '<div class="col-3 qty">';
                                        echo $rowCart['quantity'];
                                        echo '</div>';

                                        echo '<div class="col-4 amount text-right">';
                                        echo 'RM '.($rowCart['quantity'] * $productPrice);
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>

                                <div class="total text-right">
                                <p class="extra-notes">
								<strong>Extra Notes</strong>
								Estimated shipping duration will be 2 - 5 days.<br>
							    </p>
                                    
                                    <div class="field" style="margin-left:750px;">
                                        Subtotal <span><?php echo "RM " . $_SESSION['subtotal']; ?></span>
                                    </div>
                                    <?php
                                    if(isset($_SESSION['discountAmount'])){

                                    ?>
                                    <div class="field" style="margin-left:745px;">
                                        Discount <span>-<?php echo "RM " . $_SESSION['discountAmount']; ?></span>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="field" style="margin-left:750px;">
                                        Shipping <span><?php echo "RM " . $_SESSION['deliveryFee']; ?></span>
                                    </div>
                                    
                                    <div class="field grand-total" style="margin-left: 750px;">
                                        Total <span style="padding-left: 19px;"><?php echo "RM " . $totalpaid; ?></span>
                                    </div>
                                
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <br>&nbsp;<br>
            </div>
        </div>
        

        <!-- buttons -->

        <div class="d-flex justify-content-center pt-5">
            <a href="product_list.php"><button class="btn btn-warning">Continue Shopping</button></a>
            <span class="p-2">or</span>
            <a href="account.php"><button class="btn btn-warning">View Orders</button></a>
        </div>
        <br>&nbsp;<br>








        <!-- END HERE -->
    </div>

    <?php

    //delete from cart
    $queryDelete = "DELETE FROM cart WHERE customer_id = '$custid'";
    $resultDelete = mysqli_query($con, $queryDelete);

    mysqli_close($con);
    ?>


    <!--Get footer -->
    <?php
    include 'footer.php';

    ?>

    <!-- thank you modal -->
    <div class="modal" id="tqpopup" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="images/thank-you.png" alt="thank you" width="465" height="465">
                </div>
            </div>
        </div>
    </div>


<script>
    $(window).on('load', function() {
        $('#tqpopup').modal('show');
    });

$(window).on('load', function() {
        $('#tqpopup').modal('show');
    });
document.getElementById("doPrint").addEventListener("click", function() {
     var printContents = document.getElementById('printDiv').innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
});


</script>

</body>


</html>