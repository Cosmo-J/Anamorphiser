<style>
	body 
	{
		background-color: #181a1b;
		color: azure;
		font-family: Consolas, monaco, monospace;
	}

	a:link 
	{
		font-size: 14px;
		width: unset;
		width: 10000px;
		text-decoration: none;
		background-color: #2f16a0;
		color: azure;
		padding: 3px;
		border: none;
	}

	a:hover 
	{
		color: azure;
		border: none;
		background: rgb(115, 0, 255);
	}

	a:visited 
	{
		color: azure;
		text-decoration: none;
	}

</style>

<?php
echo 
'
<div title = "Go Back">
    <a href="../../">Back</a>
  </div>
  <br>
  <br>

';

$targetDir = ".";	

$fileToDelete;

$scan = scanDir("$targetDir");
$numFiles = 0;
foreach ($scan as $file) 
{
	if (!is_dir("$targetDir/$file")) 
	{
		$file_parts = pathinfo($file);
		$fileName = basename($file);
		$test = "test";
		if ($file_parts['extension'] == "mp4") 
		{
			$numFiles += 1;
			echo '<div title=" ' . $fileName . ' "> 
				  	<a href="' . $file . '" download> ' . $fileName . ' </a>
					<a href="?DeleteFile='.$file.'"> Delete File 
					</a>
					<br></br>
				  </div>';
		}
	}
}

if(isset($_GET['DeleteFile']))
{
	
	DeleteFile($_GET['DeleteFile']);
}
function DeleteFile($file) 
{ 
	echo '<h2> Deleted '. $file .'<h2>';
	unlink($file);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$actual_link = substr($actual_link, 0, strpos($actual_link, "?"));
	header('Location:'.$actual_link);
}


echo '<h1 id="numFiles"> ' . $numFiles . '/10</h1>';
echo '<h2 id="warning"> WARNING DELETED FILES CANT BE RECOVERED <h2>';


?>