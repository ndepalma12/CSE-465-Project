<body bgcolor = "#00FFFF">

<h2> FILE ATTRIBUTES </h2>	
<form method="post">
DEPARTMENT:	
<select name="Dept">
	<option value="NA">...</option>
	<option value="Development">Development</option>
	<option value="Sales">Sales</option>
	<option value="Human Resources">Human Resources</option>
	<option value="Accounting">Accounting</option>
	<option value="Information Technology">Information Technology</option>		
</select>
<br>

ROLE:
<select name="Role">
	<option value="NA">...</option>
	<option value="1">Intern</option>
	<option value="2">Assistant</option>
	<option value="3">Employee</option>
	<option value="4">Manager</option>
	<option value="5">CEO</option>
</select>
<br>

SECURITY LEVEL:
<select name="Sec">
	<option value="NA">...</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
</select>
<br>

CITIZENSHIP:
<select name="Ctzn">
	<option value="NA">...</option>
	<option value="1">Canadian</option>
	<option value="2">French</option>
	<option value="3">Mexican</option>
	<option value="4">Chinese</option>
	<option value="5">American</option>
</select>
<br>


<input type="submit" name="Upload" value="UPLOAD!">
</form>

<?php
 //REFERENCE: http://www.w3schools.com/php/php_file_upload.asp
session_start();
$loc = $_SESSION['loc'];

if(isset($_POST['Upload'])&&isset($_POST['Dept'])&&isset($_POST['Sec'])&&isset($_POST['Role'])&&isset($_POST['Ctzn']))
	{
		if($_POST['Dept']=="NA"||$_POST['Sec']=="NA"||$_POST['Role']=="NA"||$_POST['Ctzn']=="NA")
			echo "Choose an attribute.";
		else
		{
			echo $_POST['Dept']."<br>";
			echo $_POST['Sec']."<br>";
			echo $_POST['Role']."<br>";
			echo $_POST['Ctzn']."<br>";
			echo $loc."<br>";
			session_destroy();
			fileUp($loc);
		}
	}
function fileUp($loc)
{
	//I will include the actual file upload code here
	
}
