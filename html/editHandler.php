<?php
require_once 'login.php';
if (isset($_POST['edit'])){
echo <<<_END
<form id="edited" action="editSearch.php" method="post" hidden>
<input type="text" name="editTrue" value="" hidden>
</form>
<form id="empty" action="editSearch.php" method="post" hidden>
<input type="text" name="empty" value=""hidden>
</form>
_END;
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error){die($conn->connect_error);}

if (isset($_POST['Name']) && isset($_POST['city']) && isset($_POST['season']) && isset($_POST['nature']) && isset($_POST['entry'])&&$_POST['Name']!=null && $_POST['entry']!=null)
 {

    $id=$_POST['id'];
    $name  = $_POST['Name'];
     $city  = $_POST['city'];
     $season  = $_POST['season'];
     $nature  = $_POST['nature'];
     $entry  = $_POST['entry'];
    $query  = "UPDATE places SET name='$name',city='$city',season='$season',nature='$nature',entry='$entry' where id=$id;"; 
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    else {
echo<<<_END
        <script>
document.getElementById('edited').submit();
</script>
_END;
    }
    $conn->close();
}
else {
echo<<<_END
        <script>
document.getElementById('empty').submit();
</script>
_END;
}
}
?>