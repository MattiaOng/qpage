<?php
	/*
	   This file is part of (C)qpage, do not touch
	   FILE: manage.php

	   It needs to administer qpages records, it makes a simple query
	   without some results.
	   -------------------------------------------------------------------
	   Author: Ongaro Mattia
	   Begin: lun dec 24 2009

	   -------------------------------------------------------------------
	   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)

	   See LICENSE.TXT file for licensing details.
	*/

	require_once './lib-php/identity.php';

	final class manage extends identity
	{
		public function alter_database ( $query )
		{
			if ( $this -> permission ( ) != ADMIN )
			{
				Error ( 'You must be admin to alter the database' );
			}

			conn ( $mysqli );

			if ( ! $mysqli -> query ( $query ) )
			{
				Error ( $mysqli -> error );
			}

			$mysqli -> close ( );
		}
	}

	/* End of manage.php */
?>