<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: ask.php
   
   It is the object that perform the query to the database and wrap
   the results.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
  
  require_once 'various.php';
  require_once 'article.php';

  final class ask
  {
      public $toShow = array();
      
      protected $mysqli;
      protected $result;
      
      public function __construct()
      {
          conn($this->mysqli);
      }
      
      public function __destruct()
      {
          $this->mysqli->close();
          
          if (isSet($this->result)) {
              $this->result->close();
          }
      }
      
      public function single($query)
      {
          // $this -> result = $this -> mysqli -> query ( $query . " LIMIT 1" );
          $this->result = $this->mysqli->query($query);
          
          if (!$obj = $this->result->fetch_object()) {
              Error('Not found that article in the records.');
          }
          
          $this->toShow[0] = new article($obj->Title, $obj->Body, $obj->Category, $obj->ID, $obj->Date);
      }
      
      public function multi($query)
      {
          $this->result = $this->mysqli->query($query);
          
          for ($count = 0; $obj = $this->result->fetch_object(); $count++) {
              $this->toShow[$count] = new article($obj->Title, $obj->Body, $obj->Category, $obj->ID, $obj->Date);
          }
          
          if ($count == 0) {
              Error('Not found any requested article from records.');
          }
      }
	  
	  public function get_field($query){
	       $this->result = $this->mysqli->query($query);
          
          for ($count = 0; $array = $this->result->fetch_array(); $count++) {
              $this->toShow[$count] = $array[0];
          }
          
          if ($count == 0) {
              Error('Not found any requested article from records.');
          }
	  }
  }
  
  /* End ask.php */
?>