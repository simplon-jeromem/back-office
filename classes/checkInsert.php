<?php

class CheckInsert
{
    private $insertion;
    private $regEx = '/\W/' ;

    public function __construct($insertion)
    {
        $this->insertion = $insertion;
    }
    public function check(){

        preg_match($this->regEx, $this->insertion, $matches, PREG_OFFSET_CAPTURE, 3);
        if(sizeof($matches) === 0 && (strlen($this->insertion) >= 4) && (strlen($this->insertion) < 30)){
            return 1;
        }
        else{
            return 0;
        }
    }
}

?>