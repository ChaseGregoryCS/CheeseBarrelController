<?php
    DEFINE('DB_USER', '----');
    DEFINE('DB_PASSWORD','----');
    DEFINE('DB_HOST', '-----');
    DEFINE('DB_NAME','----');
    
    class dbConnectObj {
        public $dbc;
        
        public function __construct(){
            $this->dbc = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            
            if ($this->dbc->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
        }
    }
?>
