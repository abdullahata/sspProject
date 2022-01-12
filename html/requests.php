<?php
require_once 'login.php';
echo "<script src='../js/checkboxes.js'></script>";
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}

if (isset($_POST['approvedAdmins'])){
    $flag=0;
    $approvedAdmins=$_POST['approvedAdmins'];
      for ($x = 0; $x < count($approvedAdmins); $x++) {
    $query  = "update Admins set approved='1' WHERE adminID='$approvedAdmins[$x]'";
    $result = $conn->query($query);
    if (!$result) {echo "Update failed: $query<br>";$flag=0;}
    else {$flag=1;}
      }
}
     $query  = " SELECT adminID, username FROM Admins where approved=0;";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows = $result->num_rows;
    

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
    <label for="" id="addlabel">Admin Requests</label><br><br>
_END;
    if(isset($_POST['approvedAdmins'])){
    if ($flag=1){
     echo'<div id="errorMsg">Admin(s) Approved</div>';}
     else{
         echo'<div id="errorMsg">Admin(s) Approved</div>';
     }
    }
echo<<<_END
<form action="requests.php" method="post">
       <table id ="results">
    <tr>
    <td> <input type="checkbox" name="deleteall" id="deleteAllBox" value="" onclick="check_all2()"> </td>
    <th>ID</th>
    <th>Username</th>
  </tr>
_END;
           for ($j = 0 ; $j < $rows ; ++$j)
        {
          $result->data_seek($j);
          $row = $result->fetch_array(MYSQLI_NUM);
          echo<<<_END
            <tr>
            <td> <input type="checkbox" name="approvedAdmins[]" value="$row[0]"> </td>
            <td>$row[0]</td>
            <td>$row[1]</td>
            </tr>
_END;
}//end for loop
echo<<<_END
            </table>
            <br><br>
                 <input type="submit" value="Approve">
</form>

          </div>
        </div>
      </body>
    </html>
_END;
          $result->close();
          $conn->close();

?>