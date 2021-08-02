<?php
session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");

$fname = $_POST['fname'];
$femail = $_POST['femail'];
$fphoneNumber = $_POST['fphoneNumber'];
$fdescription = $_POST['fdescription'];

date_default_timezone_set("Asia/Kuala_Lumpur");
$createdAt =  date('Y-m-d H:i:s');
$updatedAt =  date('Y-m-d H:i:s');

$queryFeedbacksCount = "SELECT max(feedback_id) FROM feedback";
$ResultFeedbacksCount = mysqli_query($con, $queryFeedbacksCount);
while ($row = mysqli_fetch_array($ResultFeedbacksCount)) {
    $fid = $row["max(feedback_id)"] + 1;
}

$queryAddFeedback = "INSERT INTO feedback VALUES ('$fid', '$fname', '$femail', '$fphoneNumber', '$fdescription', '$createdAt', '$updatedAt')";
$resultAddFeedback = mysqli_query($con, $queryAddFeedback);

mysqli_close($con);

echo '<script>
alert("Thank you for your feedback!");
window.location.href="home.php";
</script>';

?>