<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: index.php
   
   Index blog page.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
   	require_once 'lib-php/ask.php';
	control();
	$request = new ask;
   	require_once 'head.php';
	
	$syntax = '<div id="left">';

	if (isSet($_GET['last'])) {
	  $request->multi('SELECT * FROM Articles ORDER BY ID DESC LIMIT ' . intval($_GET['last']));
	} elseif (isSet($_GET['find'])) {
	  $request->multi('SELECT * FROM Articles WHERE Body LIKE \'%' . $_GET['find'] . '%\'');
	} elseif (isSet($_GET['cat'])) {
	  $request->multi('SELECT * FROM Articles WHERE Category=\'' . $_GET['cat'] . '\'');
	}elseif(isSet($_GET['all'])) {
		@$request->multi('SELECT ID, Title, Date FROM Articles ORDER BY ID DESC');
		echo '<div id="box"><h3>News Updates</h3>';

		foreach ( $request->toShow as $item )
		{
			echo '<span class="date">'.$item->date.'</span><a class="art_link" href="?p='.$item->id.'">'.$item->title.'</a><br />';
		}

		include 'foot.php';
	} elseif(!isSet($_GET['p'])) {
		$request->multi('SELECT * FROM Articles ORDER BY ID DESC LIMIT 10');
	}

	echo $syntax;

	 foreach ( $request->toShow as $item ){
		echo $item->XHTMLEncode ( );
	}
	
	include 'foot.php';

  /* End index.php */
?>