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
            right: 15px;
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
        $getCatQuery = "SELECT * FROM categories";
        $catResult = mysqli_query($con, $getCatQuery);
        if (isset($_GET['catid'])) {
            $selectedCat = $_GET['catid'];
        } else {
            $selectedCat = '0';
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

        if ($selectedCat == '0') {
            if ($sortBy == 1) {
                $getProductsQuery = "SELECT * FROM products WHERE product_name LIKE '%$searchCriteria%'";
            }
            if ($sortBy == 2) {
                $getProductsQuery = "SELECT * FROM products WHERE product_name LIKE '%$searchCriteria%' ORDER BY products.price ASC";
            } else if ($sortBy == 3) {
                $getProductsQuery = "SELECT * FROM products WHERE product_name LIKE '%$searchCriteria%' ORDER BY products.price DESC";
            }
        } else {
            if ($sortBy == 1) {
                $getProductsQuery = "SELECT * FROM products WHERE category_id = $selectedCat AND product_name LIKE '%$searchCriteria%'";
            }
            if ($sortBy == 2) {
                $getProductsQuery = "SELECT * FROM products WHERE category_id = $selectedCat AND product_name LIKE '%$searchCriteria%' ORDER BY products.price ASC";
            } else if ($sortBy == 3) {
                $getProductsQuery = "SELECT * FROM products WHERE category_id = $selectedCat AND product_name LIKE '%$searchCriteria%' ORDER BY products.price DESC";
            }
        }

        $productResult = mysqli_query($con, $getProductsQuery);

        ?>
        <div class="quicksand-font" style="width: 100%;">
            <div style="width: 100%; text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <span style="font-size: 24px;">Products</span>
            </div>
            <div style="display: flex; width: 100%;">
                <!-- Navigation part -->
                <div style="width: 10%; font-size: 20px;">
                    <div style="width: 100%; text-align: center;">

                        <?php
                        if (mysqli_num_rows($catResult) == 0) {
                            echo "<p>NO CATEGORIES FOUND.</p>";
                        } else {
                            if ($selectedCat == 0) {
                                echo '<button onclick="UpdateUrl(0)" class="selected-button">All</button>';
                            } else {
                                echo '<button onclick="UpdateUrl(0)" class="not-selected-button">All</button>';
                            }
                            while ($category = mysqli_fetch_array($catResult)) {
                                if ($selectedCat == $category['category_id']) {
                                    echo '<button onclick="UpdateUrl(' . $category['category_id'] . ')" class="selected-button">' . $category['category_name'] . '</button>';
                                } else {
                                    echo '<button onclick="UpdateUrl(' . $category['category_id'] . ')" class="not-selected-button">' . $category['category_name'] . '</button>';
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
                            <select onchange="UpdateUrl(<?php echo $selectedCat; ?>)" id="sortby" name="sortby" class="sort-option">
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
                            <button onclick="UpdateUrl(<?php echo $selectedCat; ?>)" class="search-button"><i class="fas fa-search"></i></button>
                        </div>

                    </div>
                    <?php
                    if (!$productResult || mysqli_num_rows($productResult) == 0) {
                        echo "<span style='padding-left: 20px;'>NO PRODUCTS FOUND.</span>";
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
        // function UpdateUrlSearchCriteria(currentCatId) {
        //     var searchCriteria = document.getElementById('searchProduct').value;
        //     var sortBy = document.getElementById('sortby').value;
        //     var newUrl = 'product_list.php?catid=' + currentCatId + '&searchCriteria=' + searchCriteria + '&sort=' + sortBy;
        //     window.location.href = newUrl;

        // }

        // function UpdateUrlCatId(newCatId) {
        //     var sortBy = document.getElementById('sortby').value;
        //     if (!searchCriteria) {
        //         var newUrl = 'product_list.php?catid=' + newCatId + '&sort=' + sortBy;
        //     } else {
        //         var searchCriteria = document.getElementById('searchProduct').value;
        //         var newUrl = 'product_list.php?catid=' + newCatId + '&searchCriteria=' + searchCriteria + '&sort=' + sortBy;
        //     }
        //     window.location.href = newUrl;
        // }

        // function UpdateUrlSortBy(currentCatId) {
        //     var searchCriteria = document.getElementById('searchProduct').value;
        //     var sortBy = document.getElementById('sortby').value;
        //     if (!searchCriteria) {
        //         var newUrl = 'product_list.php?catid=' + newCatId + '&sort=' + sortBy;
        //     } else {
        //         var newUrl = 'product_list.php?catid=' + currentCatId + '&searchCriteria=' + searchCriteria + '&sort=' + sortBy;
        //     }
        //     console.log(newUrl);
        //     window.location.href = newUrl;
        // }

        function UpdateUrl(CatId) {
            var searchCriteria = document.getElementById('searchProduct').value;
            var sortBy = document.getElementById('sortby').value;
            var newUrl = 'product_list.php?catid=' + CatId + '&searchCriteria=' + searchCriteria + '&sort=' + sortBy;
            window.location.href = newUrl;

        }
    </script>

</body>

</html>