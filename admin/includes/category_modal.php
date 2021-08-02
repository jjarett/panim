<!DOCTYPE html>
<html>

<style>
    /*for add category modal */
    .bg-modal-addCategory {
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

    .modal-content-addCategory {
        width: 1000px;
        height: 200px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }



</style>

<body>
    <!-- add category -->

    <div class="bg-modal-addCategory">

        <div class="modal-content-addCategory">
            <form class="form-horizontal" method="POST" action="category_add.php" id="addform" enctype="multipart/form-data">


                <div class="form-group">
                    <br>
                    <label for="categoryname" class="col-sm-2 control-label">Category Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="categoryname" name="categoryname" required>
                    </div>
                
                </div>

                </form>
                <div class="modal-footer">
                    <a href="category.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                    <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
                </div>
            
        </div>
    </div>



</body>

</html>