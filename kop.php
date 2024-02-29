<?php
// DISABLED DUE TO LOCALHOST NOT HAVING SSL BY DEFAULT
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
//     //Tell the browser to redirect to the HTTPS URL.
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
//     //Prevent the rest of the script from executing.
//     exit;
// }
date_default_timezone_set("Europe/Brussels");
setlocale(LC_TIME, 'NL_nl');
?>

<!DOCTYPE html>
<html lang="nl">
	<head>

	<meta charset="utf-8">
	<title>Wiskunde</title>
	<meta name="description" content="Wiskunde">
	<meta name="author" content="Vanhoecke Sven">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/public/css/normalize.css">
	<link rel="stylesheet" href="/public/css/skeleton.css">
	<link rel="icon" href="/public/assets/favicon.png" type="image/x-icon">
	<style>
	input[type="date"]::-webkit-input-placeholder{ 
		visibility: hidden !important;
	}

	@media print {
	   .button {
		  visibility: hidden;
	   }
	}

	</style>
	<!--Latest MathJax-->
	<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/latest.js?config=TeX-MML-AM_CHTML">
</script>
	</head>
<body>
