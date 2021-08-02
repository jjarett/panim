<!DOCTYPE html>
<html>
<?php
include 'includes/session.php';
include 'header.php';
?>


<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        a {
            color: #4BB7D4;
        }

        .number-input input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }

        .number-input input[type=number]::-webkit-inner-spin-button,
        .number-input input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .number-input {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .number-input button {
            -webkit-appearance: none;
            background-color: transparent;
            border: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin: 0;
            position: relative;
        }

        .number-input button:before,
        .number-input button:after {
            display: inline-block;
            position: absolute;
            content: '';
            height: 2px;
            transform: translate(-50%, -50%);
        }

        .number-input button.plus:after {
            transform: translate(-50%, -50%) rotate(90deg);
        }

        .number-input input[type=number] {
            text-align: center;
        }

        .number-input.number-input {
            border: 1px solid #ced4da;
            width: 10rem;
            border-radius: .25rem;
        }

        .number-input.number-input button {
            width: 2.6rem;
            height: .7rem;
        }

        .number-input.number-input button.minus {
            padding-left: 10px;
        }

        .number-input.number-input button:before,
        .number-input.number-input button:after {
            width: .7rem;
            background-color: #495057;
        }

        .number-input.number-input input[type=number] {
            max-width: 4rem;
            padding: .5rem;
            border: 1px solid #ced4da;
            border-width: 0 1px;
            font-size: 1rem;
            height: 2rem;
            color: #495057;
        }
    </style>

</head>

<body>

    <!-- page wrapper class -->
    <div class="page-wrapper">

        <!-- START BELOW HERE -->
        <?php
        $custid = $_SESSION['cust_id'];
        $subtotal = 0;
        $con = mysqli_connect("localhost", "admin", null, "pganim");

        $getCustomerCartQuery = "SELECT * FROM cart WHERE customer_id = $custid";
        $customerCartResult = mysqli_query($con, $getCustomerCartQuery);
        ?>

        <div class="quicksand-font" style="width: 100%;">
            <div style="width: 100%; text-align: center;">
                <span style="font-size: 24px;">
                    Your Cart
                </span>
            </div>
            <?php
            if (mysqli_num_rows($customerCartResult) == 0) {
                echo '<br><div class="text-center"><p style="font-size:18px;">You have not added any products to your cart!</p></div>';
            } else {
            ?>
                <div style="width: 100%; display: flex; font-size: 20px; padding: 60px 0 10px 0;">
                    <div style="width: 65%; padding-left: 20px;">
                        <span>Product</span>
                    </div>
                    <div style="width: 10%;">
                        <span>Price</span>
                    </div>
                    <div style="width: 15%;">
                        <span>Quantity</span>
                    </div>
                    <div style="width: 10%;">
                        <span>Total</span>
                    </div>
                </div>
                <hr>
                <?php
                while ($cart = mysqli_fetch_array($customerCartResult)) {
                    $CartProdId = $cart["product_id"];
                    $getProductQuery = "SELECT * FROM products WHERE product_id = $CartProdId";
                    $productsResult = mysqli_query($con, $getProductQuery);
                    $products = mysqli_fetch_array($productsResult);
                    $subtotal = $subtotal + ($cart["quantity"] * $products['price']);

                    echo '<div style="width: 100%; display: flex; padding-bottom: 20px;">';
                    echo '<div style="width: 65%; display: flex; padding-left: 20px;">';
                    echo '<div style="width: 20%">';
                    echo '<img src="images/' . $products["img"] . '" alt="' . $products["product_name"] . '" width="150" height="150">';
                    echo '</div>';
                    echo '<div style="width: 80%; font-size: 20px; color: #696969;">';
                    echo '<div style="width: 100%; padding-top: 10px;">';
                    echo '<span>' . $products["product_name"] . '</span>';
                    echo '</div>';

                    echo '<div style="width: 100%; padding-top: 10px;">';
                    echo '<a href="cart_delete.php?cartid=' . $cart["cart_id"] . '"><span class="remove-button"><u>Remove</u></span></a>';
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    echo '<div style="width: 10%; padding-top: 10px;">';
                    echo '<span style="font-size: 20px; color: #696969;">' . $products["price"] . '</span>';
                    echo '<input type="hidden" class="cprice" value="' . $products["price"] . '">';
                    echo '<input type="hidden" name="cpid" value="' . $products["product_id"] . '">';
                    echo '</div>';
                    echo '<div style="width: 15%; padding-top: 5px;">';

                    echo '<div class="def-number-input number-input safari_only">';
                    echo '<button onclick="minusQuantity(' . $cart["cart_id"] . ', ' . $cart["quantity"] . ')" class="minus"></button>';
                    echo '<input class="quantity" id="" name="quantity" type="number" onchange="updateQuantity(' . $cart["cart_id"] . ', value, ' . $products["stock_status"] . ')" value="' . $cart["quantity"] . '" min="1" max="' . $products["stock_status"] . '" style="width: 50px; height: 35px; font-size: 20px;">';
                    echo '<button onclick="addQuantity(' . $cart["cart_id"] . ', ' . $cart["quantity"] . ', ' . $products["stock_status"] . ') " class="plus"></button>';
                    echo '</div>';

                    echo '<span style="font-size: 20px; color: #EE316D;"> ' . $products["stock_status"] . ' Left</span>';
                    echo '</div>';
                    echo '<div style="width: 10%; padding-top: 10px; font-size: 20px; color: #696969;">';
                    echo 'RM<span class="ctotal">' . $cart["quantity"] * $products['price'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <div style="width: 100%; display: flex;">
                    <div style="width: 75%;"></div>
                    <div style="width: 15%; font-size: 20px; padding-right: 20px;">
                        <span>Subtotal</span>
                    </div>
                    <div style="width: 10%; font-size: 20px; padding-right: 20px;">
                        RM<span id="csubtotal" class="csubtotal"><?php echo $subtotal ?></span>
                    </div>
                </div>
                <div style="width: 100%; display: flex; padding-top: 50px; padding-right: 20px;">
                    <div style="width: 75%;"></div>
                    <div style="width: 13%; padding-top: 20px;">
                        <a href="product_list.php">Continue Shopping</span></a>
                    </div>
                    <div style="width: 17%; font-size: 20px;">
                        <form action="checkout.php" method="post">
                            <input type="hidden" id="totalFromCart" name="totalFromCart" value="<?php echo $subtotal ?>">
                            <button class="checkout-button">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>


    </div>

    <script>
        function minusQuantity(cartid, currentQuantity) {
            newQuantity = currentQuantity - 1;
            if (newQuantity == 0) {
                var newUrl = 'cart_delete.php?cartid=' + cartid;
            } else {
                var newUrl = 'update_to_cart.php?cartid=' + cartid + '&quant=' + newQuantity;
            }
            window.location.href = newUrl;
        }

        function addQuantity(cartid, currentQuantity, maxQuantity) {
            newQuantity = currentQuantity + 1;
            if (newQuantity > maxQuantity) {
                newQuantity--;
            }
            var newUrl = 'update_to_cart.php?cartid=' + cartid + '&quant=' + newQuantity;
            window.location.href = newUrl;
        }

        function updateQuantity(cartid, newQuantity, maxQuantity) {
            if (newQuantity > maxQuantity) {
                newQuantity = maxQuantity;
            }
            var newUrl = 'update_to_cart.php?cartid=' + cartid + '&quant=' + newQuantity;
            window.location.href = newUrl;
        }
    </script>


    <!--Get footer -->
    <?php
    include 'footer.php';
    ?>


</body>

</html>