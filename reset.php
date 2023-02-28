<?php
$files = glob('workspace/in_frames/*'); // get all file names
    foreach($files as $file){ // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt")
        {
            unlink($file); // delete file
        }
    }
    $files = glob('workspace/out_frames/*'); // get all file names
    foreach($files as $file){ // iterate files

        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt") 
        {
            unlink($file); // delete file
        }
    }
    $files = glob('workspace/*'); // get all file names
    foreach($files as $file)
    { // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt")
        {
            unlink($file); // delete file
        }
    }
    $files = glob('uploads/*'); // get all file names
    foreach($files as $file)
    { // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt")
        {
            unlink($file); // delete file
        }
    }
    ?>