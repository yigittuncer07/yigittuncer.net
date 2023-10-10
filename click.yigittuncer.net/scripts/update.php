<?php
session_start();
$myfile = fopen("log.txt", "r") or die("Unable to open file!");
$num = fread($myfile, filesize("log.txt"));
fclose($myfile);
$num = $num - $_SESSION['count'];
$_SESSION['count'] = 0;
echo "$num";
$myfile = fopen("log.txt", "w") or die("Unable to open file!");
fwrite($myfile, $num);
fclose($myfile);
?>