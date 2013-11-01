<html>
<body bgcolor = "#00FFFF">
<?php
session_start();
//if ( !extension_loaded('pam') && !extension_loaded('pam_auth') ) {
//        if ( !dl('pam.so' ) && !dl('pam_auth.so') )
 //               msg( "PHP PAM module cannot be loaded", -1);
//}

$u = $_POST["Name"];
$p = $_POST["Password"];
$_SESSION['login_cred'] = 0;
$_SESSION['user'] = 0;

if($u == "John" && $p == "abc") {
        $v=true;
} else {$v=false;}

if($v == true)
{
	$_SESSION['user'] = $u;
	$_SESSION['login_cred'] = $v;
	header('Location: dept.php');
	//echo $_SESSION["login_cred"];
}

else
	echo "Invalid attempt, please try again.";

?>
