<style>
body
{
	ackground-color: #181a1b;
    color: azure;
	font-family: Consolas,monaco,monospace;
}

a:link
{
	font-size: 14px;
	width: unset;
	width: 10000px;
	text-decoration: none; 
	background-color: #2f16a0;
    padding: 3px;
    border: none;
}
a:hover 
{
    border: none;
    background: rgb(115, 0, 255); 
}
a:visited
{
    color :azure;
    text-decoration: none;
}



</style>

<?php
$targetDir = ".";

$scan = scanDir("$targetDir");
foreach($scan as $file) 
{
	if(!is_dir("$targetDir/$file")) 
	{
		$file_parts = pathinfo($file);
		$fileName = basename($file);
		$test = "test";
        if($file_parts['extension'] == "mp4")
        {
			echo '<div title=" '.$fileName.' "> 
				  	<a href="'.$file.'" download> '.$fileName.' </a>
						<?=
						
						?>
					<br></br>
				  </div>';
        }
	}
}


?>
