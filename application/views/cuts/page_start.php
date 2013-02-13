<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Arun Sekhar">

		<!-- Styles-->
		<link href="/public/bootstrap/css/bootstrap.css" rel="stylesheet"> 
		<link href="/public/css/basic.css" rel="stylesheet">
		<?php

			/**
			 * Adds Stylesheet file from anywhere
			 * used for plugins css
			 */
			if(isset($root_css) && is_array($root_css))
			{
				foreach ($root_css as $root_css_file)
				{
					echo '<link href="' . $root_css_file . '" rel="stylesheet">';
				}
			}

			/**
			 * Adds Stylesheet file from public/
			 * used for plugins css
			 */
			if(isset($css) && is_array($css))
			{
				foreach ($css as $css_file)
				{
					echo '<link href="/public/' . $css_file . '.css" rel="stylesheet">';
				}
			}

			/**
			 * Adds Stylesheet file from public/css/app/
			 * used for application specific css
			 */
			if(isset($app_css) && is_array($app_css))
			{
				foreach ($app_css as $app_css_file)
				{
					echo '<link href="/public/css/app/' . $app_css_file . '.css" rel="stylesheet">';
				}
			}
		?>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="/favicon.ico">
	</head>
	
	<body>
