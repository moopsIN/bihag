<?php	

	include_once('DBconnect.php');

	/**
	 * 
	 */

	class bhg_list_threads {
		private $threadID;
		private $threadTitle;
		private $threadBody;
		private $threadPrimaryTag;
		private $threadAuthor;
		private $threadCreateTime;
		private $threadModifyTime;

		function display_thread_list($num_of_threads) {
			
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM threads ORDER BY time DESC LIMIT ".$num_of_threads;
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {

					echo "<div class='row'>";
					echo "<h4><a href='".$WEB_ROOT."/topic?id=".$row['threadID']."'>".$row['threadTitle']."</a></h4>";
					echo "</div>";

					echo "<div class='row'>";
					echo "<div class='col-xs-6'><strong>".strtoupper($row['threadPrimaryTag'])."</strong></div>";
					echo "<div class='col-xs-6 text-right'><strong>".$row['time']."</strong></div>";
					echo "</div>";

					echo "<div class='row'><hr></div>";
				}
				
			}
			bhg_db_connect::close();
		}

		function get_thread_list($user) {

			bhg_db_connect::initialize();

			$postListArray = array();

			if ($user === "all") {
				$sql = "SELECT * FROM threads ORDER BY time DESC";				
			} else {
				$sql = "SELECT * FROM threads WHERE threadAuthor='". $user ."' ORDER BY time DESC";
			}

			$result = bhg_db_connect::sqlQuery($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						array_push($postListArray, $row);
					}
				}

			return $postListArray;
		}

	} // end of bhg_list_threads

	/**
	 * 
	 */
	class bhg_single_thread
	{
		private $threadID;
		private $threadTitle;
		private $threadBody;
		private $threadPrimaryTag;
		private $threadAuthor;
		private $threadCreateTime;
		private $threadModifyTime;
		private $authorMetaData;

		function __construct($id) {
			bhg_db_connect::initialize();
			
			$sql = "SELECT * FROM threads WHERE threadID='".$id."'";
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$this->threadID = $row['threadID'];
				$this->threadTitle = $row['threadTitle'];
				$this->threadBody = $row['threadBody'];
				$this->threadAuthor = $row['threadAuthor'];
				$this->threadCreateTime = date('d-M-Y',strtotime($row['time']));
				$this->threadPrimaryTag = strtoupper($row['threadPrimaryTag']);
				$this->authorMetaData = array();
			}
			
			bhg_db_connect::close();
		}

		function get_thread_title() {
			return $this->threadTitle;
		}

		function get_thread_id() {
			return $this->threadID;
		}

		function get_thread_body() {
			return $this->threadBody;
		}

		function get_thread_create_time() {
			return $this->threadCreateTime;
		}

		function get_thread_primary_tag() {
			return $this->threadPrimaryTag;
		}

		function get_thread_author_metadata() {
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM users WHERE id='".$this->threadAuthor."'";
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$this->authorMetaData['name'] = $row['username'];
				$this->authorMetaData['id'] = $row['id'];				
			}

			bhg_db_connect::close();

			return $this->authorMetaData;
		}


	} //end of bhg_thread

	class bhg_user {
		private $userName;
		private $userID;
		private $totalThreads;
		private $listOfThreads = array();
		private $listOfPosts;

		function __construct($name) {
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM users WHERE username='".$name."'";
			$result = bhg_db_connect::sqlQuery($sql);

			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$this->userName = $row['username'];
				$this->userID = $row['id'];				
			}

			$sql = "SELECT * FROM threads WHERE threadAuthor='".$this->userID."'";
			$result = bhg_db_connect::sqlQuery($sql);

			$this->totalThreads = $result->num_rows;

			if($this->totalThreads > 0) {
				while($row = $result->fetch_assoc()) {
					$listOfThreads[] = $row;
				}
			}

			bhg_db_connect::close();
		}

		function get_user_name() {
			return $this->userName;
		}

		function get_user_id() {
			return $this->userID;
		}

		function get_user_thread_num() {
			return $this->totalThreads;
		}

		function get_user_thread_list() {
			return $this->listOfThreads;
		}
	} //end of bhg_user	

	/**
	 * 
	 */
	class bhg_update_user_profile
	{
		function update_avatar($filePath, $userID) {
			bhg_db_connect::initialize();

			bhg_db_connect::close();
		}
	}

	/**
	 * 
	 */
	class bhg_new_thread
	{
		private $threadTitle = "";
		private $threadBody = "";
		private $threadAuthor = "";
		
		function __construct($title, $body, $author)
		{
			$this->threadTitle = $title;
			$this->threadBody = $body;
			$this->threadAuthor = $author;

			error_log("initialized Variables ". $this->threadTitle.", ".$this->threadAuthor);
		}

		function writeThread() {
			if ($this->threadTitle === "" || $this->threadAuthor === "") return false;

			bhg_db_connect::initialize();

			$sql = "INSERT INTO threads (threadTitle, threadBody, threadPrimaryTag, threadAuthor, time, lastModified) VALUES ('".$this->threadTitle."', '".$this->threadBody."', 'misc', '".$this->threadAuthor."', now(), now())";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Write Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return false;
			}

			bhg_db_connect::close();
			return true;

		}
	} //end of bhg_new_thread	

	/**
	 * 
	 */
	class bhg_post
	{
		private $allPosts = array();
		private $totalPosts;

		function get_all_posts_from_user($user) {
			if (!isset($user) || empty($user) || $user < 1) return NULL;

			bhg_db_connect::initialize();

			$sql = "SELECT * FROM posts WHERE userID='".$user."'";
			
			$result = bhg_db_connect::sqlQuery($sql);

			$this->totalPosts = $result->num_rows;

			if($this->totalPosts > 0) {
				while($row = $result->fetch_assoc()) {
					$allPosts[] = $row;
				}
			}

			bhg_db_connect::close();
			return $allPosts;
		}

		function get_all_posts_from_thread($thread) {
			if (!isset($thread) || empty($thread) || $thread < 1) return NULL;

			bhg_db_connect::initialize();

			$sql = "SELECT * FROM posts WHERE threadID='".$thread."'";
			
			$result = bhg_db_connect::sqlQuery($sql);

			$this->totalPosts = $result->num_rows;

			if($this->totalPosts > 0) {
				while($row = $result->fetch_assoc()) {				

					$sql = "SELECT username FROM users WHERE id='".$row['userID']."'";
					$userResult = bhg_db_connect::sqlQuery($sql);
					$userRow = $userResult->fetch_assoc();

					$row['username'] = $userRow['username'];
					$allPosts[] = $row;
				}
			}

			bhg_db_connect::close();
			return $allPosts;
		}
		
		function new_post($thread, $author, $body) {
			
			if ($thread == "" || $author == "" || $body == "") return false;

			bhg_db_connect::initialize();

			$date = date('Y-m-d H:i:s');

			
			$sql = "INSERT INTO posts (userID, threadID, postBody, time) VALUES ('".$author."', '".$thread."', '".$body."', '". $date ."')";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Write Post Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return false;
			}

			$sql = "UPDATE threads SET lastModified='". $date ."' WHERE threadID='". $thread ."'";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Update Thread Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return false;
			}

			bhg_db_connect::close();
			return true;

		}
	} //end of bhg_reply_post
?>