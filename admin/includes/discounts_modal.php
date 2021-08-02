<!DOCTYPE html>
<html>

<style>
    /*for add collection modal */
    .bg-modal-addDiscount {
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

    .modal-content-addDiscount {
        width: 800px;
        height: 300px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }
</style>

<body>
    <!-- add collection -->

    <div class="bg-modal-addDiscount">

        <div class="modal-content-addDiscount">
            <form class="form-horizontal" method="POST" action="discounts_add.php" id="addform" enctype="multipart/form-data">

                <div class="form-group">
                    <br>
                    <label for="discountcode" class="col-sm-2 control-label">Discount Code</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="discountcode" name="discountcode" required>
                    </div>

                </div>

                <div class="form-group">
                    <label for="discountpercentage" class="col-sm-2 control-label">Discount Percentage</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="discountpercentage" name="discountpercentage" required>
                    </div>
                    

                </div>

                <div class="form-group">
                    <label for="minspend" class="col-sm-2 control-label">Min Spend</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="minspend" name="minspend" required>
                    </div>
                    

                </div>
            </form>
            <div class="modal-footer">
                <a href="discountcodes.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
            </div>

        </div>
    </div>



</body>

</html>