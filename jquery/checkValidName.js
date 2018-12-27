$(document).ready(function(){

var data = "khizar naeem0332";
var pattern = /^[a-zA-Z\s]+$/;

   if(data.match(pattern))  
     {  
         alert("Valid Name");
     }  
   else  
     {         
        alert("InValid Name");
     } 

});
