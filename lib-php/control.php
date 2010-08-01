<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: control.php
   
   It checkes out some intrusion or error in the strings and corrects
   them.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
  
  if (!defined('IN_QPAGE')) {
      exit;
  }
  
  function control()
  {
      // Avoid XSRF
      /*if ( false && ! preg_match ( "/http:\/\/" . $_SERVER[ 'SERVER_NAME' ] . "/i" ,
       $_SERVER [ 'HTTP_REFERER' ] ) )
       {
       Error ( 'Bad referrer.' );
       }*/
      
      foreach ($_GET as $key => $var) {
          $_GET[$key] = mysql_escape_string(htmlspecialchars($var));
      }
      
      foreach ($_POST as $key => $var) {
          $_POST[$key] = mysql_escape_string($var);
      }
  }
  
  /* End of control.php */
?>