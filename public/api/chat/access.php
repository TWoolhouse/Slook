<?php
function vacs_thread(mixed &$db, $thread_uid, $user_uid) {
	if (command($db, "SELECT ThreadViewer.thread
	FROM ThreadViewer
	WHERE ThreadViewer.thread = ? AND ThreadViewer.user = ?", [
		bind(1, $thread_uid, PDO::PARAM_INT),
		bind(2, $user_uid, PDO::PARAM_INT)
	])->fetch() == false)
		throw new Err(403, "You do not have access to this thread");
}
?>
