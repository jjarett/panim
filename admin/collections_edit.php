<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$id = $_GET['id'];

$query = "SELECT * FROM collections where collection_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Collections
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Collections</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Orders Found.</p>";
                } else {
                    echo "<br><br><h4>Collection Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='collectionsupdate' action='collections_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        $photoName = $row['image'];

                        

                        echo "<input type='hidden' name='photoName' value='".$photoName."'>";

                        echo "<div class='form-group'>";
                        echo "<label for='collection_id' class='col-sm-1 control-label'>Collection ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='collection_id' name='collection_id' value='" . $row['collection_id'] . "' readonly></div>";
                        echo "</div>";
                        

                        echo "<div class='form-group'>";
                        echo "<label for='collection_name' class='col-sm-1 control-label'>Customer First Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='collection_name' name='collection_name' value='" . $row['collection_name'] . "' required ></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='photo' class='col-sm-1 control-label'>Photo: </label><div class='col-sm-3'><input type='file' class='form-control' id ='photo' name='photo'></div>";
                        echo "<label for='homepage' class='col-sm-1 control-label'>Homepage: </label><div class='col-sm-3'><input type='checkbox' style=' margin-top:8px; height:20px; width:20px;' id ='homepage' name='homepage'";
                        if($row['homepage']== 1){
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
                    echo "</form>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='collections.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='collectionsupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
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