<!DOCTYPE html>
<html>

<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "pganim");
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Categories
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Category</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <?php
                if ($_SESSION['role'] == 'Manager') {
                  echo "<a href='#' class='btn btn-primary btn-sm btn-flat' id='addcategory' ><i class='fa fa-plus'></i> New</a>";
                }
                ?>
                <div class="pull-right">
                  <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                </div>
                <div class="box-body">
                  <table id="category-table" class="table table-bordered">
                    <thead>
                      <th>Category ID</th>
                      <th>Category Name</th>
                      <?php
                      if ($_SESSION['role'] == 'Manager') {
                        echo "<th>Tools</th>";
                      }
                      ?>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM categories";
                      $result = mysqli_query($con, $query);



                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No Categories Found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {
                          echo "
                            <tr>
                            <td style='width:100px'>" . $row['category_id'] . "</td>
                            <td style='width:150px'>" . $row['category_name'] . "</td>";
                          if ($_SESSION['role'] == 'Manager') {
                            echo "<td style='width:150px'>
                            <a href ='category_edit.php?id=" . $row['category_id'] . "'><button class='btn btn-success btn-sm editCategoryBtn btn-flat' data-id='" . $row['category_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                              <button onclick='deleteCategory(" . $row['category_id'] . ")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['category_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>";
                          }
                          echo "</tr>
                            ";
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
  include 'includes/category_modal.php';
  ?>

  <script>
    document.getElementById('addcategory').addEventListener('click',
      function() {
        document.querySelector('.bg-modal-addCategory').style.display = 'flex';

      });

    function deleteCategory(categoryID) {
      var result = confirm("Are you sure you would like to DELETE this category?");
      if (result) {
        window.location = "category_delete.php?id=" + categoryID;
      }
    }

    function searchFunction() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("category-table");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        let rowTds = tr[i].getElementsByTagName("td")
        for (j = 0; j < rowTds.length; j++) {
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