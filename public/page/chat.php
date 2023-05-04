<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Text Chat</title>
	<?php require_once("css"); ?>
	<style>
		<?php require_once("asset/chat.css");
		?>

	</style>
</head>

<body>
	<aside>
		<h1><a href="/home" id="slook">Slook</a></h1>
		<select id="select_thread">
			<option value="">Select a Chat</option>
		</select>
		<div id="thread_members"></div>
	</aside>
	<header>
		<h2 id="thread_name">Thread Name</h2>
	</header>
	<main id="chatbox"></main>
	<footer>
		<form id="form_send">
			<input type="text" name="msg" required>
			<button id="btn_send" type="submit" disabled>Send</button>
		</form>
	</footer>
</body>

<?php
echo "<script>";
require_once("asset/chat.js");
echo "</script>";
?>


</html>
