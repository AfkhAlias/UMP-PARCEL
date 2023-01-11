<?php

include("controlgoods.php");


$query = "UPDATE goods SET GoodsStatus='Received' WHERE GoodsID='" . $_GET["GoodsID"] . "'";
     
	 if (mysqli_query($conn, $query)) {
      
   echo "<script type='text/javascript'> window.location='goodsinfo.php' </script>";
	
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}




?>