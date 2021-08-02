<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM discount_codes where discount_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Discount Codes
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Discount Codes</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Discount Codes Found.</p>";
                } else {
                    echo "<br><br><h4>Discount Code Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='discountsupdate' action='discounts_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {                        

                        echo "<div class='form-group'>";
                        echo "<label for='discount_id' class='col-sm-1 control-label'>Discount ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='discount_id' name='discount_id' value='" . $row['discount_id'] . "' readonly></div>";
                        echo "</div>";
                        

                        echo "<div class='form-group'>";
                        echo "<label for='discount_code' class='col-sm-1 control-label'>Discount Code: </label><div class='col-sm-3'><input type='text' class='form-control' id ='discount_code' name='discount_code' value='" . $row['discount_code'] . "' required ></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='discount_percentage' class='col-sm-1 control-label'>Discount Percentage: </label><div class='col-sm-3'><input type='text' class='form-control' id ='discount_percentage' name='discount_percentage' value='".$row['discount_percentage']."'></div>";
                        echo "<label for='min_spend' class='col-sm-1 control-label'>Min Spend: </label><div class='col-sm-3'><input type='text' class='form-control' id ='min_spend' name='min_spend' value='".$row['min_spend']."'></div>";

                        echo "</div>";


                        echo "<div class='form-group'>";
                        echo "<label for='validity' class='col-sm-1 control-label'>Validity: </label><div class='col-sm-3'><input type='checkbox' style=' margin-top:8px; height:20px; width:20px;' id ='validity' name='validity'";
                        if($row['validity']== 1){
                        echo "checked></div>";
                        }
                        else{
                            echo "></div>";
                        }
                        echo "</div>";


                    }
                    echo "</form>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='discountcodes.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='discountsupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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