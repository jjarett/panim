<!DOCTYPE html>
<html>

<style>
    /*for add deli modal */
    .bg-modal-addDelivery {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;
    }

    .modal-content-addDelivery {
        width: 1000px;
        height: 250px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }



</style>

<body>
    <!-- add product -->

    <div class="bg-modal-addDelivery">

        <div class="modal-content-addDelivery">
            <form class="form-horizontal" method="POST" action="deliveries_add.php" id="addform" enctype="multipart/form-data">

                <div class="form-group">
                    <br>

                    <label for="order_id" class="col-sm-2 control-label">Order ID</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="order_id" name="order_id" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="courier_used" class="col-sm-2 control-label">Courier Used</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="courier_used" name="courier_used" required>
                    </div>


                    <label for="delivery_fee" class="col-sm-2 control-label">Delivery Fee</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="delivery_fee" name="delivery_fee" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tracking_no" class="col-sm-2 control-label">Tracking No</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tracking_no" name="tracking_no" required>
                    </div>

                </div>

                </form>
                <div class="modal-footer">
                    <a href="deliveries.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                    <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
                </div>
            
        </div>
    </div>



</body>

</html>