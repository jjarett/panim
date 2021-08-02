<!DOCTYPE html>
<html>

<style>
    /*for add prod modal */
    .bg-modal-add {
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

    .modal-content-add {
        width: 1000px;
        height: 500px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }



</style>

<body>
    <!-- add product -->

    <div class="bg-modal-add">

        <div class="modal-content-add">
            <form class="form-horizontal" method="POST" action="products_add.php" id="addform" enctype="multipart/form-data">

                <?php

                $con = mysqli_connect("localhost", "admin", null, "pganim");
                $query = "SELECT * FROM collections";
                $result = mysqli_query($con, $query);

                $queryCat = "SELECT * FROM categories";
                $resultCat = mysqli_query($con, $queryCat);

                ?>

                <div class="form-group">
                    <br>
                    <label for="pname" class="col-sm-1 control-label">Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="pname" name="pname" required>
                    </div>

                    <label for="pcat" class="col-sm-1 control-label">Category</label>

                    <div class="col-sm-5">
                    <select class="form-control" id="pcat" name="pcat" required>
                            <option value="" selected>- Select -</option>
                            <?php
                            foreach ($resultCat as $category) {
                                echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>


                </div>

                <div class="form-group">
                    <label for="pcollection" class="col-sm-1 control-label">Collection</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="pcollection" name="pcollection" required>
                            <option value="" selected>- Select -</option>
                            <?php
                            foreach ($result as $collection) {
                                echo "<option value='" . $collection['collection_id'] . "'>" . $collection['collection_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <label for="pstock" class="col-sm-1 control-label">Stock</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="pstock" name="pstock" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pprice" class="col-sm-1 control-label">Price</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="pprice" name="pprice" required>
                    </div>

                    <label for="photo" class="col-sm-1 control-label">Photo</label>

                    <div class="col-sm-5">
                        <input type="file" id="photo" name="photo">
                    </div>
                </div>

                <div class="form-group">
                    <label for="pdesc" class="col-sm-1 control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea name="pdesc" rows="10" cols="130" required></textarea>
                    </div>

                </div>
                </form>
                <div class="modal-footer">
                    <a href="products.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                    <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
                </div>
            
        </div>
    </div>



</body>

</html>