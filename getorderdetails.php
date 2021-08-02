<?php 
    $order_id = $_GET['id'];

    $con = mysqli_connect("localhost", "admin", null, "pganim");
     $query = "SELECT * FROM cust_orders WHERE order_id ='$order_id' ";
     $result = mysqli_query($con, $query);
     $output ="";

    while ($row = mysqli_fetch_array($result)) {

        $productID2Name = $row['product_id'];
        $query2 = "SELECT * FROM products WHERE product_id = $productID2Name";
        $result2 = mysqli_query($con, $query2);

        foreach ($result2 as $product) {
            $productName = $product['product_name'];
          }

        $output .= "<tr>
        <td style='width:120px'>" . $productName . "</td>
        <td style='width:120px'>" . $row['quantity'] . "</td>
       </tr>"." ";

        
     }

     echo json_encode($output);
?>