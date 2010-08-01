<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: feed_rss.php
   
   It provides the feed RSS.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009
   
   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see AUTHOR.TXT file)
   
   See LICENSE.TXT file for licensing details.
   */
   	header('Content-Type: application/xml; charset=utf-8');
   	require_once 'lib-php/ask.php';
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<rss version="0.92" xml:lang="en-EN.utf8">
	<channel>
		<title><?php echo $_SERVER[ 'SERVER_NAME' ]; ?></title>
		<link><?php echo 'http://'.$_SERVER[ 'SERVER_NAME' ] ?></link>
		<description><![CDATA[Informazioni in diretta da <?php echo $_SERVER[ 'SERVER_NAME' ] ?>]]></description>
<?php
	$request = new ask;
	$request->multi('SELECT * FROM Articles ORDER BY ID DESC LIMIT 12');
	foreach ( $request->toShow as $item ){
		echo "\t\t<item>\n".
			 "\t\t\t<title><![CDATA[" . $item -> title . "]]></title>\n".
			 "\t\t\t<link>" . "http://" . $_SERVER [ "SERVER_NAME" ] . "?p=" . $item -> id ."</link>\n".
			 "\t\t\t<description><![CDATA[" . $item -> body . "]]></description>\n".
			 "\t\t\t<category><![CDATA[" . $item -> category ."]]></category>\n".
			 "\t\t\t<pubDate>" . $item -> date . "</pubDate>\n".
			 "\t\t</item>\n";
	}
?>
	</channel>
</rss>
<?php
  /* End feed_rss.php */
?>