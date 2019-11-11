<?php	

	
	require_once('DBconnect.php');

	function humanTiming ($time) {

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    	);

    	foreach ($tokens as $unit => $text) {
        	if ($time < $unit) continue;
        	$numberOfUnits = floor($time / $unit);
        	return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    	}
	}

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

		private $threadList = array();

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
						$singleThreadHandler = new bhg_single_thread($row['threadAuthor']);

						array_push($postListArray, $row);
					}
				}

			bhg_db_connect::close();

			return $postListArray;
		}

		function list_thread_by_tag($tag) {
			bhg_db_connect::initialize();

			$postListArray = array();

			$sql = "SELECT * FROM threads WHERE threadPrimaryTag='". $tag ."' ORDER BY time DESC";

			$result = bhg_db_connect::sqlQuery($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					
						array_push($postListArray, $row);
					}
				} else {
					$postListArray = NULL;
				}

			bhg_db_connect::close();

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
		private $threadReturn;
		
		function __construct($title, $body, $author)
		{
			$this->threadTitle = $title;
			$this->threadBody = $body;
			$this->threadAuthor = $author;
			$this->threadReturn['id'] = NULL;
		}

		function writeThread() {
			if ($this->threadTitle === "" || $this->threadAuthor === "") return false;

			bhg_db_connect::initialize();

			$this->threadTitle = bhg_db_connect::escape_string($this->threadTitle);
			$this->threadBody = bhg_db_connect::escape_string($this->threadBody);

			$sql = "INSERT INTO threads (threadTitle, threadBody, threadPrimaryTag, threadAuthor, time, lastModified) VALUES ('".$this->threadTitle."', '".$this->threadBody."', 'misc', '".$this->threadAuthor."', now(), now())";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Write Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return $this->threadReturn;
			}

			$sql = "SELECT * FROM threads WHERE threadTitle='". $this->threadTitle ."' AND threadAuthor='". $this->threadAuthor ."'";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Write Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return $this->threadReturn;
			}

			if($result->num_rows != 1) {
				bhg_db_connect::close();
				return $this->threadReturn;
			} else {
				$row = $result->fetch_assoc();
				$this->threadReturn = $row['threadID'];
			}

			bhg_db_connect::close();
			return $this->threadReturn;

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

			$sql = "SELECT * FROM posts WHERE userID='".$user."' ORDER BY time DESC";
			
			$result = bhg_db_connect::sqlQuery($sql);

			$this->totalPosts = $result->num_rows;

			if($this->totalPosts > 0) {
				while($row = $result->fetch_assoc()) {
					$this->allPosts[] = $row;
				}
			}

			bhg_db_connect::close();
			return $this->allPosts;
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
					$this->allPosts[] = $row;
				}
			}

			bhg_db_connect::close();
			return $this->allPosts;
		}
		
		function new_post($thread, $author, $body) {
			
			if ($thread == "" || $author == "" || $body == "") return false;

			bhg_db_connect::initialize();

			$date = date('Y-m-d H:i:s');

			$body = bhg_db_connect::escape_string($body);
			
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

		function update_post($id, $body) {

			bhg_db_connect::initialize();

			$date = date('Y-m-d H:i:s');

			$body = bhg_db_connect::escape_string($body);

			$sql = "UPDATE posts SET postBody='". $body ."', time='". $date ."' WHERE postID='". $id ."'";

			if(!$result = bhg_db_connect::sqlQuery($sql)) {
				error_log("Error In Update Thread Query ".bhg_db_connect::errorMessage());
				bhg_db_connect::close();
				return false;
			}

			bhg_db_connect::close();
			return true;
		}
	} //end of bhg_reply_post

	/**
	 * 
	 */
	class bhg_search
	{		
		private $searchTerm;
		private $searchResult = array();

		function __construct($term)
		{
			$this->searchTerm = $term;
		}

		function search_topic_title() {
			bhg_db_connect::initialize();

			$sql = "SELECT * FROM threads WHERE threadTitle LIKE '%".$this->searchTerm."%' OR threadBody LIKE '%".$this->searchTerm."%' ORDER BY time DESC";

			$result = bhg_db_connect::sqlQuery($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$this->searchResult[] = $row;
				}
			} else {
					$this->searchResult = NULL;
			}

			bhg_db_connect::close();
			return $this->searchResult;
		}
	} // end of bhg_search
?>