<?php

class  Input
{
	//form control or button name = $value , Form type = $type (post, get)
	public static function exists($value , $type = 'post')
	{
		switch ($type) 
		{
			case 'post':
				return (!empty($_POST[$value])) ? true : false ;
				break;

			case 'get':
				return (!empty($_GET[$value])) ? true : false ;
				break;

			default:
				return false;
				break;
		}
	}

	//return textbox value
	public static function get($item)
	{
		if(isset($_POST[$item]))
		{
			return $_POST[$item];
		}
		else if(isset($_GET[$item]))
		{
			return $_GET[$item];
		}
		return '';
	} 

}//class Input end



?>