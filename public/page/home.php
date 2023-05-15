<?php
require_once("api/db.php");
$db = db();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<?php require_once("css"); ?>
	<style>
		body {
			min-height: 100vh;
			margin: 0;
			display: flex;
			flex-direction: column;
			flex-wrap: nowrap;
			justify-content: flex-start;
			align-items: center;
		}

		body>* {
			margin-top: 1rem;
			margin-bottom: 1rem;
		}

		#directory {
			display: flex;
			flex-direction: row;
			position: relative;
			align-items: center;
			justify-content: space-around;
			text-align: center;
			width: 90%;
		}

		button {
			width: 30%;
			padding: 2.5rem 1rem;
		}

		select {
			margin-top: 5rem;
			padding: 1rem;
		}

	</style>
</head>

<body>
	<a id="slook" href="/home">Slook</a>
	<select name="user" id="select_user" required>
		<option value="">Select a User</option>
		<?php
			foreach (command($db, "SELECT uid, email FROM User")->fetchAll() as $user) {
				echo "<option value=\"" . $user["uid"] . "\">" . $user["email"] . "</option>";
			}
		?>
	</select>
	<div id="directory">
		<button id="textchat" href="/msg" disabled>Text Chat</button>
		<button id="analytics" href="/analytics" disabled>Data Analytics</button>
		<!-- <button id="textchat_api" href="/message" disabled>Text Chat API</button> -->
	</div>
</body>

<script>
	window.history.replaceState(null, "", "/home");
	document.getElementById("select_user").addEventListener("change", (event) => {
		let select = event.target;
		const enabled = !!select.value;
		for (const btn of document.getElementById("directory").children) {
			btn.toggleAttribute("disabled", !enabled);
		}
		const expires = 60 * 60 * 24;
		if (enabled) {
			console.log("Login:", select.value);
			document.cookie = `uid=${select.value}; max-age=${expires}; path=/`;
		}
	})
	for (const btn of document.getElementById("directory").children) {
		btn.addEventListener("click", () => {
			window.location.href = btn.getAttribute("href");
		})
	}
</script>

</html>
