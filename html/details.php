<?php
require_once 'login.php';
if (isset($_POST['ID']))
 {
      $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}
     $ID=$_POST['ID'];
     $query  = " SELECT * FROM places where id=$ID;"; 
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;

$row = $result->fetch_array(MYSQLI_NUM);
echo<<<_END
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/theme.css">
    <title></title>
  </head>
  <body>
    <div class="main">
      <div class="content">
      <table id ="detailsTable">
      <tr>
    <th colspan="2">$row[1]</th>
  </tr>
  <tr>
    <td colspan="2">
_END;
  $query  = "SELECT imgPath FROM places where id=$ID";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
  $rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j){
$result->data_seek($j);    
echo '  <img id = "detailsImg" src="data:image/jpeg;base64,'.base64_encode( $result->fetch_assoc()["imgPath"]). '">';
}
echo<<<_END
    </td>
  </tr>
  <tr>
    <td><h1>City</h1> <div> $row[2]</div> </td><td><h1> Natural of the place</h1>  <div>$row[4]</div></td>
  </tr>
  <tr>
    <td><h1>Best season to visit</h1> <div> $row[3]</div> </td><td> <h1>Entry fees</h1> <div>$row[5]</div></td>
  </tr>
 </table>
          </div>
        </div>
      </body>
    </html>
_END;
          $result->close();
          $conn->close();
}
?>
