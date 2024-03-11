<?php
header('Content-Type: application/json'); // Ensure JSON response

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$errorType = 0; // 0 -no error, 1 -not mp4, 2 -file already uploaded, 3 - too many files on server
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Finds mp4
$foundFile = 0;
$scan = scandir($target_dir);
foreach ($scan as $file) {
    if (!is_dir("$target_dir/$file")) {
        $file_parts = pathinfo($file);
        if ($file_parts['extension'] === "mp4") {
            $foundFile = 1;
            $errorType = 2;
            $uploadOk = 0;
            break; 
        }
    }
}

$numFiles = count(array_filter($scan, function ($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === "mp4";
}));

if($numFiles >= 10) {
    $errorType = 3;
    $uploadOk = 0;
}

// Processing and error handling
if ($uploadOk == 0) {
    $message = "An unknown error occurred when loading your file.";
    if ($errorType == 1) {
        $message = "Your file was not uploaded because it is not of type .mp4 or no file selected.";
    } else if ($errorType == 2) {
        $message = "File already uploaded.";
    } else if ($errorType == 3) {
        $message = "Too many files on server! Please go to Processed Videos and delete some.";
    }

    echo json_encode(['success' => false, 'message' => $message]);
    exit;
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $output = RunScripts($target_dir);
        echo json_encode(['success' => true, 'message' => "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.", 'output' => $output]);
    } else {
        echo json_encode(['success' => false, 'message' => "An unknown error occurred when uploading your file..."]);
    }
}

function RunScripts($tDir) {
    $workspaceDir = getcwd();
    $target_dir = $tDir;
    $foundFile = 0;
    $output = '';

    $scan = scandir($target_dir);
    foreach ($scan as $file) {
        if (!is_dir("$target_dir/$file")) {
            $file_parts = pathinfo($file);
            if ($file_parts['extension'] == "mp4") {
                $foundFile = 1;
                $output .= "ANAMORPHISING $file\n";
                copy("$target_dir/$file", "$workspaceDir/$file");
                break;
            }
        }
    }

    if ($foundFile == 0) {
        $output .= "No .mp4 files found. Please upload a file!\n";
    } else {
        $command = escapeshellcmd('python3 Splicer.py');
        $output .= shell_exec($command);
    }

    return $output;
}
