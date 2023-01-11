
<?php
include("controlgoods.php");
$query = "DELETE FROM goods WHERE GoodsID='" . $_GET["GoodsID"] . "'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in Goodsinfo.php");

if($result){
echo "<script type= 'text/javascript'> window.location='Goodsinfo.php'</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);

?>
