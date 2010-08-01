<?php
	/*
	   This file is part of (C)qpage, do not touch
	   FILE: varius.php

	   It contains functions without category.
	   -------------------------------------------------------------------
	   Author: Ongaro Mattia
	   Begin: lun dec 24 2009

	   -------------------------------------------------------------------
	   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)

	   See LICENSE.TXT file for licensing details.
	*/

	// Debug off
	/*
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		ini_set("html_errors", 1);
	*/

	define ( 'IN_QPAGE', true );
	
	define ( 'ADMIN', 3 );
	define ( 'USER', 2 );
	
	require_once './config.php';
	include_once 'control.php';
	include_once 'Error.php';

	function conn ( &$mysqli )
	{
		$mysqli = mysqli_connect ( HOST, DB_USERNAME, DB_PASSWORD, DATABASE );

		if ( mysqli_connect_errno ( ) )
		{
    			Error ( 'Error during the database connection :' .  mysqli_connect_error ( ) );
		}
	}

	function register ( $username, $password, $mail )
	{
		if ( ! filter_var ( $mail, FILTER_VALIDATE_EMAIL ) )
			{
				Error ( "E-Mail is not valid." );
			}

		if ( strlen ( $password ) < 8 )
		{
			Error ( "Password too short, it have to be bigger than 8 characters." );
		}

		if ( strlen ( $username ) < 4 )
		{
			Error ( "Username too short, it have to be bigger than 4 characters." );
		}

		conn ( $mysqli );
		$query = "INSERT INTO Users ( Username, Password, Permission, Mail ) VALUES ( '";
		$result = $mysqli -> query ( "SELECT * FROM Users LIMIT 1" );

		if ( !$result -> fetch_object( ) )
		{
			if ( ! $mysqli -> query ( $query . $username . "', '" . md5 ( $password ) . "', '". ADMIN . "', '" . $mail . "');" ) )
			{
				Error ( $mysqli -> error );
			}
		}
		else
		{
			if ( ! $mysqli -> query ( $query . $username . "', '" . md5 ( $password ) . "', '". USER . "', '" . $mail . "');" ) )
			{
				Error ( $mysqli -> error );
			}
		}
	}

	function copyright ( )
	{
		return "<span id='copyright'>Some rights reserverd, <a href='LICENSE.TXT'>copyright</a> &copy 2009-2010 <a href='AUTHOR.TXT'>Ongaro Mattia</a></span>";
	}
	/* End of various.php */
?>