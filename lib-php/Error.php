<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: Error.php
   
   It exit by a JSON formatted error.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
  
  define('ERR_QUERY', 'Fail query to database');
  define('FAIL_UPDATE', 'Fail update on database');
  define('LOGIN', 'Before to change your account data you have to be loggin.');
  define('NO_ASK', 'No one request for GET and POST');
  
  function Error($string)
  {
	  echo '<center><b>Error: </b>' . $string . '</center></body></html>';      
      exit;
  }
  
  /* End of Error.php */
?>