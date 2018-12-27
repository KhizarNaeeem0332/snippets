<?php 
 $array = ['d','b','c','d','a','b','a'];
    $totalSize = count($array);
	$matched = false;

for($i=0 ; $i < count($array) ; $i++)
{
    $key = getString($array , $i);
    
	if(!empty($key))
	 {
		for($j=0 ; $j < count($array) ; $j++)
   		 {
		if(getStringReverse($array , $j) == $key)
        {
			$matched = true;
        }
    } 
	 }
}


        
if($matched)
{
	echo "pattern match";
}
else
{
	echo "pattern not match";
}




function getString($array , $index)
{
    $str = "";
    for($i=0 ; $i< $index ; $i++)
    {
        $str .= $array[$i];
    }
    
    return $str;
}


function getStringReverse($array , $index)
{
    $str = "";
    for($i= count($array) - $index ; $i <  count($array) ; $i++)
    {
        $str .= $array[$i];
        $index++;
    }
    
    return $str;
}
