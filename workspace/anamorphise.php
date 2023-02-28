<?php
$workspaceDir = getcwd();
$target_dir = "../uploads/";
$codeDir = "../code/";

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
           copy("$target_dir/$file","$workspaceDir/$file");
        }
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

$command = escapeshellcmd('python3 Splicer.py');
$output = shell_exec($command);
echo $output;




?>
