<?php

class Json
{
	private $file ; //file name with path 
	public function __construct($file)
	{
        if(file_exists($file))
        {
            $this->file = $file;
        }
        else
        {
            die("file not exists");
        }
	}

	public function result()
	{
		$file = file_get_contents($this->file);
		return json_decode($file);
	}

	public function resultByNode($node)
	{
		$file = file_get_contents("{$this->file}");
		return json_decode($file)->$node;
	}

	public function resultById($id , $node)
    {
        $data = $this->result();
        return  $data->$node[$id];
    }

    public function getLastId($node , $primaryKey = 'id')
    {
      	$data = $this->result();

      	$last_id = 0 ;

      	foreach ($data->$node as $record)
      	{
      		if(!isset($record->$primaryKey))
      		{
      			return 0;
      		}
      		if($record->$primaryKey > $last_id )
      		{
      			$last_id = $record->$primaryKey;
      		}
      	}
      	return  $last_id ;
    }


	public function insert($node , $values)
	{
		$data = $this->result();
		if(count($data->$node) === 0)
		{
			array_push($data->$node , $values);
			if(file_put_contents($this->file , json_encode($data)))
			{
				return true;
			}
		}
		else
		{
			foreach ($values as $column => $value) 
	        {
	        	if(!isset($data->$node[0]->$column))
	        	{
	        		return false;
	        	}
	        }
	        array_push($data->$node , $values);
			if(file_put_contents($this->file , json_encode($data)))
			{
				return true;
			}
		}
		
		return false;
	}

	public function delete($id , $node , $columns)
	{
		$data = $this->result();
        if($this->idExist($id , $node , $columns[0] ))
        {
        	foreach ($columns as $column) 
	        {
	        	if(!isset($data->$node[$id]->$column))
	        	{
	        		return false;
	        	}
	        	unset( $data->$node[$id]->$column);	
	        }
			$delete = file_put_contents($this->file , str_replace(array('{},' , ',{}','{}'), '', htmlspecialchars(json_encode($data), ENT_NOQUOTES)));
			if($delete)
			{
				return true ;
			}
			return false;
        }
        else
        {
            foreach ($columns as $column)
            {
                if(!isset($data->$node[$id]->$column))
                {
                    return false;
                }
                unset( $data->$node[$id]->$column);
            }
            $delete = file_put_contents($this->file , str_replace(array('{},' , ',{}','{}'), '', htmlspecialchars(json_encode($data), ENT_NOQUOTES)));
            if($delete)
            {
                return true ;
            }
            return false;
        }
	}


    /**
     * @param $id
     * @param $node
     * @param array $values
     * @return bool
     */
    public function update($id , $node , $values=[])
    {
        $data = $this->result();
        foreach ($values as $column => $value)
        {
        	$data->$node[$id]->$column = $value;
        }
        $update = file_put_contents($this->file , json_encode($data));
        if($update)
        {
        	return true;
        }
        return false;
    }


    public function idExist($id , $node , $column)
    {
    	$data = $this->result();
    	$dbId = $this->getLastId($node, $column) - 1 ;
    	foreach ($data->$node as $value)
    	{
    		if($id <= $dbId)
    		{
    			return true;
    		}
    	}
    	return false;
    }


}//class  Json end
