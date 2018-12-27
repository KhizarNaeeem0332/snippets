<?php
require_once("constants.php");
spl_autoload_register(function($class)
{
	autoload_class($class, CONTROLLER_DIR);
});

function autoload_class( $class,$directory_name=CONTROLLER_DIR )
{
	//echo "<br/><hr/>finding $class in : ".$directory_name."<br />";
	$cr_dir = $directory_name;
	//this will check file in parent directory means controllers/$class.cphp
	if(file_exists(ROOT_DIR. DIRECTORY_SEPARATOR .$cr_dir . DIRECTORY_SEPARATOR . strtolower($class) . '.php'))
	{
		//echo $class." load at ".ROOT_DIR.DIRECTORY_SEPARATOR.$cr_dir . DIRECTORY_SEPARATOR . strtolower($class) . '.php'."<br />";
		require_once(ROOT_DIR.DIRECTORY_SEPARATOR.$cr_dir . DIRECTORY_SEPARATOR . strtolower($class) . '.php');
		return true;
	}
	else
	{
		$directories = glob(ROOT_DIR. DIRECTORY_SEPARATOR .$cr_dir . DIRECTORY_SEPARATOR .  '*' , GLOB_ONLYDIR);
		//echo "<pre>";
		//var_dump($directories);
		//echo "</pre>";
		//die;
		foreach ($directories as $directory)
		{
			//echo "Looping in : ".$directory."<br />";

			$dir = str_replace(ROOT_DIR,'',$directory);
			//echo $dir. " vs " . str_replace(CONTROLLER_DIR.DIRECTORY_SEPARATOR,'',$dir);
			if (!in_array(str_replace(CONTROLLER_DIR.DIRECTORY_SEPARATOR,'',$dir),CONTROLLER_EXCLUDE_DIR))
			{
				$sts = autoload_class($class,$dir);
				if($sts)
					return $sts;
			}

		}
	}
	return false;

}


function autoload_config($file,$directory_name=CONFIG_DIR )
{

	if(is_array($file))  //abc,xyz
	{
		foreach($file as $f){

			if(!autoload_config($f,$directory_name)) {
				trigger_error ("Unable to load $f configuration.",E_USER_WARNING);
				if(DEVELOPMENT_MODE){
					echo "<pre>";
					print_r(debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,5));
					echo "</pre>";
				}
			}

		}
		return true;
	}

	//echo "<br/><hr/>finding $file in : ".$directory_name."<br />";
	$cr_dir = $directory_name;
	//this will check file in parent directory means controllers/$class.cphp
	if(file_exists(ROOT_DIR.$cr_dir . DIRECTORY_SEPARATOR . strtolower($file) . '.php'))
	{
		//echo $file." load at ".ROOT_DIR.DIRECTORY_SEPARATOR.$cr_dir . DIRECTORY_SEPARATOR . strtolower($file) . '.php'."<br />";
		require_once(ROOT_DIR.DIRECTORY_SEPARATOR.$cr_dir . DIRECTORY_SEPARATOR . strtolower($file) . '.php');
		return true;
	}
	else
	{
		$directories = glob(ROOT_DIR.$cr_dir . DIRECTORY_SEPARATOR .  '*' , GLOB_ONLYDIR);
		//echo "<pre>";
		//var_dump($directories);
		//echo "</pre>";
		//die;
		foreach ($directories as $directory)
		{
			//echo "Looping in : ".$directory."<br />";

			$dir = str_replace(ROOT_DIR,'',$directory);
			//echo $dir. " vs " . str_replace(CONFIG_DIR.DIRECTORY_SEPARATOR,'',$dir);
			if (!in_array(str_replace(CONFIG_DIR.DIRECTORY_SEPARATOR,'',$dir),CONFIG_EXCLUDE_DIR))
			{
				$sts = autoload_config($file,$dir);
				if($sts)
					return $sts;
			}

		}
	}

	return false;


}

//tag = cd,parent,root
function load($tag , $file_name , $sibling_dir='' , $require_type='require_once')
{

	$current_dir = '';
	$has_sibling = false;
	$sibling_dir = trim($sibling_dir);
	$ta = strtolower($tag);
	$files;
	if(is_array($file_name))
	{
		$files = $file_name;
	}
	else
	{
		$files = explode(',' , $file_name);
	}

	if(isset($sibling_dir) && $sibling_dir != null) {
		$has_sibling = true;
		if(substr($sibling_dir,-1) == '/' or substr($sibling_dir,-1) == '\\' )
			$sibling_dir = substr($sibling_dir,0,strlen($sibling_dir)-1);

		if(substr($sibling_dir,0,1) == '/' or substr($sibling_dir,0,1) == '\\' )
			$sibling_dir = substr($sibling_dir,1);

	}	


    switch ($tag)
    {
        case 'cd' :
        {
        	if($has_sibling) {
	    		$current_dir = ('./' .$sibling_dir .'/') ;
	    	}
		    else {
		    	$current_dir = ('./') ; // return current directory path
		    }

         	
            break;
        }
        case 'parent' :
        {
        	if($has_sibling) {
	    		$current_dir = ('./../' .$sibling_dir .'/') ;
	    	}
		    else {
		    	$current_dir = ( './../') ; // return current directory path
		    }		    

            break;
        }
        case 'root' :
        {
        	if($has_sibling) {
	    		$current_dir = (ROOT_DIR . DIRECTORY_SEPARATOR .$sibling_dir .'/') ;
	    	}
		    else {
		    	$current_dir = (ROOT_DIR. DIRECTORY_SEPARATOR ) ; // return current directory path
		    }
		    break;
		    
        }
        default:{
        	// if different/dynamic tag sent
        	// 
        	
        	foreach (FILE_LOAD_TAGS as $dtag => $path) {
        		if($tag == strtolower($dtag))
        		{
        			if(substr($path,-1) == '/' or substr($path,-1) == '\\' )
						$path = substr($path,0,strlen($path)-1);

					

        			if($has_sibling) {
	    				$current_dir = ($path.'/'.$sibling_dir .'/') ;
	    			}
		    		else {
		    			$current_dir = ($path.'/') ; // return current directory path
		    		}
        		}
        	}
        	/// if no dynamic tag found then try to lookup in cd
        	/*
        	
        	 if($current_dir == '')
        	{
        		user_error("$tag does not matched any path. Trying to load from CD",E_USER_WARNING);
        		return load('cd',$file_name,$sibling_dir,$require_type); 
        	}      
        	*/

            break;
        }
    }

    if($current_dir != '')
    {
	    foreach ($files as $f)
	 	{
	 		$file = $current_dir  . $f . '.php' ;
		 	load_require($file , $require_type);
	 	}
	 }
	 else {
	 	user_error("Unable to translate path for ($tag) file loading.",E_USER_WARNING);
	 	if(DEVELOPMENT_MODE){
		 	echo "<pre>";
		 	print_r(debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,5));
		 	echo "</pre>";
		 }
	 }       
}


function load_require($file , $require_type='require_once')
{
	$require_type = strtolower(trim($require_type));
    if($require_type == 'include_once')
    {
        if(file_exists($file)){
            include_once($file);
        }
        else{
           trigger_error("$file not found for including once.", E_USER_WARNING);
        }
    }

    if($require_type == 'include')
    {
        if(file_exists($file)){
            include($file);
        }
        else{
           trigger_error("$file not found for including.", E_USER_WARNING);
        }
    }

    if($require_type == 'require')
    {
        if(file_exists($file)){
            require($file);
        }
        else{
           trigger_error("$file not found for requiring.", E_USER_WARNING);
        }
    }

    if($require_type == 'require_once')
    {
        if(file_exists($file)){
            require_once($file);
        }
        else{
           trigger_error("$file not found for requiring once.", E_USER_WARNING);
        }
    }


}






function configs($file,$dir=CONFIG_DIR)
{
	if(!is_array($file))
		$file = explode(",",$file);
	
	autoload_config($file,$dir);
}

function initialize()
{
	require_once(CONFIG_DIR.DIRECTORY_SEPARATOR.'init.php');
	configs(CONFIG_AUTO_INCLUDE,CONFIG_DIR);
}

initialize();


