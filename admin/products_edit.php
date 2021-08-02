<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM products where product_id = '$id'";
$result = mysqli_query($con, $query);
$queryCollection = "SELECT * FROM collections";
$resultCollection = mysqli_query($con, $queryCollection);
$queryCategory = "SELECT * FROM categories";
$resultCategory = mysqli_query($con, $queryCategory);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Products
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Products</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Products Found.</p>";
                } else {
                    echo "<br><br>Product Information: <br> <br>";
                    echo "<form class='form-horizontal' action='products_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        $photoName = $row['img'];

                        echo "<input type='hidden' name='photoName' value='".$photoName."'>";
                        echo "<input type='hidden' name='product_id' value='".$id."'>";
                        echo "<div class='form-group'>";
                        echo "<label for='product_name' class='col-sm-1 control-label'>Product Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='product_name' name='product_name' value='" . $row['product_name'] . "'></div>";
                        echo "<label for='category' class='col-sm-1 control-label'>Category: </label><div class='col-sm-3'><select class='form-control' id='category' name='category' required>";
                        foreach ($resultCategory as $category) {
                            if($row['category_id'] == $category['category_id']){
                                echo "<option value='" . $category['category_id'] . "' selected>" . $category['category_name'] . "</option>"; 

                            } else{
                                echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>"; 

                            }
                        }               
                        echo "</select></div>";         
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='collection' class='col-sm-1 control-label'>Collection: </label><div class='col-sm-3'><select class='form-control' id='collection' name='collection' required>";
                        foreach ($resultCollection as $collection) {
                            if($row['collection_id'] == $collection['collection_id']){
                                echo "<option value='" . $collection['collection_id'] . "' selected>" . $collection['collection_name'] . "</option>"; 

                            } else{
                                echo "<option value='" . $collection['collection_id'] . "'>" . $collection['collection_name'] . "</option>"; 

                            }
                        }
                        echo "</select></div>";
                        echo "<label for='stock_status' class='col-sm-1 control-label'>Stock: </label><div class='col-sm-3'><input type='text' class='form-control' id ='stock_status' name='stock_status' value='" . $row['stock_status'] . "'></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='price' class='col-sm-1 control-label'>Price: </label><div class='col-sm-3'><input type='text' class='form-control' id ='price' name='price' value='" . $row['price'] . "'></div>";
                        echo "<label for='photo' class='col-sm-1 control-label'>Photo: </label><div class='col-sm-3'><input type='file' class='form-control' id ='photo' name='photo'></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='isNew' class='col-sm-1 control-label'>Is New: </label><div class='col-sm-3'><input type='checkbox' style=' margin-top:8px; height:20px; width:20px;' id ='isNew' name='isNew'";
                        if($row['isNew']== 1){
                        echo "checked></div>";
                        }
                        else{
                            echo "></div>";
                        }
                        echo "</div>";


                        echo "<div class='form-group'>";
                        echo "<label for='description' class='col-sm-1 control-label'>Description: </label><div class='col-sm-7'><textarea name='description' rows='10' cols='133' class='form-control' id ='description'>". $row['description'] . "</textarea></div>";
                        echo "</div>";
                    }

                    echo "<div class='col-sm-8'><button type='submit' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
                    echo "</form>";
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