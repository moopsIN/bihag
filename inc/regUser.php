<?php

	include_once('DBconnect.php');

	/**
	 * 
	 */
	class bhg_register_user
	{
		private static $hash;

		private function __construct() {

		}

		function register($user, $passcode)
		{
			bhg_db_connect::initialize();

			$sql = "INSERT INTO users (username) VALUES ('".$user."')";
			
			if(bhg_db_connect::sqlQuery($sql)) {
				
				$sql = "SELECT * FROM users WHERE username='".$user."'";
				if(!$result = bhg_db_connect::sqlQuery($sql)) {
					bhg_db_connect::close();
					return false;
				}

				$row = $result->fetch_assoc();

				$userID = $row['id'];
				$hash = password_hash($passcode, PASSWORD_ARGON2I);

				$sql = "INSERT INTO auth (id, passcode) VALUES ('". $userID ."', '". $hash ."')";

				if(bhg_db_connect::sqlQuery($sql)) {
					bhg_db_connect::close();
					return true;
				} else {
					bhg_db_connect::close();
					return false;
				}
				
			} else {
				bhg_db_connect::close();
				return false;
			}
						
		}
	} //end of bhg_authenticate
	
?>