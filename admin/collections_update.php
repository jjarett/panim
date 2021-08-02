<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $cid = $_POST['collection_id'];
    $collectionName = $_POST['collection_name'];
    $description = $_POST['description'];
    $filename = $_FILES['photo']['name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    if($_POST['homepage'] == 'on'){
        $homepage = 1;
    }
    else{
        $homepage = 0;
    }
    
    
    if (!empty($filename)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfilename = preg_replace('/[^a-zA-Z0-9\']/', '-', $collectionName);
        $newfilename = str_replace("'", '', $newfilename);
        $new_filename = $newfilename . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $new_filename);
    } else {
        $new_filename = $_POST['photoName'];
    }
    
    $queryUpdate="update collections set collection_name='$collectionName', image='$new_filename', description='$description', homepage='$homepage', updated_at='$updatedAt' where collection_id='$cid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

   header('location: collections.php');

}

?>