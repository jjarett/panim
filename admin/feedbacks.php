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
                    Feedbacks
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Feedbacks</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                                </div>

                                <div class="box-body">
                                    <br>&nbsp;<br>
                                    <table id="feedbacks-table" class="table table-bordered">
                                        <thead>
                                            <th>Feedback ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Description</th>
                                            <?php 
                                            if($_SESSION['role'] == 'Manager'){
                                            ?>
                                            <th>Tools</th>
                                            <?php
                                            }
                                            ?>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $query = "SELECT * FROM feedback";
                                            $result = mysqli_query($con, $query);



                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<p>No Feedback Found.</p>";
                                            } else {
                                                while ($row = mysqli_fetch_array($result)) {

                                                    echo "
                            <tr>
                            <td style='width:120px'>" . $row['feedback_id'] . "</td>
                            <td style='width:150px'>" . $row['name'] . "</td>
                            <td style='width:150px'>" . $row['email'] . "</td>
                            <td style='width:150px'>" . $row['phone_number'] . "</td>
                            <td style='width:150px'>" . $row['description'] . "</td>";
                                                    if ($_SESSION['role'] == 'Manager') {
                                                        echo " <td style='width:150px'>
                              <button onclick='deleteFeedback(" . $row['feedback_id'] . ")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['feedback_id'] . "'><i class='fa fa-trash'></i> Delete</button>
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
    <script>
        function deleteFeedback(feedbackID) {
            var result = confirm("Are you sure you would like to DELETE this feedback?");
            if (result) {
                window.location = "feedbacks_delete.php?id=" + feedbackID;
            }
        }

        function searchFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("customers-table");
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