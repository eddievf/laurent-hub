<?php
	session_start();

	$servername = "localhost";
	$dbuser = "root";
	$dbpass = "";

	$conn = new PDO("mysql:host=$servername;dbname=test", $dbuser, $dbpass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	

	$auth = $conn->prepare('SELECT userID,username,userpass
						  	   FROM testusers
							   WHERE username = :user');

	$username = $_POST['login_username'];
	$userpass = $_POST['login_password'];

	$auth->bindParam(':user', $username);
	$auth->execute();

	while($row=$auth->fetch(PDO::FETCH_ASSOC)){
		$authuser = $row['username'];
		$authhash = $row['userpass'];
	}

	if(\Sodium\crypto_pwhash_str_verify($authhash, $userpass)){
	//delete plain text from memory
		\Sodium\memzero($userpass);

		echo 1; 
	}

	else{
		\Sodium\memzero($userpass);
		echo 0;
	}

?>