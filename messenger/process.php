<?php
date_default_timezone_set('Asia/Kolkata');
/*

CREATE DATABASE phpfirebase;

CREATE TABLE IF NOT EXISTS phpfirebase.users (
	id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uuid VARCHAR(36) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    UNIQUE KEY (uuid, username)
);

CREATE TABLE `chat_record`(
    `chat_uuid` VARCHAR(36) NOT NULL,
    `user_1_uuid` VARCHAR(36) NOT NULL,
    `user_2_uuid` VARCHAR(36) NOT NULL,
    UNIQUE KEY (chat_uuid)
);

ALTER TABLE users ADD fullname VARCHAR(100) NOT NULL AFTER uuid;

*/
ini_set('display_errors', 1);
require __DIR__.'/User.php';



//Create new account
if (isset($_POST['register_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') 
{	
	$user = new User();

	$fullname = $_REQUEST['fullname'];
	$username = $_REQUEST['username'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$imfile = $_FILES['image']['name'];
	$targetdir = 'userimages/';   
	$ext = pathinfo($imfile, PATHINFO_EXTENSION);
	$mcrtime = microtime();
	list($msec, $sec) = explode(" ",$mcrtime);
	$msec = str_replace(".","",$msec);
	$unique_image_id = $sec."_".$msec;
      // name of the directory where the files should be stored
    $imname = $unique_image_id.".".$ext; 
    $targetfile = $targetdir.$imname;

  if (move_uploaded_file($_FILES['image']['tmp_name'], $targetfile)) {

    		$resp = $user->createAccount($fullname, $username, $email, $password, $imname);
				echo json_encode($resp);
				exit();
  } else { 
    echo "Error Uploading!!!";
  }

	
		//user input validation required here -- start
		

		//user input validation required here -- end
	

	

}
//Login User
if (isset($_POST['login_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$user = new User();

	$username = $_POST['username'];
	$password = $_POST['password'];

	
		//user input validation required here -- start
		

		//user input validation required here -- end
	

	$resp = $user->loginUser($username, $password);
	echo json_encode($resp);
	exit();



}

if (isset($_POST['logoutUser'])) {
	
	$user = new User();
	$resp = $user->logout();
	echo json_encode($resp);
	exit();

}

if (isset($_POST['getUsers']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$user = new User();
	echo json_encode($user->getUsers());
	exit();

}

if (isset($_POST['connectUser']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$user = new User();
	echo json_encode($user->createChatRecord($_POST['user_1'], $_POST['user_2']));
	exit();
}

?>