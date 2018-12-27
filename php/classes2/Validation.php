<?php 


class Validation
{

    private $_passed = false , $_errors = array() , $_db = null ;
    private $errors_with_name = array();

    public function __construct()
    {
       // $this->_db = DB::getInstance();
    }


    public function check($source , $items = array() )
    {
        
        foreach ($items as $item => $rules) 
        {
            $item = escape($item);

            foreach ($rules as $rule => $rule_value)
            {
                $value = trim($source[$item]);
                $getArray  = explode('|', $rule);  // required | name is required
                $rule = trim($getArray[0]);
                $errorString = trim($getArray[1]);

                if($rule === 'required' && empty($value))
                {
                    $this->addError($errorString);
                    $this->addErrorWithName($item , $errorString);
                }
                else if(!empty($value))
                {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value)
                            {
                                $this->addError($errorString);
                                $this->addErrorWithName($item , $errorString);
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value)
                            {
                                $this->addError( $errorString);
                                $this->addErrorWithName($item , $errorString);
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value])
                            {
                                $this->addError($errorString);
                                $this->addErrorWithName($item , $errorString);
                            }
                            break;
                        case 'email':
                            if(!filter_var($value , FILTER_VALIDATE_EMAIL))
                            {
                                $this->addError($errorString);
                                $this->addErrorWithName($item , $errorString);
                            }
                            break;    
                        // case 'unique':
                        //     $check = $this->_db->get($rule_value , array($item , '=' , $value));
                        //     if($check->count())
                        //     {

                        //         $this->addError("{$item} already exist.");
                        //     }
                        //     break;      
                    }
                }


            }   
        }

        if(empty($this->_errors))
        {
            $this->_passed = true ;
        }
        return $this;

    }

    private function addError( $error)
    {
        $this->_errors[] = $error;
    }

    private function addErrorWithName($field , $error)
    {
        $this->errors_with_name[$field][] = $error;
    }

    public function passed()
    {
        return $this->_passed;
    }
    public function errors()
    {
        return $this->_errors;
    }

    public function errors_with_name()
    {
        return $this->errors_with_name;
    }

}


