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
        Discount Codes
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Discount Codes</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">

                <div class="pull-left">

                <?php
                      if($_SESSION['role'] == 'Manager'){
                      echo "<a href='#' class='btn btn-primary btn-sm btn-flat' id='adddiscount' ><i class='fa fa-plus'></i> New</a>";
                      }
                      ?>

                </div>
                <div class="pull-right">
                  <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                </div>

                <div class="box-body">
                  <br>&nbsp;<br>
                  <table id="products-table" class="table table-bordered">
                    <thead>
                      <th>Discount Code</th>
                      <th>Discount Percentage</th>
                      <th>Min Spend</th>
                      <th>Validity</th>
                      <?php
                      if($_SESSION['role'] == 'Manager'){
                      echo "<th>Tools</th>";
                      }
                      ?>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM discount_codes";
                      $result = mysqli_query($con, $query);



                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No discount codes found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {

                          if($row['validity'] == 0){
                            $validity = 'Not Valid';
                          }
                          else{
                            $validity = 'Valid';
                          }

                            echo "
                            <tr>
                            <td style='width:150px'>" . $row['discount_code'] . "</td>
                            <td style='width:150px'>" . $row['discount_percentage'] . "</td>
                            <td style='width:100px'>" . $row['min_spend'] . "</td>
                            <td style='width:100px'>" . $validity . "</td>";
                            if($_SESSION['role'] == 'Manager'){
                            echo "<td style='width:150px'>
                            <a href ='discounts_edit.php?id=" . $row['discount_id'] . "'><button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['discount_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                              <button onclick='deleteDiscount(" . $row['discount_id'] . ")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['discount_id'] . "'><i class='fa fa-trash'></i> Delete</button>
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
  include 'includes/discounts_modal.php';
  ?>

  <script>
    document.getElementById('adddiscount').addEventListener('click',
      function() {
        document.querySelector('.bg-modal-addDiscount').style.display = 'flex';

      });

    function deleteDiscount(discountID) {
      var result = confirm("Are you sure you would like to DELETE this discount code?");
      if (result) {
        window.location = "discounts_delete.php?id=" + discountID;
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