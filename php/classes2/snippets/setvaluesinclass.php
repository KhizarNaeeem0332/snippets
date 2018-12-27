  function setValues($values = [])
    {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
        //return $this->checkValues($this->pid);
    }
