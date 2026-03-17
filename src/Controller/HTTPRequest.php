<?php 

class HTTPRequest 
{
    private $kev = array();
    
    public function __construct()
    {
        if (isset($_REQUEST)) {
            foreach ( $_REQUEST as $key => $value) {
                $this->kev[$key] = $value;
            }
        }
    }
    
    public function getKEV($key='')
    {
        if (! is_string($key)) {
            return '';
        }
        if (isset($this->kev[$key])) {
            return $this->kev[$key];
        } else {
            return '';
        }
    }
    
    public function getArray()
    {
        return $this->kev;
    }
}
