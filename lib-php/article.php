<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: article.php

   Article data structur.
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

  class article
  {
      public $title;
      public $body;
      public $category;
	  public $id;
      public $date;

      public function __construct($title, $body, $category, $id=0, $date = "Undefined")
      {
          $this->title = $title;
          $this->body = $body;
          $this->category = $category;
		  $this->id=$id;
          $this->date = $date;
      }

	  public function XHTMLEncode ( ) {
		return '<div class=\'article\'><span class=\'date\'>'.$this->date.
				'</span><h2>' . $this->title.
				'</h2><span class=\'body\'>'.$this->body.
				'</span><span class=\'category\'>'.$this->category.
				'</span><span class=\'id\'>'.$this->id.'</span></div>';
	  }
  }

  /* End article.php */
?>