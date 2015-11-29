<?php 

class ModelGetRecord extends AbstractModel implements ModelInterface
{
    private $identifier = null;
    
    public function __construct(OAIIdentifier $identifier)
    {
        $this->identifier = $identifier;
    }
    
    public function composeSQL()
    {
        $sql = "
            SELECT 
                `identifier`, 
                `modified`, 
                IF(`status` = 0, 'deleted', 'active') AS `header_status`, 
                `author`, 
                `year`, 
                `title`, 
                `description`, 
                `isbn`, 
                `language_ISO639-3`, 
                CONCAT(`root_set`, ':', `sub_set`) AS `setSpec`
            FROM `books`
            WHERE `identifier` = :identifier
            ";
        try {
            $arr = array(
                ':identifier'=>$this->identifier->getIdentifier()
                );
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute($arr);
            $this->rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
