<?php
	/*
	   This file is part of (C)qpage, do not touch
	   FILE: identity.php

	   It identifies the user by the sessions and allows to change
	   some parameters.
	   -------------------------------------------------------------------
	   Author: Ongaro Mattia
	   Begin: lun dec 24 2009

	   -------------------------------------------------------------------
	   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)

	   See LICENSE.TXT file for licensing details.
	*/

	require_once 'various.php';
	require_once 'user.php';

	class identity
	{
		private $user;
		protected $flag;

		public function __construct ( )
		{
			/*
				Snippet to avoid some error...
				If you wanna change that.
			---------------------------------------- */
			ini_set("session.bug_compat_42", "0");
			ini_set("session.bug_compat_warn", "0");
		//  ----------------------------------------

			$this -> user = new user ( @ $_SESSION [ 'username' ],
									   @ $_SESSION [ 'permission' ],
									   @ $_SESSION [ 'mail' ] );
		}

		public function __destruct ( )
		{
			if ( $this -> flag )
			{
				unset ( $_SESSION [ 'username' ] );
				unset ( $_SESSION [ 'permission' ] );
				unset ( $_SESSION [ 'mail' ] );
			}
			else
			{
				$_SESSION [ 'username' ] = @ $this -> user -> username;
				$_SESSION [ 'permission' ] = @ $this -> user -> permission;
				$_SESSION [ 'mail' ] = @ $this -> user -> mail;
			}
		}

		public function login ( $username, $password )
		{
			conn ( $mysqli );

			$result = $mysqli -> query ( "SELECT * FROM Users WHERE Username='"
					             . $username . "' AND Password='" . md5 ( $password ) . "' LIMIT 1" );

			$mysqli -> close ( );

			if ( ! $obj = @ $result -> fetch_object ( ) )
			{
				Error ( "Username or password are wrong, retry." );
			}

			$result -> close ( );

			$this -> user -> permission = $obj -> Permission;
			$this -> user -> username = $username;
			$this -> user -> mail = $obj -> Mail;
		}

		public function logout ( )
		{
			$this -> flag = true;
		}

		public function permission ( )
		{
			return $this -> user -> permission;
		}

		public function username ( )
		{
			return $this -> user -> username;
		}

		public function isUser ( )
		{
			return  isSet ( $this -> user -> username ) && isSet ( $this -> user -> permission ) || isSet ( $this -> user-> mail );
		}

		public  function chUsername ( $username )
		{
			conn ( $mysqli );

			if ( ! $this -> isUser ( ) )
			{
				Error ( LOGIN );
			}

			if ( ! $mysqli -> query ( $query . "UPDATE Users SET Username='" . $username . "' WHERE Username='" . $this -> user -> username . "'" ) )
			{
				Error ( $mysqli -> error );
			}

			$this -> username = $username;
			$mysqli -> close ( );
		}

		public  function chPassword ( $password )
		{
			conn ( $mysqli );

			if ( ! $this -> isUser ( ) )
			{
				Error ( LOGIN );
			}

			if ( ! $mysqli -> query ( $query . "UPDATE Users SET Password='" . $password . "' WHERE Username='" . $this -> user -> username . "'" ) )
			{
				Error ( $mysqli -> error );
			}

			$this -> password = $password;
			$mysqli -> close ( );
		}
	}

	/* End of identity.php */
?>