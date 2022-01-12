<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
 if (isset($_POST['Name']) && isset($_POST['city'])&&isset($_POST['season'])&&isset($_POST['nature'])&&isset($_POST['entry'])&&isset($_FILES['image']))
    {

     $name  = $_POST['Name'];
     $city  = $_POST['city'];
     $season  = $_POST['season'];
     $nature  = $_POST['nature'];
     $entry  = $_POST['entry'];
    try {
            $msg= upload($name,$city,$season,$nature,$entry,$conn); 
            echo $msg;  
          }
    catch(Exception $e) {
    echo $e->getMessage();
    echo 'Sorry, could not upload file';
    } 
}
$result;
function upload($name,$city,$season,$nature,$entry,$conn) {
$maxsize = 10000000; 
if($_FILES['image']['error']==UPLOAD_ERR_OK) {
 if(is_uploaded_file($_FILES['image']['tmp_name'])) {  
if( $_FILES['image']['size'] < $maxsize) {
              $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['image']['tmp_name']),"image")===0) {
$imgData =addslashes (file_get_contents($_FILES['image']['tmp_name']));
$query    = "INSERT INTO places  (Name, City, Season, Nature, Entry,imgPath) VALUES('$name', '$city', '$season','$nature','$entry','$imgData')";
$GLOBALS['result'] = $conn->query($query);
}

}
}
}
}

echo<<<_END
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/theme.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
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

<div class="main">
<div class="content">
<label for="" id="addlabel">Add new Place</label><br><br>
_END;
if (isset($_POST['added'])){
    echo<<<_END
    <div id="errorMsg">Added successfuly</div>
_END;
}

if (isset($_POST['addedFalse'])){
    echo<<<_END
    <div id="errorMsg">Faild to Add the place</div>
_END;
}

if (isset($_POST['checkedF'])){
    echo<<<_END
    <div id="errorMsg">All the filed should be not empty</div>
_END;
}

echo<<<_END
<form action="Add.php" method="post"  enctype="multipart/form-data">
  <label for="Name">Name:</label>

<input type="text" name="Name" value="" placeholder="______________________________________________________">
<br><br>

<table>
  <tr>
    <td><label for="city">City:</label></td>
    <td><select id="city" name="city">
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
      <option value="Natural places">Natural places</option>
      <option value="Historical places">Historical places</option>
      <option value="Religious places">Religious places</option>
      <option value="Museums">Museums</option>
    </select>
  </td>
    </tr>
    
    <tr>
  <td>
    <label for="">Free Entry</label>
  </td>
  <td>
    <input type="number" id="addEntry" name="entry" value="">
  </td>
    </tr>
<tr>
  <td>
    <label for="">Image</label>
  </td>
  <td>
<input name ="image" type="file" accept="image/*" />
</td>
    </tr>
</table>
<br><br>
<button type="submit" name="submin">Add</button>
</form>
<form id="AddedForm" action="Add.php" method="post" hidden>
  <input type="text" name="added" value="">
 <button type="submit" name="submitAdded"></button>
</form>
<form id="AddedFalse" action="Add.php" method="post" hidden>
  <input type="text" name="addedFalse" value="">
 <button type="submit" name="submitAdded"></button>
</form>
_END;
if (isset($_POST['Name']) && isset($_POST['city'])&&isset($_POST['season'])&&isset($_POST['nature'])&&isset($_POST['entry'])&&isset($_FILES['image'])){
if ($result){
echo<<<_END
</div>
</div>
<script> 
    document.getElementById("AddedForm").submit();
</script>
  </body>
</html>
_END;
}
else {
echo<<<_END
</div>
</div>
<script> 
   document.getElementById("AddedFalse").submit();
</script>
  </body>
</html>
_END;
}
}
$conn->close();
?>