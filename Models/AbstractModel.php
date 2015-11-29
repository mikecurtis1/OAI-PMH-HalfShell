<?php

abstract class AbstractModel
{
    protected $dbh = null;
    protected $query = '';
    protected $stmt = false;
    protected $rows = null;
    
    public function connectSQL(Config $config)
    {
        $dsn = 'mysql:dbname=' . $config->getParam('mysql_dbname') . ';host=' . $config->getParam('mysql_host');
        $user = $config->getParam('mysql_user');
        $password = $config->getParam('mysql_password');
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    
    public function getSQLRows()
    {
        return $this->rows;
    }
}
