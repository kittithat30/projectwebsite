<?php

session_start();
require 'connect.php';

$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";

for ($i=0; $i < count($_SESSION['cart'] ); $i++) { 

    $productId = $_SESSION['cart'][$i];

    $getOldCount = "SELECT product_amount FROM products WHERE id = $productId";
    $result = mysql_query($getOldCount);

    $row = mysql_fetch_assoc($result);

    $oldCount = $row['product_amount'];
    $countDel = $_SESSION['qty'][$i];
    $newCount = $oldCount - $countDel;

    $sql = "UPDATE products SET product_amount = $newCount WHERE id = $productId";
    $queryData = mysql_query($sql);

    // $sql = "";

    // echo $newCount;
    // while($row = mysql_fetch_array($result) ){
    //     $oldCount = $row['product_amount'];

    //     $newCount = $oldCount - 3;

    //     echo $newCount;

    // }

}
//session_destroy();
//header('location:index.php');


// foreach($_SESSION['cart'] as $card) {
   
//     $sql = "SELECT product_amount,id FROM products  WHERE id =  $card ";

//     $result = mysql_query($sql);

//     for ($i=0; $i <= count($result); $i++) { 
//         echo $i;
//     }

//     while($row = mysql_fetch_array($result) ){
//         $oldCount = $row['product_amount'];

//         for ($x = 1; $x <= count($_SESSION['qty']); $x++) {

//             $newCount = $oldCount-$_SESSION['qty'][$x];

//             $sql = "UPDATE products SET product_amount = 5 WHERE  id = '".$row['id']."'";

//             echo $_SESSION['qty'][0];

//         }
//         echo $_SESSION['qty'][0];
//         foreach($_SESSION['qty'] as $qty) {
//             echo "Qty".$qty."<br />";

//             $sql = "SELECT product_amount FROM products  WHERE id =  $card ";

//         }

//     }

// }

$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";

if (!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
    $_SESSION['qty'][] = array();
}

$key = array_search($itemId, $_SESSION['cart']);
$_SESSION['qty'][$key] = "";

$_SESSION['cart'] = array_diff($_SESSION['cart'], array($itemId));
header('location:cart.php?a=remove');