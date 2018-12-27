<?php
  
  require_once 'khizar/classes/arrays/Array.php';
  
  use khizar\classes\arrays\Arrays as Arrays;

  


  $array = new Arrays();
  $newArray = $array->removeSpacesFromArray(['khizar' , '' , '  ' , 'no' , 'bilal']);
    
  print_r($newArray);
  

 
  

?>