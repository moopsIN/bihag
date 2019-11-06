<?php
	/**
	 * 
	 */
	class bhg_session
	{		
		private function __construct()
		{
			# code...
		}

		function initialize($user, $id) {
			self::end();
			self::start();

			$_SESSION['userName'] = $user;
			$_SESSION['userID'] = $id;
			$_SESSION['id'] = session_id();
			$_SESSION['lastActive'] = time();
			$_SESSION['validate'] = true;
		}

		function start() {
			session_start();			
		}

		function end() {
			session_unset();
			session_destroy();			
		}

		function refresh() {
			session_regenerate_id();
			$_SESSION['id'] = session_id();			
		}

		function isValid() {			
			if ($_SESSION['validate']) return true;
			else return false;
		}

		function isActive() {			
			if(time() - $_SESSION['lastActive'] < 1800) return true;
			else return false;
		}

		function set_lastActive() {
			$_SESSION['lastActive'] = time();
			
		}

		function isLoggedIn() {
			self::start();
			
			if(self::isValid()) {
				if(self::isActive()) {
					self::refresh();
					self::set_lastActive();					
					return true;
				} else {
					self::end();					
					return false;
				}
			} else {				
				return false;
			}
		}

	} //end of bhg_session
?>