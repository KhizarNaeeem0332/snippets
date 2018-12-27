<?php
echo "old.php";
/*
const DIRS = array(
	"CSS" => array(
		"DIR"=>"PATH",
		""
	)
)
*/


/*
function autoload_files($directory_name, $file_not_include=[])
{
	$directories = glob(strtolower($directory_name) . DIRECTORY_SEPARATOR . '*');
	foreach ($directories as $directory)
	{
		// this is a php file
		if(stripos($directory ,".php"))
		{
			if(!empty($file_not_include))
			{
				foreach ($file_not_include as $file)
				{
					$file = strtolower($file);
					if(!strpos($directory , $file .'.php'))
					{
						require_once $directory;
					}
				}
			}
			else
			{
				if(file_exists($directory))
					require_once $directory;
			}

		}
		else  //this is a directory
		{
			autoload_files($directory , $file_not_include);
		}
	}//foreach end
}

*/
/*


function class_autoload_files($directories , $class = '')
{

	if(strtolower($directories[0]) == strtolower(DIRECTORY_CONTROLLER))
	{
		//var_dump($directories);
		//file will be available in the root of controller directory
		if(file_exists($directories . DIRECTORY_SEPARATOR . strtolower($class) . '.php'))
		{
			require($directories . DIRECTORY_SEPARATOR . strtolower($class) . '.php') ;
		}
		else
		{
			$inner = glob($directories. DIRECTORY_SEPARATOR .  '*' , GLOB_ONLYDIR) ;
			var_dump($inner);
			//this will increment directory controllers/*
			class_autoload_files($inner , $class);
		}
	}//if end
	else
	{

		//var_dump($directories);
		foreach ($directories as $directory)
		{
			//echo $directory . '<br>';
			if(file_exists($directory . DIRECTORY_SEPARATOR . strtolower($class) . '.php' ))
			{
				require( $directory . DIRECTORY_SEPARATOR . strtolower($class) . '.php' ) ;
			}
			else
			{
				class_autoload_files($directory . DIRECTORY_SEPARATOR . '*' , $class);
			}
		}
	}
}



function config_autoload_files($directories)
{
	//var_dump(CONFIG_FILES_NOT_INCLUDE);
	foreach ($directories as $directory)
	{

		// this is a php file
		if(stripos($directory ,".php"))
		{
			if(!empty(CONFIG_FILES_NOT_INCLUDE))
			{
				foreach (CONFIG_FILES_NOT_INCLUDE as $file)
				{
					//$directory = "configs/filename.php";
					//str_config = "filename"
					$str_config = str_replace(STR_CONFIG . DIRECTORY_SEPARATOR,  '', $directory );
					if($str_config !=  $file . '.php'){
						if(file_exists($directory))
							require_once $directory;
					}
				}
			}
			else
			{
				if(file_exists($directory))
					require_once $directory;
			}

		}
		else  //this is a directory
		{
			$directories = glob($directory. DIRECTORY_SEPARATOR .  '*') ;
			config_autoload_files($directories);
		}
	}
}



function autoload_files($directories , $constantStr , $fileNotIncludes=[])
{
	//var_dump(CONFIG_FILES_NOT_INCLUDE);
	foreach ($directories as $directory)
	{

		// this is a php file
		if(stripos($directory ,".php"))
		{
			if(!empty($fileNotIncludes))
			{
				foreach (fileNotIncludes as $file)
				{
					//$directory = "configs/filename.php";
					//str_config = "filename"
					$str_config = str_replace(constantStr . DIRECTORY_SEPARATOR,  '', $directory );
					if($str_config !=  $file . '.php'){
						if(file_exists($directory))
							require_once $directory;
					}
				}
			}
			else
			{
				if(file_exists($directory))
					require_once $directory;
			}

		}
		else  //this is a directory
		{
			$directories = glob($directory. DIRECTORY_SEPARATOR .  '*') ;
			config_autoload_files($directories);
		}
	}//foreach end


	$GLOBALS['config'] = array(
	"directory" => array(
		"css" => 'dist/css',
		"css-alt" => 'dist/css/alt',
		"css-skins" => 'dist/css/skins',
	)
);


}

 */
