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
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/theme.css">
    <script src='../js/checkboxes.js'></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<div class="main">
<div class="content">

<form action="editHandler.php" method="post">
  <label for="Name">Name:</label>
<input type="text" name="Name" value="$row[1]" placeholder="______________________________________________________">
<br><br>

<table>
  <tr>
    <td><label for="city">City:</label></td>
    <td><select id="city" name="city">
      <option  value="Amman">Amman</option>
      <option value="Irbid">Irbid</option>
      <option  value="Ajloun">Ajloun</option>
      <option  value="Jerash">Jerash</option>

      <option  value="Mafraq">Mafraq</option>
      <option  value="Balqa">Balqa</option>
      <option  value="Zarqa">Zarqa</option>
      <option  value="Madaba">Madaba</option>

      <option  value="Karak">Karak</option>
      <option  value="Tafilah">Tafilah</option>
      <option  value="Maan">Maan</option>
      <option  value="Aqaba">Aqaba</option>

    </select>
  </td>
  </tr>

  <tr>
    <td>  <label for="season">Best season to visit</label></td>
    <td>  <select id="season" name="season">
             <option id="Winter" value="Winter">Winter</option>
             <option id="Spring" value="Spring">Spring</option>
             <option id="Summer" value="Summer">Summer</option>
             <option id="Autumn" value="Autumn">Autumn</option>
      </select>
</td>
  </tr>
  <tr>
  <td>
    <label for="nature">Nature of the place</label>
  </td>
  <td>
    <select id="nature" name="nature" value="">
                <option id="Natural places" value="Natural places">Natural places</option>
                <option id="Historical places" value="Historical places">Historical places</option>
                <option id="Religious places" value="Religious places">Religious places</option>
                <option id="Museums" value="Museums">Museums</option>
    </select>
  </td>
    </tr>
      <tr>
  <td>
    <label for="">Free Entry</label>
  </td>
  <td>
    <input type="number" id="addEntry" name="entry" value="$row[5]">
  </td>
    </tr>
</table>
<br><br>
<input type="text" name="id" value="$row[0]" hidden>

<button type="submit" name="edit">Edit</button>


</form>
<script>
     checkCity('$row[2]');
     checkNature('$row[4]');
     checkSeason('$row[3]');
     </script>
</div>
</div>
  </body>
</html>
_END;
}
$result->close();
$conn->close();
?>