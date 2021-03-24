<?php 

class Database{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName){
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
        
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ); 

        try{
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // simplified query
    public function query($sql, $array='') {
		if(!is_array($array)) $array = array($array);
		$query = $this->dbHandler->prepare($sql);
		if (!$query) {
			$this->error = $this->throw_sql_exception();
			$query->closeCursor();
			return false;
		} else {
			if($query->execute($array)) {
				$query->closeCursor();
				return true;
			} else {
				$this->error = $this->throw_sql_exception($query);
				return false;
			}
		}
	}

    // simplified fetch single
    public function query_fetch_single($sql, $array='') {
		$ret = $this->query_fetch($sql, $array);
		return (isset($ret[0])) ? $ret[0] : NULL;
	}

    // simplified fetch all
    public function query_fetch($sql, $array='') {
		if(!is_array($array)) $array = array($array);
		$query = $this->dbHandler->prepare($sql);
		if (!$query) {
			$this->error = $this->throw_sql_exception();
			$query->closeCursor();
			return false;
		} else {
			if($query->execute($array)) {
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				$query->closeCursor();
				return (Common::checkValue($result)) ? $result : NULL;
			} else {
				$this->error = $this->throw_sql_exception($query);
				return false;
			}
		}
	}

    // exception calls/ error calls
    private function throw_sql_exception($state='') {
		if(!Common::checkValue($state)) {
			$error = $this->dbHandler->errorInfo();
		} else {
			$error = $state->errorInfo();
		}
		$errorMessage = '['.date('Y/m/d h:i:s').'] [SQL '.$error[0].'] ['.$this->db->getAttribute(PDO::ATTR_DRIVER_NAME).' '.$error[1].'] > '.$error[2];
		return $errorMessage;
	}    
}	

?>