<?php
$workspaceDir = "workspace/";
$target_dir = "uploads/";
$codeDir = "code/";

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
           Anamorphise($codeDir,$workspaceDir);
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


function Anamorphise($src, $dst) 
{
    // open the source directory
    $dir = opendir($src); 
  
    // Loop through the files in source directory
    while( $file = readdir($dir) ) { 
  
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) 
            { 
  
                // Recursively calling custom copy function
                // for sub directory 
                Anamorphise($src . '/' . $file, $dst . '/' . $file); 
  
            } 
            else { 
                copy($src . '/' . $file, $dst . '/' . $file); 
            } 
        } 
    } 
  
    
    closedir($dir);
    $command = escapeshellcmd('python /workspace/Splicer.py');
    $output = shell_exec($command);
    echo $output;
}

function EmptyWorkspace()
{
    $files = glob('workspace/in_frames/*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }
    $files = glob('workspace/out_frames/*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }
    $files = glob('workspace/out_frames/*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }
}
?>