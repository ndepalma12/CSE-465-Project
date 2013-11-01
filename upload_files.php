<body bgcolor = "#00FFFF">

<h2> FILE ATTRIBUTES </h2>	
<form method="post" enctype="multipart/form-data">
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
	<option value="Canadian">Canadian</option>
	<option value="French">French</option>
	<option value="Mexican">Mexican</option>
	<option value="Chinese">Chinese</option>
	<option value="Japanese">Japanese</option>
	<option value="American">American</option>
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

if($_SESSION['login_cred'] == 1)
{

//When Upload is selected and all the attributes are selected
if(isset($_SESSION['dept'])&&isset($_POST['Upload'])&&isset($_POST['Sec'])&&isset($_POST['Role'])&&isset($_POST['Ctzn']))
{
	if($_POST['Sec']=="NA"||$_POST['Role']=="NA"||$_POST['Ctzn']=="NA")	//Make sure NA isn't chosen
		echo "Choose an attribute.";
	else
	{
		fileUp($loc);	//Call the fileUp function passing the file path
	}
}
}
else
	header('Location: entry.php');

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
			

		if (file_exists("$loc/" . $_FILES["file"]["name"])) // If file already exists:
		{


			if ($_SESSION['write'] == FALSE) {	//If the file can not be overwritten.  Replace with SQL Query
				echo $_FILES["file"]["name"] . " already exists. " . "<br>";				
			}
			else {
				$con=mysqli_connect('localhost', '', '', 'cse465');
				// Check connection
				if (mysqli_connect_errno())
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				else {	// Connection is good

					$sql="UPDATE File SET Role = '$_POST[Role]', Security = '$_POST[Sec]', Citizenship = '$_POST[Ctzn]'
						WHERE Filename = '$_SESSION[filename]' and Department = '$_SESSION[dept]'";

					if (!mysqli_query($con,$sql))
					{
						die('Error: ' . mysqli_error($con));
					}

					mysqli_close($con);

					echo "Stored in: " . "$loc/" . $_FILES["file"]["name"] . "<br>";	//Print out file location
				}
			}
			
		}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"$loc/" . $_FILES["file"]["name"]);	//Actually upload the file

			// SQL: insert into File Values (filename, dept, seciruty, citizenship)
			
			$_SESSION["filename"] = $_FILES["file"]["name"];
			
			$con=mysqli_connect('localhost', '', '', 'cse465');
			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			else {	// Connection is good

				$sql="INSERT INTO File (Filename, Department, Role, Security, Citizenship)
					VALUES ('$_SESSION[filename]', '$_SESSION[dept]',
						'$_POST[Role]', '$_POST[Sec]', '$_POST[Ctzn]')";

				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}

				mysqli_close($con);
			}
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
