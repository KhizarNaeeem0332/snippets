<?php 


class Helper 
{

	public static function getCity($db)
	{
		$db->query("select * from cities");
		if($db->execute())
		{
			return $db->result();
		}
		return ;
	}

	public static function notify($string , $type)
	{
		echo "<script> $.notify('{$string}' , '{$type}'); </script>";
	}

	
	public function logout()
	{
		Session::delete('EMAIL');
		Session::delete('PASSWORD');
		Session::delete('NAME');
		Cookie::delete("EMAIL");
		Cookie::delete("PASSWORD");
		Cookie::delete("NAME");
		Redirect::to('login.php');
	}

	//if isset session then return session
	public static function getSession($name)
	{
		return isset($_SESSION[$name]) ?  $_SESSION[$name] :  "" ;
	}

	//if isset cookie then return cookie
	public static function getCookie($name)
	{
		return isset($_COOKIE[$name]) ?  $_COOKIE[$name] :  "" ;
	}


	public static function shout($value , $type)
    {

        if($type == "success")
        {
            echo "<div class=\"alert alert-success alert-dismissible fade in marginTop10\" role=\"alert\" id='myAlert'>
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                  <strong>";
                if(is_array($value))
                {
                	echo "<ul>";
                	foreach ($value as $error)
                	{
                		echo "<li>{$error}</li>";
                	}
                	echo "<ul>";
                }
                else
                {
                	echo $value;
                }
            echo     "</strong>
               </div>";
        }

        if($type == "danger")
        {
            echo "<div class=\"alert alert-danger alert-dismissible fade in marginTop10\" role=\"alert\" id='myAlert'>
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                  <strong>";
                if(is_array($value))
                {
                	echo "<ul>";
                	foreach ($value as $error)
                	{
                		echo "<li>{$error}</li>";
                	}
                	echo "<ul>";
                }
                else
                {
                	echo $value;
                }
            echo "</strong>
               </div>";
        }


    }

	    public static function ValueIsset($string)
        {
            return isset($string) ? $string : '' ;
        }

        public static function Script($script , $type='text/javascript')
        {
            echo "<script type='{$type}'>{$script}</script>";
        }

         public static function randomNumber($min , $max , $size = 8)
        {
            $number = rand($min , $max);
            if(strlen($number) != $size)
            {
                $number = rand($min , $max);
            }
            return $number ; 
        }
	
	public static function getRestDate($day , $date)
	{
	  $dateday = strtolower( date("D" , strtotime("{$date}")) );
	  $day = strtolower($day);

	  if($dateday == $day){
	    return $date;
	  }

	  return false;

	}


	public static function incrementDate($date , $howmanydays)
	{
	    return date('Y-m-d', date(strtotime("+".$howmanydays." day", strtotime($date))));
	}



}





?>
