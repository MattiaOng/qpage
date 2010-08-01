<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: install.php

   It build anything needful by Qpage.
   ---------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009

   ---------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see list in AUTHOR.TXT file)

   See LICENSE.TXT file for licensing details.
   */
?>
<html>
  <head>
    <title>Installation Page ~ Qpage</title>
	
	<link rel="shortcut icon" href="images/favicon.bmp"> 
	<link rel="icon" type="image/gif" href="images/favicon.bmp"> 

    <link rel='stylesheet' type='text/css' href='css/admin.css'>
  </head>

  <body>
    <p>Before to run this script <b>configure</b> the file '<b>config.php</b>'...</p>
<?php
  require_once 'lib-php/various.php';

  conn($mysqli);

  if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `Articles` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `Title` varchar(100) NOT NULL,
                `Category` varchar(100) NOT NULL,
                `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `Body` text NOT NULL,
                 PRIMARY KEY (`ID`));")) {
      Error('articles query - ' . mysql_error());
  }

  if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `Users` (
            `Username` varchar(20) NOT NULL,
            `Password` varchar(32) NOT NULL,
            `Permission` int(1) NOT NULL,
            `Mail` varchar(255) NOT NULL,
            UNIQUE KEY `Username` (`Username`));")) {
      Error('users query - ' . mysql_error());
  }

  $mysqli->close();
?>
    <p>Database was alter successfully.</p>
    <p>If you want to, you can delete this page but there are no risks keeping itself.</p>
	<p>You must be the first to register so you will have admin privileges: now you're redirecting to the register page.</p>
	<script type='text/javascript'>
		window.location = 'manage.php?act=s_register';
	</script>
  </body>
</html>
<?php
  /* End of install.php */
?>