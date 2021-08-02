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
        <div class="modal fade" id="AddressEditModal" tabindex="-1" aria-labelledby="AddressEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddressEditModalLabel">Update Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="address_update.php" id="accountform" enctype="multipart/form-data">

                            <?php
                            if (mysqli_num_rows($result) == 0) {
                                echo "<p>No Details Found.</p>";
                            } else {
                                while ($row = mysqli_fetch_array($result)) {
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