//remove spaces from name
// khizar      naeem      ==>    khizar naeem
function removeSpaceName() 
{
	var str =  "khizar      naeem";
	alert( str.replace(/\s+/g, ' ') ); //show khizar naeem
}
