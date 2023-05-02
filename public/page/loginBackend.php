<?php
session_start();

	$servername = "localhost";
	$dbusername = "slook";
	$dbpassword = "slook";
	$dbname = "dbagent";
	$dbport = "3306";
	$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname,$dbport);

	if (!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

if (!empty($_POST['submitted'])) {
	//checks if email and password match those in database


    $email = $_POST["email"];
    $passwordInput = $_POST["password"];
    $sql = "SELECT uid, password, role FROM User where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);

	$uid = $data["uid"];
    $dbPassword = $data["password"];
    $role = $data["role"];

	//sets the session variables
    if ($passwordInput == $dbPassword)){
		$_SESSION["email"] = $email;
		$_SESSION["uid"] = $uid;
		$_SESSION["role"] = $role;
        echo true;
    }else{
        echo false;
    }
}
else{
	echo "error: not found";
}

?>

