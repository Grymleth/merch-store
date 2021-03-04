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

    // write queries
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

/*
//Added
*/
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
				return (check_value($result)) ? $result : NULL;
			} else {
				$this->error = $this->throw_sql_exception($query);
				return false;
			}
		}
	}

    // exception calls/ error calls
    private function throw_sql_exception($state='') {
		if(!check_value($state)) {
			$error = $this->dbHandler->errorInfo();
		} else {
			$error = $state->errorInfo();
		}
		$errorMessage = '['.date('Y/m/d h:i:s').'] [SQL '.$error[0].'] ['.$this->db->getAttribute(PDO::ATTR_DRIVER_NAME).' '.$error[1].'] > '.$error[2];
		return $errorMessage;
	}

/*
//End
*/

    public function bind($parameter, $value, $type=null){
        switch(is_null($type)){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // execute prepared statement
    public function execute(){
        return $this->statement->execute();
    }

    // return an array
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // return a specific row as an object
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // get row count
    public function rowCount(){
        return $this->statement->rowCount();
    }

    
}

function check_value($value) {
    if((@count($value)>0 and !@empty($value) and @isset($value)) || $value=='0') {
        return true;
    }
}

?>