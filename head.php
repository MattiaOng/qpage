<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: head.php
   
   Head of every web page.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keyword" content="qpage, blog, site"> 
		<meta name="Description" content="What the fuck!? A site without contents!">
		
		<link rel='stylesheet' type='text/css' href='css/style.css'>

		<link rel="shortcut icon" href="images/favicon.bmp"> 
		<link rel="icon" type="image/gif" href="images/favicon.bmp"> 

		<link rel="alternate" type="application/rss+xml" title="News Updates" href="feed_rss.php" /> 
		
		<title><?php
	if (isSet($_GET['p'])) {
		$request->single('SELECT * FROM Articles WHERE ID=\'' . intval($_GET['p']) . '\' LIMIT 1');
		echo $request->toShow[0]->title;
	} else {
		echo $_SERVER[ 'SERVER_NAME' ];
	}
?></title>
	</head>

	<body>
		<a id="logo" href="./index.php" alt="Home"></a>
		<a href="feed_rss.php"><img id="rss" src="images/rss.png" alt="RSS Feed" /></a>

		<div id="linkBar">
			<a href="index.php">Home</a>
			<a href="manage.php">Managment</a>
		</div>

		<div id='right'>
			<form id="search" method='GET'>
				<p><b>Article's name:</b><br />
				<input name='find'></p>
				<input type='submit' value='Search'>
			</form>

			<div id="topics">
				<h2>Topics</h2><br />
<?php
	require_once'lib-php/ask.php';
	$cat=new ask;
	$cat->get_field("SELECT DISTINCT Category FROM Articles");

	foreach($cat->toShow as $string){
		if(empty($string)){
			continue;
		}
		echo "<a href='?cat=".$string."'>".$string."</a><br />";
	}

	echo "<a href='?cat='>Without category</a>";
?>
			</div>
			
			<a href="?all">News Archive</a>
		</div>
<?php
	/* End head.php */
?>