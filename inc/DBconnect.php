<?php

class bhg_db_connect
{
    
    private static $init = FALSE;
    
    public static $conn;
    private static $servername = "localhost";
    private static $username = "bihagAdmin";
    private static $password = "getorade";
    private static $dbname = "bihagDB";
    
    public static function initialize()
    {
        if (self::$init===TRUE) return;
        self::$init = TRUE;
        self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);
        if (self::$conn->connect_error) {
          die("Connection failed: ");
        }
    }

    public static function sqlQuery($sql) {
      if (self::$init===FALSE) return;
      return self::$conn->query($sql);      
    }

    public static function close() {
      if (self::$init===FALSE) return;
      self::$init = FALSE;
      mysqli_close(self::$conn);
    }

    public static function errorMessage() {
      return mysqli_error(self::$conn);
    }

    public static function escape_string($var) {
      return self::$conn->real_escape_string($var);
    }
}

?>