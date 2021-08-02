<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'header.php';

$con = mysqli_connect("localhost", "admin", null, "pganim");
$queryCollection = "SELECT * FROM collections WHERE homepage = 1";
$collectionResult = mysqli_query($con, $queryCollection);


?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poggo</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3434f10350.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="scss/syles.css">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

  <div class="page-wrapper quicksand-font">

    <section id="home">
      <div class="container">
        <h1><span>Poggo Cat</span></h1>
        <p>Browse our new merchandise arrivals!</p>
        <a href="product_list.php"><button>Shop Now</button></a>
      </div>
    </section>
    <br>
    <section id="featured" class="w-100">
      <div class="container text-center mt-5 py-5">
        <h3>Browse our Collections!</h3>
        <hr class="mx-auto">
        <p>Get excited with our collections.</p>
      </div>
      <div class="row p-0 m-0 d-flex justify-content-center">
        <?php
        $i = 0;
        while ($collection = mysqli_fetch_array($collectionResult)) {
          echo '<div class="f1 col-lg-4 col-md-12 col-12 p-30">';
          echo '<a href="collection_list.php?colid=' . $collection["collection_id"] . '"><img class="img-fluid" src="images/' . $collection["image"] . '" alt="" height="1024" width="1024">';
          echo '<div class="details">';
          echo '<button>SHOP NOW</button>';
          echo '</div></a></div>';
          $i++;
          if ($i >= 3) break;
        }

        ?>

      </div>
    </section>

    <section id="new" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>New Arrivals</h3>
        <hr class="mx-auto">
        <p>Get the latest and exclusive Poggo merchandise release.</p>
      </div>
      <div class="row mx-auto container-fluid d-flex justify-content-center">
        <?php
        $queryIsNew = "SELECT * FROM products WHERE isNew = 1";
        $resultIsNew = mysqli_query($con, $queryIsNew);
        $i = 0;
        while ($row = mysqli_fetch_array($resultIsNew)) {
          echo '<div class="product text-center col-lg-3 col-md-4 col-12">';
          echo '<a href="product_details.php?pid=' . $row["product_id"] . '"><img class="img-fluid mb-3" src="images/' . $row['img'] . '"  height="602" width="602" alt="product picture">';
          echo '<h5 class="name">' . $row['product_name'] . '</h5>';
          echo '<h4 class="price">RM ' . $row['price'] . '</h4>';
          echo '<button class="addtoCart">Shop Now</button>';
          echo '</a></div>';
          $i++;
          if ($i >= 4) break;
        }
        ?>

      </div>
    </section>


  </div>

  <?php
  include 'footer.php';
  ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>