<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="goods.css">
    </head>
      <body>
        <img src="parcellogo.png" alt="Logo" width="600">
        <nav id="barlist">
          <div class="topnav">
              <a class="active">Goods List</a>
              <a href="recepientreport.php">Report</a> 
            <div class="topnav-right">
              <a href="complaint.php">Complaint</a>
              <a href="logout.php">Log out</a>
            </div>
        </div>
       </nav>
         
        <div class="total">
        <?php 
          include("controlgoods.php");
					$sql = "SELECT COUNT(GoodsStatus) as active FROM goods WHERE GoodsStatus='Arrived' OR GoodsStatus='Collected' ";
					$active = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($active);
          echo" <table style='width:100%;'>";
          echo  "<tr><th style='background-color:gray;text-align: center; font-size: 50px;'>" . $row['active']. "</th>";
  
          $sql = "SELECT COUNT(GoodsStatus) as received FROM goods WHERE GoodsStatus='Received' ";
					$receive = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($receive);
          echo" <div class='total'>";
          echo  "<th style='background-color:gray;text-align: center;font-size: 50px;'>".$row['received']."</th></tr>";
          echo "<tr><td style='text-align: center';> active parcel ";
          echo" <td style='text-align: center';>received parcel</td></tr><br>";
        ?>
        </div>
        <br>
        <h1 style="text-align: center; font-size: 50px; margin: 5px 50px 20px 100px;">Goods</h1>
   <?php

   $mysqli =  NEW Mysqli ('localhost', 'root', '', 'multi_users');

    if(isset($_GET['order'])){
        $order = $_GET['order'];
    }else{
        $order = 'GoodsStatus';
    }
    
     if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }else{
        $sort = 'ASC';
    }

    $resultset = $mysqli-> query("SELECT * FROM goods ORDER BY $order $sort");

    if($resultset-> num_rows> 0){
        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
        echo"

        <table style='width:100%;' >
          <tr>
            <th>Goods ID</th>
            <th>Goods Type</th>
            <th><a href='?order=GoodsArrivedDate&&sort=$sort'>Date Arrived</a></th>
            <th>Date Collected</th>
            <th>Date Received</th>
            <th><a href='?order=GoodsStatus&&sort=$sort'>Status</a></th>
          </tr>

        ";
        while($row = $resultset->fetch_assoc())
          {
            $GoodsID = $row['GoodsID'];
            $GoodsType = $row['GoodsType'];
            $GoodsArrivedDate = $row['GoodsArrivedDate']; 
            $GoodsCollectedDate = $row['GoodsCollectedDate']; 
            $GoodsReceivedDate = $row['GoodsReceivedDate'];
            $GoodsStatus = $row['GoodsStatus'];

            echo"
            <tr>
            <td>$GoodsID</td>
            <td>$GoodsType</td>
            <td>$GoodsArrivedDate</td>
            <td>$GoodsCollectedDate</td>
            <td>$GoodsReceivedDate</td>
            <td>$GoodsStatus</td>
            <td><a href='updatestatus.php?id=".$row['GoodsID']."'><img src='receiveicon.png' alt='Update' style='width: 45px;'></a></td>
            <td><a href='delete.php?id=".$row['GoodsID']."'><img src='deleteicon.png' alt='Delete'></a></td>
            
           ";
          }
          echo"</tr>
            </table>";
    }else{
        echo"No records returned.";
    }  
    ?>

      </body>
</html>