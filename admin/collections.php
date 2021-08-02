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
          Collections
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Collections</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
              <?php
                      if($_SESSION['role'] == 'Manager'){
                      echo "<a href='#' class='btn btn-primary btn-sm btn-flat' id='addcollection' ><i class='fa fa-plus'></i> New</a>";
                      }
                      ?>
                <div class="pull-right">
                                    <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                                </div>
                <div class="box-body">
                  <table id="collections-table" class="table table-bordered">
                    <thead>
                      <th>Collection ID</th>
                      <th>Collection Name</th>
                      <th>Description</th>
                      <th>Collection Image </th>
                      <th>Homepage</th>
                      <?php
                      if($_SESSION['role'] == 'Manager'){
                      echo "<th>Tools</th>";
                      }
                      ?>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM collections";
                      $result = mysqli_query($con, $query);

                      

                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No Collections Found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {
                          $image = (!empty($row['image'])) ? '../images/' . $row['image'] : '../images/noimage.jpg';
                          if($row['homepage'] == 0){
                            $homepage = 'Disabled';
                          }
                          else{
                            $homepage = 'Enabled';
                          }

                                                      echo "
                            <tr>
                            <td style='width:120px'>" . $row['collection_id'] . "</td>
                            <td style='width:150px'>" . $row['collection_name'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td style='width:120px'>
                              <img src='" . $image . "' height='40px' width='40px'>
                            </td>
                            <td style='width:100px'>" . $homepage . "</td>";

                            if($_SESSION['role'] == 'Manager'){
                            echo "<td style='width:150px'>
                            <a href ='collections_edit.php?id=".$row['collection_id']."'><button class='btn btn-success btn-sm editCollectBtn btn-flat' data-id='" . $row['collection_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                              <button onclick='deleteCollection(".$row['collection_id'].")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['collection_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>";
                            }
                          echo" </tr>
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
include 'includes/collection_modal.php';
?>

<script>

document.getElementById('addcollection').addEventListener('click',
function(){
  document.querySelector('.bg-modal-addCollection').style.display = 'flex';

});

function deleteCollection(collectionID){
  var result = confirm("Are you sure you would like to DELETE this collection?");
  if(result){
    window.location = "collections_delete.php?id="+collectionID;
  }
}

function searchFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("collections-table");
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