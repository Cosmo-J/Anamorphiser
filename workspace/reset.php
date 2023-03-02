<?php
$files = glob('in_frames/*'); // get all file names
    foreach($files as $file){ // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt")
        {
            unlink($file); // delete file
        }
    }
    $files = glob('out_frames/*'); // get all file names
    foreach($files as $file){ // iterate files

        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt") 
        {
            unlink($file); // delete file
        }
    }
    $files = glob('*'); // get all file names
    foreach($files as $file)
    { // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType== "mp4")
        {
            unlink($file); // delete file
        }
    }
    $files = glob('/var/www/html/uploads/*'); // get all file names
    foreach($files as $file)
    { // iterate files
        $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(is_file($file) && $fileType!="txt")
        {
            unlink($file); // delete file
        }
    }
    ?>
