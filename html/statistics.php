<?php
require_once 'login.php';
      $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}
     $query  = " SELECT * FROM vistitSta;"; 
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;
    $row = $result->fetch_array(MYSQLI_NUM);
echo<<<_END
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data_val = google.visualization.arrayToDataTable([
	 ['Place name', 'Visitors'],
_END;
       for ($j = 0 ; $j < $rows ; ++$j)
        {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
       echo"['$row[1]',$row[2]],";
        }
        
echo<<<_END
 ]);

 var options_val = {
  width: 800,
  height: 450,
 title: 'Most visited places at 2019'
 };
 var chart_val = new google.visualization.PieChart(document.getElementById("piechart"));
 chart_val.draw(data_val, options_val);
 }
</script>
_END;
echo<<<_END
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/theme.css">
    <title></title>
  </head>
  <body>
    <div class="main">
   <table id="header">
  <tr>
    <th> <a href="Add.php">Add Place</a> </th>   </tr>
    <tr>
    <th> <a href="editSearch.php">Edit place</a> </th> </tr>
    <tr>
    <th> <a href="deleteSearch.php">Delete place</a> </th> </tr> 
    <tr>
    <th> <a href="requests.php">Admin requests</a> </th>
    <tr>
    <th> <a href="statistics.php">Statistics</a></th> 
  </tr>
</table>
      <div class="content">
     <label for="" id="addlabel">Jordanian tourism statistics</label><br><br>

     <div id="piechart"></div>
     <h2 style="color:red;font-size:14;">*this information based on real information according to the Ministry Of Tourism And Antiquities</h2>
          </div>
        </div>
      </body>
    </html>
_END;
          $result->close();
          $conn->close();
       ?>
