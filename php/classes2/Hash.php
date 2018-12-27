<?php 

class Hash
{


	public function hashPassword($password)
	{
		return md5($password);
	}


	public function checkPassword($password , $hashPassword)
	{
		if($this->hashPassword($password) === $hashPassword)
		{
			return true ;
		}
		return false;
	}



}

 ?>