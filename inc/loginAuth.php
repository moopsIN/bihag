<?php
	include_once('DBconnect.php');

	/**
	 * 
	 */
	class bhg_login
	{		
		private static $hash;

		private function __construct() {

		}

		function authenticate($user, $passcode)
		{
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM users WHERE username='".$user."'";
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$userID = $row['id'];

				$sql = "SELECT * FROM auth WHERE id='".$userID."'";
				$result = bhg_db_connect::sqlQuery($sql);

				$row = $result->fetch_assoc();
				self::$hash = $row['passcode'];

				if(password_verify($passcode, self::$hash)) return true;
				else return false;

			} else {
				return false;
			}
			bhg_db_connect::close();			
		}
	} //end of bhg_authenticate

?>