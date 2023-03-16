
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$errorType = 0; //0 -no error 1 -not mp4 2 -file already uploaded 3 - too many files on server
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



$foundFile = 0;
$scan = scandir($target_dir);
foreach($scan as $file) 
{
    if(!is_dir("$target_dir/$file"))
    {
        $file_parts = pathinfo($file);
        if($file_parts['extension'] == "mp4")
        {
            $foundFile = 1;
            $errorType = 2;
            $uploadOk = 0;
        }
    }
    else 
    {
      $errorType = 0;
      $uploadOk = 1;
    }
}

// Check if image file is a actual image or fake image

if(isset($_POST["submit"]) && $errorType != 2) 
{
  if($fileType == "mp4") {
    $uploadOk = 1;
  } else {
    $errorType = 1;
    $uploadOk = 0;
  }
}
$numFiles;
$scan = scandir("outputs/");
foreach ($scan as $file) 
{
		if ($file_parts['extension'] == "mp4") 
		{
        $numFiles+=1;
		}
}
if($numFiles>=10) 
{
  $errorType = 3;
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
  if ($errorType == 1)
  {
    echo "Your file was not uploaded because it is not of type .mp4 or no file selected";
  }
  else if ($errorType == 2)
  {
    echo "A file is already uploaded! Click reset if you want to upload a different file or click anamorphise if you want to process it.";
  }
  else if ($errorType == 0)
  {
    echo "An unknown error occured when uploading your file.";
  }
  else if ($errorType == 3)
  {
    echo "Too many files on server! Please go to Processed Vides and delete some.";
  }
  // if everything is ok, try to upload file
} 
else if ($uploadOk == 1) 
{
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "\nThe file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } 
  else 
  {
    echo "An unknown error occured when uploading your file.";
  }
}
?>