<?php 

class OAIIdentifier
{
    private $urn = '';
    private $base = 'urn';
    private $host = '';
    private $database = '';
    private $table = '';
    private $identifier = '';
    
    private function __construct($match)
    {
        $this->urn = $match[0];
        $this->base = $match[1];
        $this->host = $match[2];
        $this->database = $match[3];
        $this->table = $match[4];
        $this->identifier = $match[5];
    }
    
    public static function build($urn='')
    {
        if (preg_match("/^(urn)\:(.+?)\/(.+?)\:(.+?)\:(.+?)$/", $urn, $match)) {
            return new OAIIdentifier($match);
        } else {
            return false;
        }        
    }
    
    public function getURN()
    {
        return $this->urn;
    }
    
    public function getBase()
    {
        return $this->base;
    }
    
    public function getHost()
    {
        return $this->host;
    }
    
    public function getDatabase()
    {
        return $this->database;
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
