<?php
	/*
	   This file is part of (C)qpage, do not touch
	   FILE: user.php

	   User data structur.
	   -------------------------------------------------------------------
	   Author: Ongaro Mattia
	   Begin: lun dec 24 2009

	   -------------------------------------------------------------------
	   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)

	   See LICENSE.TXT file for licensing details.
	*/

	if ( ! defined ( 'IN_QPAGE' ) )
	{
		exit;
	}

	class user
	{
		public $username;
		public $permission;
		public $mail;

		public function __construct ( $username, $permission, $mail )
		{
			$this -> username = $username;
			$this -> permission = $permission;
			$this -> mail = $mail;
		}
		
		public function permission ( )
		{
			return $this -> permission;
		}
	}

	/* End user.php */
?>