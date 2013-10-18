<body bgcolor = "#00FFFF">

<h2> FILE ATTRIBUTES </h2>	
<form method="post" enctype="multipart/form-data">
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

<label for="file">Please Upload File:    </label>
<input type="file" name="file" id="file"><br>

<input type="submit" name="Upload" value="UPLOAD!">
</form>

<?php
 //REFERENCE: http://www.w3schools.com/php/php_file_upload.asp
session_start();	//Start session to get location path
$loc = $_SESSION['loc'];	//Establish location path variable


//When Upload is selected and all the attributes are selected
if(isset($_POST['Upload'])&&isset($_POST['Dept'])&&isset($_POST['Sec'])&&isset($_POST['Role'])&&isset($_POST['Ctzn']))
	{
		if($_POST['Dept']=="NA"||$_POST['Sec']=="NA"||$_POST['Role']=="NA"||$_POST['Ctzn']=="NA")	//Make sure NA isn't chosen
			echo "Choose an attribute.";
		else
		{
			//These echo lines are just unit testing
			//We will replace them with SQL Queries setting values in the table using $_POST
			echo $_POST['Dept']."<br>";
			echo $_POST['Sec']."<br>";
			echo $_POST['Role']."<br>";
			echo $_POST['Ctzn']."<br>";
			echo $loc."<br>";
			fileUp($loc);	//Call the fileUp function passing the file path
			session_destroy();	//Destroy the session
		}
	}


/*****************************************************************************************/
/****************************************FUNCTIONS****************************************/
/*****************************************************************************************/



function fileUp($loc)
{

	//I will include the actual file upload code here
	if ($_FILES["file"]["size"] < 20000)	//File size not too big
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			//Just more echo statements to output file info
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		if ((file_exists("$loc/" . $_FILES["file"]["name"])) && ($_SESSION['write'] == FALSE))	//If the file can be overwritten.  Replace with SQL Query
		  {
			echo $_FILES["file"]["name"] . " already exists. " . "<br>";
		  }
		else
		  {
			move_uploaded_file($_FILES["file"]["tmp_name"],"$loc/" . $_FILES["file"]["name"]);	//Actually upload the file
			echo "Stored in: " . "$loc/" . $_FILES["file"]["name"] . "<br>";	//Print out file location
		  }
		}
	}
	else
	{
		echo "Invalid file";
	}
}
?>
<br>
<a href="dept.php">DEPARTMENTS</a>
