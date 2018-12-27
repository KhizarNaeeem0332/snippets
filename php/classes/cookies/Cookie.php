<?php


namespace Khizar\Classes\Cookies ;

class Cookie
{

	public static function exists($name)
	{
		return (isset($_COOKIE[$name])) ? true : false;
	}

	public static function put($name , $value , $expiry , $path = '/' , $domain="" , $security=0)
	{
		if(setcookie($name , $value ,  $expiry , $path , $domain , $security))
		{
			return true;
		}
		return false;
	}

	public static function get($name)
	{
		return $_COOKIE[$name];
	}

	public static function delete($name)
	{
		self::put($name , ""  , time() + 432000);
	}


}
