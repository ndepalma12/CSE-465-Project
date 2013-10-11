<?php
session_start();
$loc = $_SESSION['loc'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ($_FILES["file"]["size"] < 20000)
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if ((file_exists("$loc/" . $_FILES["file"]["name"])) && ($_SESSION['write'] == FALSE))
      {
      echo $_FILES["file"]["name"] . " already exists. " . "<br>";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "$loc/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "$loc/" . $_FILES["file"]["name"] . "<br>";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
  echo "<a href=dept.php>Departments</a>";
 session_destroy();
?>
