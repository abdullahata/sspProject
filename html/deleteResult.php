<?php
require_once 'login.php';
echo "<script src='../js/checkboxes.js'></script>";
echo "<script src='../js/delete.js'></script>";
if (isset($_POST['Name']) || isset($_POST['city'])||isset($_POST['season'])||isset($_POST['nature'])||isset($_POST['entry']))
 {
      $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}
     $name=$_POST['Name'];
     $city=$_POST['city'];;
     $season=$_POST['season'];
     $nature=$_POST['nature'];
     $entry=0;
    if (isset($_POST['entry'])){
  if ($city=='All'){ 
              if ($season=='Any'){
                  if ($nature=='Any'){
                        $query  = " SELECT * FROM places where (Entry='$entry')And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry='$entry') and (nature='$nature')And (name like '%$name%');";
                  }/*nature=true*/
              }
              else {/*season=true*/
                  if ($nature=='Any'){
                      $query  = " SELECT * FROM places where (Entry='$entry') and (season='$season')And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry='$entry') and (nature='$nature') and (season='$season')And (name like '%$name%');";
                  }
              }
          }
          else {/*city=true*/
              
                if ($season=='Any'){
                  if ($nature=='Any'){
                        $query  = " SELECT * FROM places where (Entry='$entry')and city='$city'And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry='$entry') and (nature='$nature')and (city='$city'And (name like '%$name%'));";
                  }/*nature=true*/
              }
              else {/*season=true*/
                  if ($nature=='Any'){
                      $query  = " SELECT * FROM places where (Entry='$entry') and (season='$season') and (city='$city'And (name like '%$name%') );";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry='$entry') and (nature='$nature') and (season='$season') and (city='$city')And (name like '%$name%');";
                  }
              }
              
              
          }
          
      }
      
    else {
        if ($city=='All'){ 
              if ($season=='Any'){
                  if ($nature=='Any'){
                        $query  = " SELECT * FROM places where (Entry>='$entry')And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (nature='$nature')And (name like '%$name%');";
                  }/*nature=true*/
              }
              else {/*season=true*/
                  if ($nature=='Any'){
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (season='$season')And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (nature='$nature') and (season='$season')And (name like '%$name%');";
                  }
              }
          }
          else {/*city=true*/
              
                if ($season=='Any'){
                  if ($nature=='Any'){
                        $query  = " SELECT * FROM places where (Entry>='$entry')and city='$city'And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (nature='$nature')and (city='$city')And (name like '%$name%');";
                  }/*nature=true*/
              }
              else {/*season=true*/
                  if ($nature=='Any'){
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (season='$season') and (city='$city')And (name like '%$name%');";
                  }
                  else{
                      $query  = " SELECT * FROM places where (Entry>='$entry') and (nature='$nature') and (season='$season') and (city='$city')And (name like '%$name%');";
                  }
              }
              
              
          }
    }
 
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;
}

if (isset($_POST['deleteboxes'])){
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}
    $deleteboxes=$_POST['deleteboxes'];
      for ($x = 0; $x < count($deleteboxes); $x++) {
    $query  = "DELETE FROM places WHERE id='$deleteboxes[$x]'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed: $query<br>" .    $rows = $result->num_rows;
      }
  	if (!$result) echo "DELETE failed: $query<br>" .
    $rows = $result->num_rows;
echo<<<_END
<form  id="deleted" action="deleteSearch.php" method="post">
  <input type="text" name="deleted" value="" hidden>
</form>
<script>
  var x = document.getElementById('deleted');
  x.submit();
</script>
_END;
}
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
<form action="deleteResult.php" method="post">
       <table id ="results">
    <tr>
    <td> <input type="checkbox" name="deleteall" id="deleteAllBox" value="" onclick="check_all()"> </td>
    <th>Name</th>
    <th>City</th>
    <th>Season</th>
    <th>The nature of the place</th>
    <th>Entry fees</th>
    <th></th>
  </tr>
_END;

           for ($j = 0 ; $j < $rows ; ++$j)
        {
          $result->data_seek($j);
          $row = $result->fetch_array(MYSQLI_NUM);
          echo<<<_END
            <tr>
            <td> <input type="checkbox" name="deleteboxes[]" value="$row[0]"> </td>
            <td>$row[1]</td>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
            <td><button type="button" class ="detailsBtn" name="button" onclick="viewDetails($row[0])">More details</button></td>
            </tr>
_END;
    
}//end for loop
echo<<<_END
            </table>
            <br><br>
             <input type="submit" value="Delete">
</form>

          </div>
        </div>
      </body>
    </html>
_END;
          $conn->close();
?>
