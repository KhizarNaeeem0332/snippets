<?php

class Database
{


	public static $instance = null;
	private $_dbh;
	private $_error ;
	private $_stmt ;


	private function __construct()
	{

		$dns  = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;

		$options = [ PDO::ATTR_PERSISTENT => true , PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

		try
		{
			$this->_dbh = new PDO($dns , DBUSER , DBPASS , $options);
		}
		catch (PDOException $e)
		{
			$this->_error = $e->getMessage();
		}
	}

	public static function getInstance()
	{
			if(!isset(self::$instance))
			{
					return self::$instance = new Database();
			}
			return self::$instance;
	}


	public function query($query)
	{
		$this->_stmt = $this->_dbh->prepare($query);
	}



	public function bind($values , $type = null)
	{


		foreach ($values as $param => $value)
		{
			if (is_null($type))
			{
			  switch (true) {
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
			}
			$this->_stmt->bindValue($param , $value , $type);
		}
	}

	public function execute()
	{
    	return $this->_stmt->execute();
	}

	public function result($type = null)
	{
	    $this->execute();

	    if(isset($type))
	    {
			return $this->_stmt->fetchAll($type);
	    }
	    return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function first($type = null)
	{
	    $this->execute();

	    if(isset($type))
	    {
			return $this->_stmt->fetch($type);
	    }
	    return $this->_stmt->fetch(PDO::FETCH_OBJ);
	}

	public function checkFirstExist()
	{
		$this->first();
		if($this->count() === 1 )
		{
			return true;
		}
		return false;
	}

	public function count()
	{
    	return $this->_stmt->rowCount();
	}


	public function lastInsertId()
	{
    	return $this->_dbh->lastInsertId();
	}


	public function beginTransaction(){
    return $this->_dbh->beginTransaction();
}

	public function endTransaction()
	{
    	return $this->_dbh->commit();
	}

	public function cancelTransaction()
	{
    	return $this->_dbh->rollBack();
	}


	public function debugDumpParams()
	{
    	return $this->_stmt->debugDumpParams();
	}

	public function getAll($table)
	{
		 $this->_dbh->query("select * from {$table}");
			return $this->_dbh->result();
	}

}
