<?php
namespace System\Driver;
use PDO;
class PDODriver extends Database{
    private static $instance;
    private $db = null;
    private $table;
    public function __construct($dbsetting){
        parent::__construct($dbsetting);
        $this->connect();
    }

    protected function connect(){
        if($this->db == null){
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

	public function getConnection(){
		if($this->db === null){
			$this->connect();
		}

		return $this->db;
	}

    protected function close(){
        $this->db = null;
    }
    
	//execute insert data to table
	public function insertTable($tablename,$columsname,$value){
		$colums = "";
		$values = "";
		$ic = 0;
		$iv = 0;
		$result = null;
		if(!is_array($columsname) && !is_array($value)){
			return false;
		}
		else if(count($columsname) != count($value)){
			return false;
		}
		else{
			while($ic < count($columsname)){
				if($ic+1 >= count($columsname)){
					$colums = $colums."`".$columsname[$ic]."`";
				}else{
					$colums = $colums."`".$columsname[$ic]."`,";
				}
				$ic++;
			}
			while($iv < count($value)){
				if($iv+1 >= count($value)){
					$values = $values."?";
				}else{
					$values = $values."?,";
				}
				$iv++;
			}
			try{
				$db 	  = $this->getConnection();
				$query  = "INSERT INTO ".$tablename."(".$colums.") VALUES(".$values.")";
				$exe 	  = $db->prepare($query);
				$exe->execute($value);
				$result = $db->lastInsertId();
				$this->close();
				unset($db);
				return $result;
			}catch(PDOException $e){
				$e->getMessage();
				$this->close();
			}
		}
	}

	// execute select table
	public function selectTable($tablename,$where,$value){
		$result = null;
		try{
			$db 	  = $this->getConnection();
			if(count($value) > 0){
				$query  = "SELECT * FROM ".$tablename." WHERE ".$where."";
			}else{
				$query  = "SELECT * FROM ".$tablename." ".$where."";
			}
			$exe 	  = $db->prepare($query);
			$exe->execute($value);
			$result = $exe->fetchAll(PDO::FETCH_ASSOC);
			$this->close();
			unset($db);
			return $result;
		}catch(PDOException $e){
				$e->getMessage();
				$this->close();
		}
	}

	// execute delete table
	public function delete($table,$where,$value){
		$result = null;
		try {
			$db 	  = $this->getConnection();
			$query  = "DELETE FROM ".$table." WHERE ".$where."";
			$exe 	  = $db->prepare($query);
			$result = $exe->execute($value);
			$this->close();
			unset($db);
			return $result;
		} catch (PDOException $e) {
			$e->getMessage();
			$this->close();
		}
	}

	//execute select table with specific colums
	public function selectColumsTable($colums,$table,$where,$value){
		$colum  = "";
		$ic 	  = 0;
		$result = null;
		if(!is_array($colums)){
			return $result;
		}else{
			while($ic < count($colums)){
				if($ic+1 >= count($colums)){
					$colum = $colum."`".$colums[$ic]."`";
				}else{
					$colum = $colum."`".$colums[$ic]."`,";
				}
				$ic++;
			}
			try{
				$db 	  = $this->getConnection();
				if(count($value) > 0){
					$query  = "SELECT ".$colum." FROM ".$table." WHERE ".$where."";
				}else{
					$query  = "SELECT ".$colum." FROM ".$table." ".$where."";
				}
				$exe 	  = $db->prepare($query);
				$exe->execute($value);
				$result = $exe->fetchAll(PDO::FETCH_ASSOC);
				$this->close();
				unset($db);
				return $result;
			}catch(PDOException $e){
				$e->getMessage();
				$this->close();
			}
		}
	}

	// execute update table
	public function update($table,$colums,$valupdate,$where){
		$colum  = "";
		$ic 		= 0;
		if(!is_array($colums) && !is_array($valupdate)){
			return false;
		}
		else if(count($colums) != count($valupdate)){
			return false;
		}
		else{
			if($valupdate != null){
				while($ic < count($colums)){
					if($ic+1 >= count($colums)){
						$colum = $colum.$colums[$ic]." = ?";
					}else{
						$colum = $colum.$colums[$ic]." = ?,";
					}
					$ic++;
				}
			}else{
				while($ic < count($colums)){
					if($ic+1 >= count($colums)){
						$colum = $colum.$colums[$ic]." = ".$valupdate[$ic];
					}else{
						$colum = $colum.$colums[$ic]." = ".$valupdate[$ic].",";
					}
					$ic++;
				}
			}
			try{
				$db 	 = $this->getConnection();
				$query = "UPDATE ".$table." SET ".$colum." WHERE ".$where."";
				$exe   = $db->prepare($query);
				$exe->execute($valupdate);
				$this->close();
				unset($db);
			}catch(PDOException $e){
				$e->getMessage();
				$this->close();
			}
		}
	}

	// execute raw query
	public function rawQuery($query,$value){
		$result = null;
		$block = explode(" ",$query);
		if($block == null || $block[0] == ""){
			return false;
		}else{
			if(strtolower($block[0]) == "select"){
				try{
					$db  		= $this->getConnection();
					$exe 		= $db->prepare($query);
					$exe->execute($value);
					$result = $exe->fetchAll(PDO::FETCH_ASSOC);
					$this->close();
					unset($db);
					return $result;
				}catch(PDOException $e){
					$e->getMessage();
					$this->close();
				}
			}
			else{
				try{
					$db  		= $this->getConnection();
					$exe 		= $db->prepare($query);
					$result = $exe->execute($value);
					$this->close();
					unset($db);
					return $result;
				}catch(PDOException $e){
					$e->getMessage();
					$this->close();
				}
			}
		}
	}
}