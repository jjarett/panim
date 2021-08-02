<!DOCTYPE html>
<html>

<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

error_reporting(0);

$con = mysqli_connect("localhost", "admin", null, "pganim");
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Products
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Products</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">

                <div class="pull-left">
                  <a href="#" class="btn btn-primary btn-sm btn-flat" id="addproduct"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="pull-right">
                  <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                </div>

                <div class="box-body">
                  <br>&nbsp;<br>
                  <table id="products-table" class="table table-bordered">
                    <thead>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Collection</th>
                      <th>Price</th>
                      <th>Stock Status</th>
                      <th>Is New</th>
                      <th>Tools</th>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM products";
                      $result = mysqli_query($con, $query);



                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No products found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {
                          $collectionName2ID = $row['collection_id'];
                          $query2 = "SELECT collection_name FROM collections WHERE collection_id = $collectionName2ID";
                          $result2 = mysqli_query($con, $query2);

                          $categoryID2Name = $row['category_id'];
                          $query3 = "SELECT category_name FROM categories WHERE category_id = $categoryID2Name";
                          $result3 = mysqli_query($con, $query3);

                          foreach ($result3 as $category) {
                            $categoryName = $category['category_name'];
                          }

                          if($row['isNew'] == 0){
                            $isNew = 'Disabled';
                          }
                          else{
                            $isNew = 'Enabled';
                          }

                          foreach ($result2 as $collection) {
                            $image = (!empty($row['img'])) ? '../images/' . $row['img'] : '../images/noimage.jpg';
                            echo "
                            <tr>
                            <td style='width:150px'>" . $row['product_name'] . "</td>
                            <td style='width:120px'>
                              <img src='" . $image . "' height='60px' width='60px'>
                            </td>
                            <td>" . $row['description'] . "</td>
                            <td style='width:100px'>" . $categoryName . "</td>
                            <td style='width:120px'>" . $collection['collection_name'] . "</td>
                            <td style='width:120px'>RM " . number_format($row['price'], 2) . "</td>
                            <td style='width:120px'>" . $row['stock_status'] . "</td>
                            <td style='width:100px'>" . $isNew . "</td>
                            <td style='width:150px'>
                            <a href ='products_edit.php?id=" . $row['product_id'] . "'><button class='btn btn-success btn-sm editProdBtn btn-flat' data-id='" . $row['product_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                              <button onclick='deleteProd(" . $row['product_id'] . ")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['product_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                           </tr>
                            ";
                          }
                        }
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>



      </section>
    </div>
  </div>

  <?php
  include 'includes/product_modal.php';
  ?>

  <script>
    document.getElementById('addproduct').addEventListener('click',
      function() {
        document.querySelector('.bg-modal-add').style.display = 'flex';

      });

    document.querySelector('.close-add').addEventListener('click',
      function() {
        document.querySelector('.bg-modal-add').style.display = 'none';
      });

    function deleteProd(productID) {
      var result = confirm("Are you sure you would like to DELETE this product?");
      if (result) {
        window.location = "products_delete.php?id=" + productID;
      }
    }


    function searchFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("products-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    let rowTds = tr[i].getElementsByTagName("td")
    for (j = 0; j < rowTds.length; j++){
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }       
  }
}
  </script>





</body>

</html>