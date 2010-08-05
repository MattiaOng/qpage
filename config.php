<?php
	/*
		File to configure mysql connection, 
		you must configure this before do anything else with Qpage.
	*/

	define ( 'HOST', 
	// The host's URL of mysql server or 'localhost'
	'localhost' 
	);
	define ( 'DATABASE', 
	// The name of a database
	'database' 
	); 
	define ( 'DB_USERNAME',
	
	// The username of the account to access the database
	'database_username' 
	
	); 
	define ( 'DB_PASSWORD', 
	// The password for the account
	'database_password' 
	);
	define ( 'TITLE', 
	// The home page's title
	'Qpage Dominion' 
	);
	define ( 'HOST', 
	// The web path of qpage
	'http://'.$_SERVER['SERVER_NAME'].'/'
	);
	/* End of config.php */
?>