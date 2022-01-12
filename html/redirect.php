<?php

require_once 'login.php';

echo<<<_END
<form  id="error" action="LoginPage.php" method="post">
  <input type="text" name="ErrorDiv" value="" hidden>
</form>

<form  id="username" action="adminView.html" method="post">
</form>

<form  id="notApproved" action="notApproved.html" method="post">
</form>
_END;
if (isset($_POST['Name']) && isset($_POST['Password']))
 {
     $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){die($conn->connect_error);}
     $username=$_POST['Name'];
     $password=$_POST['Password'];;
     $query  = " SELECT * FROM Admins where  (username='$username')and(password='$password');";

    $result = $conn->query($query);
    if (!$result) {die ("window.location.href = 'CreateNew.html'" . $conn->error);}
    else {
        $rows = $result->num_rows;
         for ($j = 0 ; $j <= $rows ; ++$j)
        {
          $result->data_seek($j);
          $row = $result->fetch_array(MYSQLI_NUM);
if ($row[1]==$username && $row[2]==$password){
    if ($row[3]==1){
echo<<<_END
<script>
  var x = document.getElementById('username');
  x.submit();
</script>
_END;
}
else {
echo<<<_END
<script>
var x = document.getElementById('notApproved');
x.submit();
</script>
_END;
}
}
echo<<<_END
<script>
var x = document.getElementById('error');
x.submit();
</script>
_END;

}
        
}
$result->close();
$conn->close();     
}
?>