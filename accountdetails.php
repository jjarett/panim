<!DOCTYPE html>
<html>
<!--Get header -->
<?php
include 'includes/session.php';
include 'header.php';
include 'includes/accountedit_modal.php';
?>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "admin", null, "pganim");


    $custid = $_SESSION['cust_id'];
    $query = "SELECT * FROM customers where customer_id = '$custid'";
    $result = mysqli_query($con, $query);

    ?>

    <!-- page wrapper class -->
    <div class="page-wrapper quicksand-font">

        <!-- START BELOW HERE -->
        <br>
        <br>
        <div class="container">
            <div class="row">

                <p><a style="color: inherit; text-decoration:none;" href="account.php"><i class="fas fa-angle-left"></i>&nbsp;&nbsp;&nbsp;Back to Account</a></p>

            </div>

            <div class="row">

                <h3>My Account</h3>

            </div>

            <br><br>
            <div class="col-10">

                <h5>Account Details</h5>
                <hr>
                <div class="row" style="font-size:18px;">

                    <?php

                    if (mysqli_num_rows($result) == 0) {
                        echo "<p>No Details Found.</p>";
                    } else {

                        while ($row = mysqli_fetch_array($result)) {

                            echo "<div class='row'>";
                            echo "<div class='col-3'>First Name: " . $row['first_name'] . "</div>";
                            echo "<div class='col-1'></div>";
                            echo "<div class='col-3'>Last Name: " . $row['last_name'] . "</div>";
                            echo "<br>&nbsp;<br>";
                            echo "</div>";


                            echo "<div class='row'>";
                            echo "<div class='col-3'>Email: " . $row['email'] . "</div>";
                            echo "<div class='col-1'></div>";
                            echo "<div class='col-3'>Phone Number: " . $row['mobile_number'] . "</div>";
                            echo "<br>&nbsp;<br>";
                            echo "</div>";


                            echo "<div class='row'>";
                            echo "<br><div class='col-7'>Address: " . $row['address'] . "</div>";
                            echo "<br>&nbsp;<br>";
                            echo "</div>";
                        }

                        echo "<div class='col-12'>";
                        echo "<button type='button' class='btn btn-secondary float-end' data-bs-toggle='modal' data-bs-target='#accountDetailsModal'>Edit details</button>";
                        echo "</div>";
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



</body>

</html>