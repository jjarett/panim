<!DOCTYPE html>
<html>

<body>
    <div class="quicksand-font">
        <?php
        $con = mysqli_connect("localhost", "admin", null, "pganim");


        $custid = $_SESSION['cust_id'];
        $query = "SELECT * FROM customers where customer_id = '$custid'";
        $result = mysqli_query($con, $query);

        ?>
        <!-- Modal -->
        <div class="modal fade" id="accountDetailsModal" tabindex="-1" aria-labelledby="accountDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountDetailsModalLabel">Edit Account Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="account_update.php" id="accountform" enctype="multipart/form-data">

                            <?php
                            if (mysqli_num_rows($result) == 0) {
                                echo "<p>No Details Found.</p>";
                            } else {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<div class="form-floating">';
                                    echo '<input type="text" class="form-control" id="modalFirstName" placeholder="First Name" name="fname" value="'.$row['first_name'].'" >';
                                    echo '<label for="modalFirstName">First Name</label>';
                                    echo '</div>';

                                    echo '<br>';
                                    echo '<div class="form-floating">';
                                    echo '<input type="text" class="form-control" id="modalLastName" placeholder="Last Name" name="lname" value="'.$row['last_name'].'" >';
                                    echo '<label for="modalLastName">Last Name</label>';
                                    echo '</div>';

                                    echo '<br>';
                                    echo '<div class="form-floating">';
                                    echo '<input type="email" class="form-control" id="modalEmail" placeholder="Email" name="email" value="'.$row['email'].'" >';
                                    echo '<label for="modalEmail">Email</label>';
                                    echo '</div>';

                                    echo '<br>';
                                    echo '<div class="form-floating">';
                                    echo '<input type="text" class="form-control" id="modalNumber" placeholder="Number" name="mobileno" value="'.$row['mobile_number'].'" >';
                                    echo '<label for="modalNumber">Phone Number</label>';
                                    echo '</div>';

                                    echo '<br>';
                                    echo '<div class="form-floating">';
                                    echo '<textarea class="form-control" placeholder="Address" id="modalAddress" name="address" style="height: 100px">'.$row['address'].'</textarea>';
                                    echo '<label for="modalAddress">Address</label>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="accountform" class="btn btn-primary" name="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>