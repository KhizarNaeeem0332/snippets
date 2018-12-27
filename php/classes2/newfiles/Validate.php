<?php 


class Validate
{

    private static $errorCount = 0;
    private static $errorList = [];


    public static function check($request  , $rules = [] , $msg = null)
    {  
        echo "checked called <br>";
        
        
        foreach($rules as $column => $rule)
        {
            $ruleList  = explode('|' , trim($rule));

            foreach($ruleList as $r)
            {
                switch($r)
                {
                    case "required":
                    {
                        //if field is empty then generate error
                        if($request[$column] == "" || $request[$column] == null)
                        {
                            self::$errorCount++;
                            self::$errorList[$column] = $request[$column] . " field is required";    
                        }
                        break;
                    }
                    default: {
                        break;
                    }
                }
            }

        }//all rules checking end


        if(self::$errorCount != 0)
        {
            return ['error'=> true , 'msgs' => self::$errorList ];
        }
        else
        {
            return ['error' => false  , 'msgs' => self::$errorList ];
        }
    }

}






$check = Validate::check(['name' => ''] , 
['name' => 'required']
);

echo "<pre>";
print_r($check);
