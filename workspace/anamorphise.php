<?php
$target_dir = "../uploads/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$errorType = 0; //0 -no error 1 -not mp4 2 -file already uploaded
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


//finds mp4
$foundFile = 0;
$scan = scandir($target_dir);
foreach ($scan as $file) {
    if (!is_dir("$target_dir/$file")) {
        $file_parts = pathinfo($file);
        if ($file_parts['extension'] == "mp4") {
            $foundFile = 1;
            $errorType = 2;
            $uploadOk = 0;
        }
    } else {
        $errorType = 0;
        $uploadOk = 1;
    }
}


if (isset($_POST["submit"]) && $errorType != 2) {
    if ($fileType == "mp4") {
        $uploadOk = 1;
    } else {
        $errorType = 1;
        $uploadOk = 0;
    }
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    if ($errorType == 1) {
        echo "Your file was not uploaded because it is not of type .mp4 or no file selected";
    } else if ($errorType == 2) {
        RunScripts($target_dir);
    } else if ($errorType == 0) {
        echo "An unknown error occured when uploading your file.";
    }
    // if everything is ok, try to upload file
} else if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "\nThe file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        RunScripts($target_dir);
    } else {
        echo "An unknown error occured when uploading your file.";
    }
}



function RunScripts($tDir)
{
    $workspaceDir = getcwd();
    $target_dir = $tDir;

    $foundFile = 0;
    $scan = scandir($target_dir);
    foreach ($scan as $file) {
        if (!is_dir("$target_dir/$file")) {
            $file_parts = pathinfo($file);
            if ($file_parts['extension'] == "mp4") {
                $foundFile = 1;
                echo "ANAMORPHISEING $file";
                copy("$target_dir/$file", "$workspaceDir/$file");
            }
        } else {
            $foundFile = 0;
        }
    }
    if ($foundFile == 0) {
        echo "No .mp4 files found. Please upload a file!";

    }

    if ($foundFile == 1) {
        echo '<script type="text/javascript" src="AmIRunning.js>"',
            'Change(true);',
            '</script>'
        ;

        echo '<script type="text/javascript" src="AmIRunning.js>"',
            'Anamorphise();',
            '</script>'
        ;

    }
    $command = escapeshellcmd('python3 Splicer.py');
    $output = shell_exec($command);
    echo $output;

}

?>