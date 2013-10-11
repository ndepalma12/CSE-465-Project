<!DOCTYPE html>
<html>
<body 
bgcolor = "#00FFFF">

<center><h1>DEPARTMENTS</h1>
<form method="post">
<input type="submit" name="Dev" value="Development"/>
<input type="submit" name="Sales" value="Sales"/>
<input type="submit" name="HR" value="Human Resources"/>
<input type="submit" name="Acc" value="Accounting"/>
<input type="submit" name="IT" value="Information Technology"/>
</form>




</center>

<?php
session_start();	//Starts the session so that the file path can be carries across php pages
$num = 2;	//Used in file_disp() to step through folder contents

//The following if-statements determine which button is clicked and which files to display
if(isset($_POST['Dev']))//Determines button action and files to display
{   
	$_SESSION['write'] = TRUE;	//User able to overwrite files.  Test purposes only, not to be used in final project.
	$_SESSION['loc'] = "Company/DevFiles";	//Location of files
	echo "This is the Dev team <br>";	
	
	chdir($_SESSION['loc']);	//Changes to folder with files
	$loc = $_SESSION['loc'];	//Sets location variable
	$array = scandir(getcwd());	//Gets contents of folder
	file_disp($num, $array, $loc);	//Displays files for download
	upload();	//Displays upload link
}

if(isset($_POST['Sales']))
{   
	$_SESSION['write'] = FALSE;	//User unable to overwrite files.  Test purposes only, not to be used in final project.
	$_SESSION['loc'] = "Company/SalesFiles";	//Location of files
	echo "This is the Sales team <br>";
	
	chdir($_SESSION['loc']);	//Changes to folder with files
	$loc = $_SESSION['loc'];	//Sets location variable
	$array = scandir(getcwd());	//Gets contents of folder
	file_disp($num, $array, $loc);	//Displays files for download
	upload();	//Displays upload link
}

if(isset($_POST['HR']))
{   
	$_SESSION['loc'] = "Company/HRFiles";	//Location of files
	echo "This is the Human Resources team <br>";
	
	chdir($_SESSION['loc']);	//Changes to folder with files
	$loc = $_SESSION['loc'];	//Sets location variable
	$array = scandir(getcwd());	//Gets contents of folder
	file_disp($num, $array, $loc);	//Displays files for download
	upload();	//Displays upload link
}

if(isset($_POST['Acc']))
{   
	$_SESSION['loc'] = "Company/AccFiles";	//Location of files
	echo "This is the Accounting team <br>";
	
	chdir($_SESSION['loc']);	//Changes to folder with files
	$loc = $_SESSION['loc'];	//Sets location variable
	$array = scandir(getcwd());	//Gets contents of folder
	file_disp($num, $array, $loc);	//Displays files for download
	upload();	//Displays upload link	
}

if(isset($_POST['IT']))
{   
	$_SESSION['loc'] = "Company/ITFiles";	//Location of files
	echo "This is the Information Technology team <br>";
	
	chdir($_SESSION['loc']);	//Changes to folder with files
	$loc = $_SESSION['loc'];	//Sets location variable
	$array = scandir(getcwd());	//Gets contents of folder
	file_disp($num, $array, $loc);	//Displays files for download
	upload();	//Displays upload link	
}



/*****************************************************************************************/
/****************************************FUNCTIONS****************************************/
/*****************************************************************************************/



function file_disp($num, $array, $loc)
{
foreach (glob("*.*") as $filename)	//Steps through folder
	{
		if(array_key_exists($num, $array))	//Checks if key in array exists
		{
			echo "<a href=/$loc/$filename download=$filename>$filename</a><br>";	//Displays download link for file
		}
		$num = $num+1;	//Steps through the files in the folder
	}	
}




function upload()
{
echo <<< EOT
<form action="upload_files.php" method="post"
enctype="multipart/form-data">
<label for="file">Please Upload File:    </label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
EOT;
}
?>

</body>
</html>









