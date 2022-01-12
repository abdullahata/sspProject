<?php
echo<<<_END
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/theme.css">
    <meta charset="utf-8">
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
<label for="" id="addlabel">Delete Place</label><br><br>
_END;
if (isset($_POST['deleted']))
 {
    echo"<div id='errorMsg'>Place(s) Deleted successfully</div>";

}
echo<<<_END
<form action="deleteResult.php" method="post">
  <label for="Name">Name:</label>
<input type="text" name="Name" value="" placeholder="________________________________________________________">
<br><br>

<table>
  <tr>
    <td><label for="city">City:</label></td>
    <td><select id="city" name="city">
      <option value="All">All</option>
      <option value="Amman">Amman</option>
      <option value="Irbid">Irbid</option>
      <option value="Ajloun">Ajloun</option>
      <option value="Jerash">Jerash</option>

      <option value="Mafraq">Mafraq</option>
      <option value="Balqa">Balqa</option>
      <option value="Zarqa">Zarqa</option>
      <option value="Madaba">Madaba</option>

      <option value="Karak">Karak</option>
      <option value="Tafilah">Tafilah</option>
      <option value="Maan">Maan</option>
      <option value="Aqaba">Aqaba</option>
    </select>
  </td>
  </tr>

  <tr>
    <td>  <label for="season">Best season to visit</label></td>
    <td>  <select id="season" name="season">
      <option value="Any">Any</option>
        <option value="Winter">Winter</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
        <option value="Autumn">Autumn</option>
      </select>
</td>
  </tr>
  <tr>
  <td>
    <label for="nature">Nature of the place</label>
  </td>
  <td>
    <select id="nature" name="nature">
      <option value="Any">Any</option>
      <option value="Natural places">Natural places</option>
      <option value="Historical places">Historical places</option>
      <option value="Religious places">Religious places</option>
      <option value="Museums">Museums</option>
    </select>
  </td>
    </tr>
</table>
<br><br>
<label for="">Free Entry</label>
<label class="switch">
  <input type="checkbox" name="entry">
  <span class="slider round"></span>
</label>
<br><br><br><br>
<button type="submit" name="submin">Search</button>
</form>

</div>
</div>
  </body>
</html>
_END;
?>