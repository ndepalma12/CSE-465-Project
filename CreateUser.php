<!DOCTYPE html>
<html> 
<head> 
<title>Create User</title> 
</head> 
<body> 

<?php
session_start();
?>

<form method="post" action="">
Username: <input type="text" size="12" maxlength="50" name="username"> <br />
Role: <select name="role">
		<option value=""></option>
		<option value="Manager">Manager</option>
		<option value="Intern">Intern</option>
		<option value="CEO">CEO</option>
		<option value="Assistant">Assistant</option>
		<option value="Employee">Employee</option> 
	</select><br />
Security Level: <select name="security">
		<option value=""></option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option> 
	</select><br />
Citizenship: <select name="citizenship">
		<option value=""></option>
		<option value="American">American</option>
		<option value="Canadian">Canadian</option>
		<option value="Mexican">Mexican</option>
		<option value="Japanese">Japanese</option>
		<option value="British">British</option>
		<option value="French">French</option>
		</select><br />

<p>
	Department: <select name="department" multiple>
			<option value="Accounting">Accounting</option>
			<option value="Sales">Sales</option>
			<option value="Marketing">Marketing</option>
			<option value="HumanResources">Human Resources</option>
			<option value="ITSupport ">IT Support</option> 
		</select> <p>
Hold down the Ctrl/Cmd key to select multiple options.
		<br />

	<input type="submit" name="Update">
	</form>

<?php

if (isset($_POST['Update'])) {
	if (!isset($_POST['department']) || !isset($_POST['role'])) {
		echo "please enter a department value";
		exit();
				
	} else {
		echo "all values exist";
	}


	$username=$_POST["username"];
	$department=$_POST["department"];
	$role=$_POST["role"];
	$security=$_POST["security"];
	$citizenship=$_POST["citizenship"];	
}


function allSet() {
	return isset($_POST["username"]) && isset($_POST['department'])
		&& isset($_POST['role']);
}

?>

</body>
</html>