<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>Read Ares</title>
	
	<meta content="" name="keywords">
	<meta content="" name="author">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<h1>Read Ares</h1>

<?php
/**
 * Read Ares
 * @author Martin Dobry
 * @link http://webscript.cz
 * @version 1.0
 */

include "ReadAres.php";
$Ares = new ReadAres\Read($_GET['ic']);
$json = $Ares->testIC();

$array = json_decode($json, 1);

if($array[2])
	foreach ($array as $data)
		echo '<strong>'.$data['name'].':</strong> '.$data['value'].'<br />';
else
	echo '<strong>Nastala chyba!</strong><br />'.$array['error']

?>

</body>
</html>
