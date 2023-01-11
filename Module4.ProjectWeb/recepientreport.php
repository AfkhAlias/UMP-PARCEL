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
              <a href="Goodsinfo.php">Goods List</a>
              <a class="active">Report</a> 
            <div class="topnav-right">
              <a href="complaint.php">Complaint</a>
              <a href="logout.php">Log out</a>
            </div>
        </div>
       </nav>
        <?php
          include("controlgoods.php"); 
          $sql = "SELECT GoodsStatus, count(*) as number FROM Goods GROUP BY GoodsStatus";  
          $result = mysqli_query($conn, $sql);  
        ?>
        <div class ="sidenav">
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
          <script type="text/javascript">  
          
          google.charts.load('current', {'packages':['corechart']});  
          google.charts.setOnLoadCallback(drawChart);  
          function drawChart()  
          {  
               var data = google.visualization.arrayToDataTable([  
                         ['GoodsStatus', 'number'],  
                         <?php  
                         while($row = mysqli_fetch_array($result))  
                         {  
                              echo "['".$row["GoodsStatus"]."', ".$row["number"]."],";  
                         }  
                         ?>  
                    ]);  
               var options = {  
                     title: 'Pie Chart of Parcel received',    
                    };  
               var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
               chart.draw(data, options);  
          }  
          </script>  
     </head>  
     <body>  
          <div style="width:800px;margin: 5px 50px 20px 100px;">  
               <div id="piechart" style="width: 1200px; height: 900px; align:center;"></div>  
          </div>  
    </div>
      </body>
 </html>
