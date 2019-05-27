<?php
class baby 
{   
    protected $skyobj;  
    public $aaa;
    public $bbb;
    function __construct() 
    {      
        $this->skyobj = new sec;
    }  
    function __toString()      
    {          
        if (isset($this->skyobj))  
            return $this->skyobj->read();      
    }  
}  

class cool 
{    
    public $filename;     
    public $nice;
    public $amzing; 
    function read()      
    {   
        $this->nice = unserialize($this->amzing);
        $this->nice->aaa = $sth;
        if($this->nice->aaa === $this->nice->bbb)
        {
            $file = "./{$this->filename}";        
            if (file_get_contents($file))         
            {              
                return file_get_contents($file); 
            }  
            else 
            { 
                return "you must be joking!"; 
            }    
        }
    }  
}  
  
class sec 
{  
    function read()     
    {          
        return "it's so sec~~";      
    }  
}  