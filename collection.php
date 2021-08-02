<!DOCTYPE html>
<html>
<?php
session_start();
include 'header.php'; 
?>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        .product-box {
            width: 340px;
            height: 450px;
            padding: 10px 20px;
            margin: 0 50px 100px 50px;
            color: black;
        }
        
        .product-box:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        a {
            color: black;
        }
    </style>
</head>

<body>


    <!-- page wrapper class -->
    <div class="page-wrapper">

        <?php
        $con = mysqli_connect("localhost", "admin", null, "pganim");
        $getCollectionQuery = "SELECT * FROM collections";
        $collectionResult = mysqli_query($con, $getCollectionQuery);

        ?>
        <!-- START BELOW HERE -->
        <div class="quicksand-font" style="width: 100%;">
            <div style="width: 100%; text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <span style="font-size: 24px;">All Collections</span>
            </div>

            <div style="width: 100%; padding-left: 30px;">
                <?php
                if (mysqli_num_rows($collectionResult) == 0) {
                    echo "<p>NO CATEGORY FOUND.</p>";
                } else {
                    echo '<div style="display: flex; flex-wrap: wrap; width: 100%;">';
                    while ($collection = mysqli_fetch_array($collectionResult)) {
                        echo '<div class="product-box">';
                        echo '<a href="collection_list.php?colid=' . $collection["collection_id"] . '" style="text-decoration: none;">';
                        echo '<div style="width: 100%;">';
                        echo '<img src="images/' . $collection["image"] . '" width="300" height="300">';
                        echo '</div>';
                        echo '<div style="width: 100%; padding-top: 10px;">';
                        echo '<span style="font-size: 20px;">' . $collection["collection_name"] . ' Collection</span><br>';
                        echo '<span style="font-size: 16px;">' . $collection["description"] . '</span>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

                ?>
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