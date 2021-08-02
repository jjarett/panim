<!DOCTYPE html>
<html>
<?php
session_start();
include 'header.php';
?>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>


    <!-- page wrapper class -->
    <div class="page-wrapper">

        <!-- START BELOW HERE -->

        <div class="quicksand-font" style="width: 100%;">
            <div style="width: 100%; padding-top: 20px; padding-bottom: 20px; text-align: center;">
                <span style="font-size: 24px;">Contact Us</span>
            </div>
            <div style="width: 100%; text-align:center; padding-bottom: 50px;">

                <?php
                if(isset($_POST['send'])){
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

                echo '<span style="font-size: 24px; color: #4BB543; ">Thank you! Your feedback has been submitted!</span>';
            }
                else{
                    echo '<span style="font-size: 18px;">If you have any issues or questions regarding your purchase from our site, please contact us with the form below. Thanks!</span>';
                }

                

                ?>
            </div>
            <form action="contactus.php" method="POST">
                <table style="margin-left: auto; margin-right: auto;">
                    <tr>
                        <td style="padding-left: 5px;">Name</td>
                        <td style="padding-left: 35px;">Phone Number</td>
                    </tr>
                    <tr>
                        <td style="width: 300px;">
                            <input style="width: 100%; height: 30px;" type="text" id="fname" name="fname" placeholder="Name..." required>
                        </td>
                        <td style="width: 300px; padding-left: 30px;">
                            <input style="width: 100%; height: 30px;" type="text" id="fphoneNumber" name="fphoneNumber" placeholder="Phone Number..." required>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">
                            Email
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input style="width: 100%; height: 30px;" type="text" id="femail" name="femail" placeholder="Email..." required>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">Message</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea style="width: 100%; height: 100px; resize: none;" type="text" id="fdescription" name="fdescription" placeholder="Your message / feedback..." required></textarea>
                        </td>
                    </tr>
                </table>
                <div style="width: 100%; padding-top: 40px; text-align: center;">
                    <button name="send" style="border: none; background-color: #4BB7D4; color: white; padding: 10px 30px; font-size: 18px; cursor: pointer;">SEND</button>
                </div>
            </form>
        </div>








        <!-- END HERE -->
    </div>



    <!--Get footer -->
    <?php
    include 'footer.php';
    ?>

</body>

</html>