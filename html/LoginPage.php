<?php
require_once 'login.php';
 $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 if (isset($_POST['EID']) && isset($_POST['username'])&&isset($_POST['password']))
 {
     $EID   = $_POST['EID'];
     $username    = $_POST['username'];
     $password = $_POST['password'];
     $query    = "INSERT INTO Admins VALUES('$EID', '$username', '$password',0)";
     $result   = $conn->query($query);
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
<div class="main">
<div class="content">

<form action="redirect.php" method="post">
  <label for="Name">Username:</label>  
_END;
if (isset($_POST['EID']) && isset($_POST['username'])&&isset($_POST['password']))
 {	if (!$result) {echo "<div id='errorMsg'>Faild to Create account</div>";}
    else {
        echo "<div id='errorMsg'>Account created successfully</div>";
    }
       $conn->error . "<br><br>";
  
}
 if (isset($_POST['ErrorDiv']))
 {
    echo"<div id='errorMsg'>Wrong Username Or Password</div>";

}
echo<<<_END
<input type="text" name="Name" value="" placeholder="______________________________________________________">
<br><br>
<label for="Password">Password:</label>
<input type="password" name="Password" value="" placeholder="______________________________________________________">
<br><br>
<div id="buttons">
<button id="loginBtn" type="submit" name="submit">Login</button>
<br><br>
<button id="createBtn" type="button" name="Create" onclick="window.location.href = 'CreateNew.html'">Create new account</button>
</div>

</form>


</div>
</div>

  </body>
</html>
_END;
  $conn->close();
?>
