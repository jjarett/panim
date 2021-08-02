<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM categories where category_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Category
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Categories</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Orders Found.</p>";
                } else {
                    echo "<br><br><h4>Category Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='categoryupdate' action='category_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='category_id' class='col-sm-1 control-label'>Category ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='category_id' name='category_id' value='" . $row['category_id'] . "' readonly></div>";
                        echo "<label for='category_name' class='col-sm-1 control-label'>Category Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='category_name' name='category_name' value='" . $row['category_name'] . "' required ></div>";
                        echo "</div>";

                    }
                    echo "</form>";
                    echo "<br>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='category.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='categoryupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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