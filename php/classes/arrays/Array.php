<?php

namespace khizar\classes\arrays;
  
 class Arrays
{
    
   

 
  public function removeSpacesFromArray($array)
  {
      $newArray = [];
    
      foreach($array as $value)
      {
          if(!empty( trim( $value ) ) )
          {
              $newArray[] = $value ;
          }
      }
      return $newArray;
    
  } //function removeSpacesFromArray end
  
  
  
}//class end

