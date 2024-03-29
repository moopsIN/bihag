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
				$userID = intval($row['id']);
				$userLevel = intval($row['level']);

				$sql = "SELECT * FROM auth WHERE id='".$userID."'";
				$result = bhg_db_connect::sqlQuery($sql);

				$row = $result->fetch_assoc();
				self::$hash = $row['passcode'];

				bhg_db_connect::close();

				if(password_verify($passcode, self::$hash)) {
					$login['valid'] = true;
					$login['id'] = $userID;
					$login['level'] = $userLevel;					
				}
				else {
					$login['valid'] = false;
					$login['id'] = NULL;
					$login['level'] = NULL;					
				}

			} else {
				bhg_db_connect::close();
				$login['valid'] = false;
				$login['id'] = NULL;
				$login['level'] = NULL;
				
			}
		  return $login;			
		}
	} //end of bhg_authenticate

?>