<?php

	include_once('session.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ../login?message=Login%20Required");
		exit();
	} else {
		$user = new bhg_user($_SESSION['userName']);

		if ($user->get_user_level() !== 99) {
			header("Location: ../dash");
			exit();
		} 		
	}

	require_once('DBconnect.php');
	require_once('core.php');

	/**
	 * 
	 */
	class bhg_admin_stats
	{
		private $adminToken = NULL;
		private $userID = NULL;
		private $totalUsers = NULL;
		private $totalThreads = NULL;
		private $totalPosts = NULL;
		private $threadList = NULL;
		
		function __construct($id)
		{
			$this->userID = intval($id);
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM users WHERE id='".$id."'";
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$level = intval($row['level']);

				if ($level === 99) {
					$this->adminToken = md5(uniqid(rand(), true));
				} else {
					$this->adminToken = NULL;
				}
			}

			if($this->adminToken !== NULL) {
				$sql = "SELECT id FROM users";
				$result = bhg_db_connect::sqlQuery($sql);
				$this->totalUsers = $result->num_rows;

				$sql = "SELECT threadID FROM threads";
				$result = bhg_db_connect::sqlQuery($sql);
				$this->totalThreads = $result->num_rows;

				$sql = "SELECT postID FROM posts";
				$result = bhg_db_connect::sqlQuery($sql);
				$this->totalPosts = $result->num_rows;
			}

			bhg_db_connect::close();
		}

		function get_admin_token($id) {
			
			if(intval($id) !== $this->userID) {
				return NULL;
			}

			return $this->adminToken;
		}

		function get_total_users ($token) {
			if ($token !== $this->adminToken) return NULL;

			return $this->totalUsers;
		}

		function get_total_threads ($token) {
			if ($token !== $this->adminToken) return NULL;

			return $this->totalThreads;
		}

		function get_total_posts ($token) {
			if ($token !== $this->adminToken) return NULL;

			return $this->totalPosts;
		}

		function get_list_of_threads ($token) {
			if ($token !== $this->adminToken) return NULL;
			$this->threadList = array();
			$threadListHandler = new bhg_list_threads;
			$this->threadList = $threadListHandler->get_thread_list("all");
			return $this->threadList;
		}
	}
?>