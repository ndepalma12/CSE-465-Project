<html>
<body bgcolor = "#00FFFF">
<?php


echo '<form action="login.php" method="post"><input type="hidden" name="ac" value="log"> ';
echo 'Username: <input type="text" name="Name" />';
echo 'Password: <input type="password" name="Password" />';
echo '<input type="submit" value="Login" />';
echo '</form>';

//echo $_SESSION['login_cred'];

?>
</body>
</html>