function checkRequestHasName()
{
    $aidrequestarr = ['aid' , 'eaid'];
    $columnexists = array_values(  array_intersect($aidrequestarr, array_keys($_REQUEST)) ) ; // aid value
    
    $validaids = array_merge([$aid],$kins);
    
    if (count($columnexists) !==  0) {
    
        if($_REQUEST[$columnexists[0]] != $aid || ( !empty($kins) && $_REQUEST[$columnexists[0]] != $aid && !in_array($_REQUEST[$columnexists[0]] , $kins) )  )
        {
            echopre( "invalid student" );
        }
        else
        {
            echopre( "valid student" );
        }
    
    
    }
}
