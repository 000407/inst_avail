<?php
if (isset($_POST["login"])) {
	$username = strtolower($_POST["username"]);
	$password = $_POST["password"];

	$sql = "SELECT * FROM app_user WHERE username=:username";
	$pdo = getDb();

	$stmt = $pdo->prepare($sql);
	$stmt->execute(["username" => $username]);

	$error = "Invalid username and/or password";

	if ($user = $stmt->fetch()) {
		$stored_pw = $user["passwd"];

		if (password_verify($password, $stored_pw)) {
			$error = null;

			$_SESSION["user"] = [
				"index" => $user["id"],
				"username" => $user["username"]
			];
		}
	}
}
