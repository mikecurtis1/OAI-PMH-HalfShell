<?php 

interface ModelInterface
{
    public function connectSQL(Config $config);
    
    public function composeSQL();
    
    public function getSQLRows();
}
