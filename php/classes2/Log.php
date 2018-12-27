<?php 



class Log
{

	public static function displayError($errors)
	{
		echo "<ul>";
		foreach ($errors as $error) 
		{
			echo $error;
		}
		echo "</ul>";
	}


}


 ?>