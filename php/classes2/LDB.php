<?php 
//dropdatabase
// droptable
class LDB extends DB
{
	public function __construct()
	{

		$dns  = "sqlite:" . LDBNAME;
		$options = [ PDO::ATTR_PERSISTENT => true , PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
		try 
		{
			$this->_dbh = new PDO($dns , LDBUSER , LDBPASS , $options); 
			echo "connected";
		} 
		catch (PDOException $e) 
		{
			$this->_error = $e->getMessage();
		}
	}

	public function executeAction($query)
	{
		return $this->_dbh->exec($query);
		
	}
}

 ?>
