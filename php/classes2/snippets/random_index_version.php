<?php



$questions = [1,2,3,4,5,6,7,8,9];
$totalQuestions = count($questions);
$fthrow = floor($totalQuestions/2);
$trd = ceil($totalQuestions/2);



foreach($questions as $i => $q)
{
	$i = $i+1;


	$v1;
	$v2;
	$v3;
	$v4;

	//first and second
	$v1 =  $i; 
	$v2 = ($totalQuestions - $i +1 );

//third row
	if( $i > $trd )
	{
		$v3 =  ($i) - $trd;
	}
	if( $i <= $trd)
	{
		$v3 = ($totalQuestions - ($trd-$i));
	}

//fourth row
	if($i <= $fthrow)
	{
		$v4 =  $i + $i;
	}
	else {
		$v4 =  $i - $fthrow;
		$fthrow--;
	}

	echo "<br>";
}



?>
