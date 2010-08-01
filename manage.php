<?php
  /*
   This file is part of (C)qpage, do not touch
   FILE: manage.php

   This script manages anything in the database.
   -------------------------------------------------------------------
   Author: Ongaro Mattia
   Begin: lun dec 24 2009

   -------------------------------------------------------------------
   (C) Copyright 2009: Ongaro Mattia (see list in AUTHOR.TXT file)

   See LICENSE.TXT file for licensing details.
   */
  session_start();
 
  require_once 'lib-php/manage.php';
  $manage = new manage;

  control();
?>
<html>
  <head>
	<meta name="robots" content="noindex, nofollow">

  	<link rel="shortcut icon" href="images/favicon.bmp"> 
	<link rel="icon" type="image/gif" href="images/favicon.bmp"> 

    <title>Admin Page</title>

    <link rel='stylesheet' type='text/css' href='css/admin.css'>
	
	<script type='text/javascript'>
		var last;
		function show ( element ){
			if ( last ) 
				document.getElementById(last).style.display='none';

			last = element;
			document.getElementById(element).style.display='block';
		}
	</script>
  </head>

  <body>
	<a href="index.php" id='logo'></a>
<?php
  if (!$manage->isUser()) {
      switch (@ $_GET['act']) {
          case 's_register':
?>
      <h1>Registration</h1>
      <form class='orange' action='?act=register' method='POST'>
        <p>Username: <input name='username'></p>
        <p>Password: <input type='password' name='password'></p>
        <p>Mail:<input name='mail'></p>
        <input type='submit' value='Register'>
      </form>
<?php
              break;
          case 'login':
              $manage->login(@ $_POST['username'], @ $_POST['password']); ?>
		<script type='text/javascript'>
			window.location = 'manage.php';
		</script>
<?php		  break;
          case 'register':
              register(@ $_POST['username'], @ $_POST['password'], @ $_POST['mail']); ?>
		<script type='text/javascript'>
			window.location = 'manage.php';
		</script>
<?php         break;
          case 'get_password':
?>
      <h1>LAMF the password!</h1>
      <p> You forgot the password, you're fucked. LOLOLOL.</p>
<?php
              break;
          default:
?>
    <h1>Login</h1>
    <p>You are not login yet, compile the module below this and click Login to make it.</p>
    <form class='orange' style='margin-left: auto; margin-right: auto; width: 35%; clear: both;' action='?act=login' method='POST'>
		<p>Username: <input name='username'></p>
		<p>Password: <input type='password' name='password'></p>
		<input type='submit' value='Login'>
    </form>

    <p>DID you forget the password? <a href='?act=get_password'>click here</a></p>
<?php
          }
      } elseif (isSet($_GET['act'])) {
          switch ($_GET['act']) {
              case 'edit':
                  if (!isSet($_POST['ID'])) {
                      Error('You must give me an ID to work.');
                  }
                  $query = 'UPDATE Articles SET';
                  if (!empty($_POST['title'])) {
                      $query .= ' Title=\'' . $_POST['title'] . '\',';
                  }
                  if (!empty($_POST['body'])) {
                      $query .= ' Body=\'' . $_POST['body'] . '\',';
                  }
                  if (!empty($_POST['category'])) {
                      $query .= ' Category=\'' . $_POST['category'] . '\',';
                  }

                  $query[strlen($query) - 1] = ' ';
                  $manage->alter_database($query . 'WHERE id=' . $_POST['ID'] . '');
                  break;
              case 'post':
                  $manage->alter_database('INSERT INTO Articles ( Title, Body, Category )  VALUES (\'' .
                  @ $_POST['title'] . '\', \'' .
                  @ $_POST['body'] . '\', \'' .
                  @ $_POST['category'] . '\');');
                  break;
              case 'delete':
                  $manage->alter_database('DELETE FROM Articles WHERE id=' . @ $_POST[ 'ID' ] . '');
                  break;
              case 'change_permission':
                  switch (@ $_POST['permission']) {
                      case 'Admin':
                          $permission = ADMIN;
                          break;
                      case 'User':
                          $permission = USER;
                          break;
                      default:
                          Error('InvalID permission.');
                  }

                  $manage->alter_database('UPDATE Users SET Permission=\'' . $permission . '\' WHERE Username=' . @ $_POST['username'] . '');
                  break;
              case 'change_username':
                  if (strlen($_POST['username']) < 4) {
                      Error('Username must be more than 3 characters.');
                  }
                  $manage->chUsername(@ $_POST['username']);
                  break;
              case 'change_password':
                  if (strlen($_POST['password']) < 8) {
                      Error('Password must be more than 7 characters.');
                  }

                  $manage->chPassword($_POST['username']);
                  break;
			  case 'change_mail':
				 if ( ! filter_var ( @ $_POST['mail'], FILTER_VALIDATE_EMAIL ) ) {
					Error("E-Mail is not valid.");
				 }
				 
				 $manage->alter_database('UPDATE Users Mail=\'' . @ $_POST['username'] . '\' WHERE Username=\''.$manage->user->username().'\'');
				 break;
              case 'logout':
                  $manage->logout();
                  break;
              default:
                  Error('Action doesn\'t exist.');
          }
?>
  <h1> Action </h1>
  <p> Action performed successfully </p>
  <script type='text/javascript'>
	window.location = 'manage.php';
  </script>
<?php
    } elseif ($manage->permission() == ADMIN) {
?>
    <h1>Admin Panel</h1>
    <p>You are logged, now you can change anything you want to.</p>
	<ul id="menu">
		<li><a href="#">Article</a><ul>
			<li><a href="javascript: show ( 'post' );">Add</a></li>
			<li><a href="javascript: show ( 'edit' );">Edit</a></li>
			<li><a href="javascript: show ( 'delete' );">Delete</a></li></ul>
		</li>
		<li><a href="#">Change Profile</a><ul>
			<li><a href="javascript: show ( 'username' );">Username</a></li>
			<li><a href="javascript: show ( 'password' );">Password</a></li>
			<li><a href="javascript: show ( 'mail' );">Mail</a></li></ul>
		</li>
		<li><a href="javascript: show ( 'change_permission' );">Change Permission</a></li>
		<li><a href="manage.php?act=logout">Logout</a></li>
	</ul>

	<div class='orange' id='intro'>
		<p>Welcome <b><?php echo $manage -> username ( );?></b>, this is the panel to manage
		qpage database</p>
		<p><b>Info</b> in a summarize<br />
		<b>a) head.php</b>, here you can edit the head of every page;<br />
		<b>b) foot.php</b>, foot of every page;<br />
		<b>c) style.css</b>, the style sheet of every page but management page.</p>
		<b>Don't touch php snippet if you don't know it well;</b><br /><br />
		<p>For other informations see <a href='docs/'>documentation</a> in 'docs/'.</p>
	</div>
	<?php
		if(isset($_GET['edit'])){
            if (!isSet($_GET['edit'])) {
                Error('You must give me an article ID to work.');
            }

			require_once 'lib-php/ask.php';
			$request=new ask;
			$request->single('SELECT * FROM Articles WHERE ID=\'' . intval($_GET['edit']) . '\' LIMIT 1');

			echo "<div class='act' style='display: block'><form action='?act=edit' method='POST'><input type='hidden' name='ID' value='".$_GET['edit'].
			 "'><p>Title: <input name='title' value='".$request->toShow[0]->title.
			 "'></p><p>Category: <input name='category' value='".$request->toShow[0]->category.
			 "'></p><p><textarea rows=20 name='body'>".$request->toShow[0]->body.
			 "</textarea></p><input type = 'submit' value = 'Edit'></form></div>";
		}
	?>
	<div class='act' id='change_permission'>
		<form action='?act=change_permission' method='POST'>
			<p>Username: <input name='username'></p>
			<p>Permission: <input name='permission'></p>
			<input type = 'submit' value = 'Send'>
		</form>
	</div>
	<div class='act' id='delete'>
		<form action='?act=delete' method='POST'>
			<p>ID's article: <input name='ID'></p>
			<input type = 'submit' value = 'Delete'>
		</form>
	</div>
	<div class='act' id='edit'>
		<form action='manage.php?' method='GET'>
			<p>ID's article: <input name='edit'></p>
			<input type = 'submit' value = 'Load'>
		</form>
	</div>
	<div class='act' id='post'>
		<form action='?act=post' method='POST'>
			<p>Title: <input name='title'></p>
			<p>Category: <input name='category'></p>
			<p><textarea rows=20 name='body'></textarea></p>
			<input type='submit' value='Post'>
		</form>
	</div>
	<div class='act' id='username'>
		<form action='?act=change_username' method='POST'>
			  <p>New Username: <input name='username'></p>
			  <input type = 'submit' value = 'Send'>
		</form>
	</div>
	<div class='act' id='password'>
		You will receve a mail of confirmation.
		<form action='?act=change_password' method='POST'>
		  <p>New Password: <input name='password'></p>
		  <input type = 'submit' value = 'Send'>
		</form>
	</div>
	<div class='act' id='mail'>
		<form action='?act=change_mail' method='POST'>
			  <p>New Mail:<input name='mail'></p>
			  <input type = 'submit' value = 'Send'>
		</form>
	</div>
<?php
      } else {
?>
  <h1>User Panel</h1>

	<ul id="menu">
		<li><a href="#">Change Profile</a><ul>
			<li><a href="javascript: show ( 'username' );">Add</a></li>
			<li><a href="javascript: show ( 'password' );">Edit</a></li>
			<li><a href="javascript: show ( 'mail' );">Delete</a></li></ul>
		</li>
		<a href="manage.php?act=logout">Logout</a>
	</ul>

	<div class='orange' id='intro'>
		<p>Welcome <?php echo $manage -> username ( );?>, this is the panel to manage
		your account, use the link above.</p>
		<p>For other informations see <a href='doc/'>documentation</a>.</p>
	</div>

	<div class='act' id='username'>
		<form action='?act=change_username' method='POST'>
			  <p>New Username: <input name='username'></p>
			  <input type = 'submit' value = 'Send'>
		</form>
	</div>
	<div class='act' id='password'>
		You will receve a mail of confirmation.
		<form action='?act=change_password' method='POST'>
		  <p>New Password: <input name='password'></p>
		  <input type = 'submit' value = 'Send'>
		</form>
	</div>
	<div class='act' id='mail'>
		<form action='?act=change_mail' method='POST'>
			  <p>New Mail:<input name='mail'></p>
			  <input type = 'submit' value = 'Send'>
		</form>
	</div>
<?php
      }
	  copyright ( );
?>
  </body>
</html>
<?php
      /* End of index.php */
?>
