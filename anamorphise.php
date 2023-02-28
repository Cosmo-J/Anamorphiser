<?php
$target_dir = "uploads/";
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
           echo "ANAMORPHISEING $file";
        }
        break;
    }
    else 
    {
        $foundFile = 0;
    }
}
if($foundFile == 0) 
{
    echo "No .mp4 files found. Please upload a file!";

}

?>