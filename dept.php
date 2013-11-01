<!DOCTYPE html>
<html>
<body bgcolor = "#00FFFF">

<center><h1>DEPARTMENTS</h1>
<form method="post">
<input type="submit" name="Dev" value="Development"/>
<input type="submit" name="Sales" value="Sales"/>
<input type="submit" name="HR" value="Human Resources"/>
<input type="submit" name="Acc" value="Accounting"/>
<input type="submit" name="IT" value="Information Technology"/>
</form>

<form method="post">
<input type="submit" name="lout" value="Log Out"><br>
</form>

</center>

<?php
session_start();	//Starts the session so that the file path can be carries across php pages <img src="http://i.imgur.com/F1S7mfY.gif" alt="DB90">
$num = 2;	//Used in file_disp() to step through folder contents

if($_SESSION['login_cred'] == 1)
{

$curr_user = $_SESSION['user'];

$con=mysqli_connect('localhost','','','cse465');

if (mysqli_connect_errno($con))
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();  //checks for connection
	}

$result = mysqli_query($con, "Select * FROM userdept");



//The following if-statements determine which button is clicked and which files to display
if(isset($_POST['Dev']))//Determines button action and files to display
{   
	$check = FALSE;		//checks to see if user has access to department.	
	$curr_user = $_SESSION['user'];
	while($row = mysqli_fetch_array($result))
	{
		if($row['username'] == $curr_user)
		{
			if($row['department'] == "Development")
			{
				$check = TRUE;
			}
		}
	}
	
	if($check == TRUE)
	{
		$_SESSION['write'] = TRUE;	//User able to overwrite files.  Test purposes only, not to be used in final project.
		$_SESSION['loc'] = "Company/DevFiles";	//Location of files
		echo "This is the Dev team <br>";	
		chdir($_SESSION['loc']);	//Changes to folder with files
		$loc = $_SESSION['loc'];	//Sets location variable
		$array = scandir(getcwd());	//Gets contents of folder
		file_disp($num, $array, $loc);	//Displays files for download
		$_SESSION['dept']='dev';
		upload();	//Displays upload link
	}else
		echo "You do not have permission to view these files.";

}

if(isset($_POST['Sales']))
{   
	$check = FALSE;
	$curr_user = $_SESSION['user'];
	$_SESSION['dept']='sales';	
	
	while($row = mysqli_fetch_array($result))
	{
		if($row['username'] == $curr_user)
		{
			if($row['department'] == "Sales")
			{
				$check = TRUE;
			}
		}
	}
	//$_SESSION['write'] = FALSE;	//User unable to overwrite files.  Test purposes only, not to be used in final project.
	if($check == TRUE)
	{
		$_SESSION['write'] = TRUE;	//User unable to overwrite files.  Test purposes only, not to be used in final project.

		$_SESSION['loc'] = "Company/SalesFiles";	//Location of files
		echo "This is the Sales team <br>";
		chdir($_SESSION['loc']);	//Changes to folder with files
		$loc = $_SESSION['loc'];	//Sets location variable
		$array = scandir(getcwd());	//Gets contents of folder
		file_disp($num, $array, $loc);	//Displays files for download
		upload();	//Displays upload link
	 }else
		echo "You do not have permission to view these files.";
}


if(isset($_POST['HR']))
{   
	$check = FALSE;
	$_SESSION['dept']='hr';
	$curr_user = $_SESSION['user'];
	while($row = mysqli_fetch_array($result))
	{
		if($row['username'] == $curr_user)
		{
			if($row['department'] == "HumanResources")
			{
				$check = TRUE;
			}
		}
	}
	if($check == TRUE)
	{

		$_SESSION['loc'] = "Company/HRFiles";	//Location of files
		echo "This is the Human Resources team <br>";
		
		$_SESSION['write'] = TRUE;
		chdir($_SESSION['loc']);	//Changes to folder with files
		$loc = $_SESSION['loc'];	//Sets location variable
		$array = scandir(getcwd());	//Gets contents of folder
		file_disp($num, $array, $loc);	//Displays files for download
		upload();	//Displays upload link
	}else
		echo "You do not have permission to view these files.";
}


if(isset($_POST['Acc']))
{   
	$check = FALSE;
	$_SESSION['dept']='acc';
	$curr_user = $_SESSION['user'];
	while($row = mysqli_fetch_array($result))
	{
		if($row['username'] == $curr_user)
		{
			if($row['department'] == "Accounting")
			{
				$check = TRUE;
			}
		}
	}
	if($check == TRUE)
	{

		$_SESSION['loc'] = "Company/AccFiles";	//Location of files
		echo "This is the Accounting team <br>";

		$_SESSION['write'] = TRUE;
		chdir($_SESSION['loc']);	//Changes to folder with files
		$loc = $_SESSION['loc'];	//Sets location variable
		$array = scandir(getcwd());	//Gets contents of folder
		file_disp($num, $array, $loc);	//Displays files for download
		upload();	//Displays upload link	
	}
	else
		echo "You do not have permission to view these files.";
}


if(isset($_POST['IT']))
{   
	$_SESSION['dept']='it';
	$check = FALSE;
	$curr_user = $_SESSION['user'];
	while($row = mysqli_fetch_array($result))
	{
		if($row['username'] == $curr_user)
		{
			if($row['department'] == "ITSupport")
			{
				$check = TRUE;
			}
		}
	}
	if($check == TRUE)
	{
		$_SESSION['loc'] = "Company/ITFiles";	//Location of files
		echo "This is the Information Technology team <br>";
		
		$_SESSION['write'] = TRUE;
		chdir($_SESSION['loc']);	//Changes to folder with files
		$loc = $_SESSION['loc'];	//Sets location variable
		$array = scandir(getcwd());	//Gets contents of folder
		file_disp($num, $array, $loc);	//Displays files for download
		upload();	//Displays upload link	
	}
	else
		echo "You do not have permission to view these files.";
}

if(isset($_POST['lout']))
{
	session_destroy();
	header('Location: lout.php');
}
}
else
	header('Location: entry.php');



/*****************************************************************************************/
/****************************************FUNCTIONS****************************************/
/*****************************************************************************************/



function file_disp($num, $array, $loc)
{
$u_role;
$u_security;
$u_citizen;

$con=mysqli_connect('localhost','','','cse465');

$result2 = mysqli_query($con, "Select * FROM user");
$curr_user = $_SESSION['user'];
while($row2 = mysqli_fetch_array($result2))
{
	if($curr_user == $row2['Username'])
	{
		$u_role = $row2['Role'];
		$u_security = $row2['Security'];
		$u_citizen = $row2['Citizenship'];
		}
}

foreach (glob("*.*") as $filename)	//Steps through folder
	{
		if(array_key_exists($num, $array))	//Checks if key in array exists
		{
			//One more If-Statement here to determine if file should be displayed based on SQL Queries.  Will encapsulate the below echo
			$result3 = mysqli_query($con, "SELECT * FROM file");
			
			while($row3 = mysqli_fetch_array($result3))
			{
				if($filename == $row3['Filename'])
				{
					if($u_role >= $row3['Role'])
					{
						if($u_security >= $row3['Security'])
						{
							if($u_citizen == $row3['Citizenship'])
							{
								echo "<a href=/$loc/$filename download=$filename>$filename</a><br>";
							}
						}
					}
				}
			}
			
			//echo "<a href=/$loc/$filename download=$filename>$filename</a><br>";	//Displays download link for file
		}
		$num = $num+1;	//Steps through the files in the folder

	}	
}


function upload()
{

echo <<< EOT
<form action="upload_files.php" method="post">
<input type="submit" name="Upload" value="Upload a File">
</form>
EOT;

}
?>

</body>
</html>
