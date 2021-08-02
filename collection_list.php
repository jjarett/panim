<!DOCTYPE html>
<html>
<?php
session_start();
include 'header.php'; 
?>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        .not-selected-button {
            font-family: Quicksand;
            background-color: transparent;
            border: none;
            border-radius: 0px;
            color: black;
            padding-top: 10px;
            padding-bottom: 10px;
            width: 120px;
            cursor: pointer;
            font-size: 18px;
        }

        .selected-button {
            font-family: Quicksand;
            background-color: transparent;
            font-weight: bold;
            border: none;
            border-radius: 0px;
            color: black;
            padding-top: 10px;
            padding-bottom: 10px;
            width: 120px;
            cursor: pointer;
            font-size: 18px;
        }

        .product-box {
            width: 290px;
            height: 380px;
            padding: 10px 20px;
            margin: 0 50px 100px 50px;
            color: black;
        }

        .product-box:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }
        
        .search-container {
            right: 0px;
            position: absolute;
            background-color: #F5F5F5;
            padding: 10px;
        }

        .search-box {
            font-size: 20px;
            height: 30px;
            font-family: Quicksand;
            border: none;
            background-color: #F5F5F5;
            color: #EE316D;
        }

        .search-box:focus {
            outline: 1px solid transparent;
        }

        .search-button {
            border: none;
            background-color: transparent;
            color: #EE316D;
            height: 30px;
            width: 30px;
            font-size: 24px;
            cursor: pointer;
        }

        .sort-option {
            font-size: 20px;
            border: none;
            height: 30px;
            width: 240px;
            color: #EE316D;
            background-color: #F5F5F5;
        }

        .sort-option:focus {
            outline: 1px solid transparent;
        }

        a {
            color: black;
        }
    </style>
</head>

<body>

    <!-- page wrapper class -->
    <div class="page-wrapper">

        <!-- START BELOW HERE -->
        <?php
        $con = mysqli_connect("localhost", "admin", null, "pganim");
        $getCollectionQuery = "SELECT * FROM collections";
        $collectionResult = mysqli_query($con, $getCollectionQuery);
        if (isset($_GET['colid'])) {
            $selectedCollection = $_GET['colid'];
        } else {
            $selectedCollection = '1';
        }
        if (isset($_GET['searchCriteria'])) {
            $searchCriteria = $_GET['searchCriteria'];
        } else {
            $searchCriteria = '';
        }
        if (isset($_GET['sort'])) {
            $sortBy = $_GET['sort'];
        } else {
            $sortBy = 1;
        }

        $getCollectionNameQuery = "SELECT * FROM collections WHERE collection_id = $selectedCollection";
        $collectionNameResult = mysqli_query($con, $getCollectionNameQuery);
        $collectionName = mysqli_fetch_array($collectionNameResult);

        if ($sortBy == 1) {
            $getProductsCollectionQuery = "SELECT * FROM products WHERE collection_id = $selectedCollection AND product_name LIKE '%$searchCriteria%'";
        }
        if ($sortBy == 2) {
            $getProductsCollectionQuery = "SELECT * FROM products WHERE collection_id = $selectedCollection AND product_name LIKE '%$searchCriteria%' ORDER BY products.price ASC";
        } else if ($sortBy == 3) {
            $getProductsCollectionQuery = "SELECT * FROM products WHERE collection_id = $selectedCollection AND product_name LIKE '%$searchCriteria%' ORDER BY products.price DESC";
        }
        // $getProductsCollectionQuery = "SELECT * FROM products WHERE collection_id = $selectedCollection";
        $productResult = mysqli_query($con, $getProductsCollectionQuery);

        ?>
        <div class="quicksand-font" style="width: 100%;">
            <div style="width: 100%; text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <span style="font-size: 24px;">Products in <?php echo $collectionName['collection_name']; ?> Collection</span>
            </div>
            <div style="display: flex; width: 100%;">
                <!-- Navigation part -->
                <div style="width: 10%; font-size: 20px;">
                    <div style="width: 100%; text-align: center;">

                        <?php
                        if (mysqli_num_rows($collectionResult) == 0) {
                            echo "<p>NO COLLECTIONS FOUND.</p>";
                        } else {
                            while ($collection = mysqli_fetch_array($collectionResult)) {
                                if ($selectedCollection == $collection['collection_id']) {
                                    echo '<button onclick="UpdateUrl('.$collection["collection_id"].')" class="selected-button">' . $collection['collection_name'] . '</button>';
                                } else {
                                    echo '<button onclick="UpdateUrl('.$collection["collection_id"].')" class="not-selected-button">' . $collection['collection_name'] . '</button>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- Product display part -->
                <div style="width: 90%; padding-left: 30px;">
                    <div style="width: 100%; padding-bottom: 80px;">
                        <div class="search-container">
                            <select onchange="UpdateUrl(<?php echo $selectedCollection; ?>)" id="sortby" name="sortby" class="sort-option">
                                <?php
                                $sortingArray = array('Relevance', 'Price - Low to High', 'Price - High to Low');
                                for ($i = 0; $i < 3; $i++) {
                                    if ($sortBy == ($i + 1)) {
                                        echo '<option value="' . ($i + 1) . '" selected>' . $sortingArray[$i] . '</option>';
                                    } else {
                                        echo '<option value="' . ($i + 1) . '">' . $sortingArray[$i] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <input type="text" id="searchProduct" name="searchProduct" placeholder="Search here..." value="<?php echo $searchCriteria ?>" class="search-box">
                            <button onclick="UpdateUrl(<?php echo $selectedCollection; ?>)" class="search-button"><i class="fas fa-search"></i></button>
                        </div>

                    </div>
                    <?php
                    if (mysqli_num_rows($productResult) == 0) {
                        echo "<p>NO PRODUCTS FOUND IN THIS COLLECTION.</p>";
                    } else {
                        echo '<div style="display: flex; flex-wrap: wrap; width: 100%;">';
                        while ($product = mysqli_fetch_array($productResult)) {
                            echo '<div class="product-box">';
                            echo '<a href="product_details.php?pid=' . $product["product_id"] . '" style="text-decoration: none;">';
                            echo '<div style="width: 100%;">';
                            echo '<img src="images/' . $product["img"] . '" width="250" height="250">';
                            echo '</div>';
                            echo '<div style="width: 100%; font-size: 18px; padding-top: 10px;">';
                            echo '<span>' . $product["product_name"] . '</span><br>';
                            echo '<span>RM' . $product["price"] . '</span>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                        echo '</div>';
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
        function UpdateUrl(ColId) {
            var searchCriteria = document.getElementById('searchProduct').value;
            var sortBy = document.getElementById('sortby').value;
            var newUrl = 'collection_list.php?colid=' + ColId + '&searchCriteria=' + searchCriteria + '&sort=' + sortBy;
            window.location.href = newUrl;

        }
    </script>

</body>

</html>