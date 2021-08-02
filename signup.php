<!DOCTYPE html>
<?php
session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");

error_reporting(0);

if (isset($_POST['signup'])) {
    $firstName = $_POST['sFirstName'];
    $lastName = $_POST['sLastName'];
    $email = $_POST['sEmail'];
    $password = md5($_POST['sPassword']);
    $phone = $_POST['sPhoneNumber'];
    $address = $_POST['sAddress'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

    $query = "select * from customers where email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<script>alert('Email already exists.')</script>";
    } else {

        $getCustIdQuery = "select max(customer_id) FROM customers";
        $resultCount = mysqli_query($con, $getCustIdQuery);
        while ($custIdResult = mysqli_fetch_array($resultCount)) {
            $custId = $custIdResult["max(customer_id)"] + 1;
        }

        $insertQuery = "INSERT INTO customers values ('$custId', '$firstName', '$lastName', '$email', '$password', '$phone', '$address', '$createdAt', '$updatedAt')";
        $insertResult = mysqli_query($con, $insertQuery);
        if ($insertResult) {
            echo "<script language='javascript'>window.alert('Signed up successfully.');window.location='login.php';</script>";

        } else {
            echo "<script>alert('Sign up failed, please try again.')</script>";
        }
    }
}
?>
<html>
<?php
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
            <form action="" method="post">
                <div style="width: 100%; padding-top: 20px; padding-bottom: 20px; text-align: center;">
                    <span style="font-size: 24px;">Sign Up</span>
                </div>
                <table style="font-size: 20px; margin-left: auto; margin-right: auto;">
                    <tr>
                        <td style="padding-left: 5px;">
                            First Name
                        </td>
                        <td style="padding-left: 35px;">
                            Last Name
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 300px;">
                            <input style="width: 100%; height: 30px;" type="text" id="sFirstName" name="sFirstName" placeholder="First Name..." required>
                        </td>
                        <td style="width: 300px; padding-left: 30px;">
                            <input style="width: 100%; height: 30px;" type="text" id="sLastName" name="sLastName" placeholder="Last Name..." required>
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
                            <input style="width: 100%; height: 30px;" type="text" id="sEmail" name="sEmail" placeholder="Email..." required>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">
                            Password
                        </td>
                        <td style="padding-left: 35px;">
                            Phone Number
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input style="width: 100%; height: 30px;" type="password" id="sPassword" name="sPassword" placeholder="Password..." required>
                        </td>
                        <td style="padding-left: 30px;">
                            <input style="width: 100%; height: 30px;" type="text" id="sPhoneNumber" name="sPhoneNumber" placeholder="Phone Number..." required>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">
                            Address
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea style="width: 100%; height: 60px; resize: none;" type="text" id="sAddress" name="sAddress" placeholder="Address..." required></textarea>
                        </td>
                    </tr>

                </table>
                <div style="width: 100%; padding-top: 40px; padding-bottom: 20px; text-align: center;">
                    <button name="signup" style="border: none; background-color: #4BB7D4; color: white; padding: 10px 50px; font-size: 18px; cursor: pointer;">SIGN UP</button>
                </div>
            </form>
            <div style="width: 100%; text-align: center;">
                <span style="font-size: 18px;">ALREADY HAVE AN ACCOUNT?<a href="login.php">LOGIN HERE</a></span>
            </div>
        </div>








        <!-- END HERE -->
    </div>



    <!--Get footer -->
    <?php
    include 'footer.php';
    ?>

</body>

</html>