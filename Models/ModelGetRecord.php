<?php 

class ModelGetRecord extends AbstractModel implements ModelInterface
{
    private $record_id = '';
    private $urn = '';
    
    public function __construct(HTTPRequest $http_request, Config $config)
    {
        if ($oai_identifier = OAIIdentifier::build($http_request->getKEV('identifier'))) {
            $this->record_id = $oai_identifier->getRecordID();
            $this->urn = $oai_identifier->getURN();
        }
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
                CONCAT('urn:ISBN:', `isbn`) AS `isbn`, 
                `language_ISO639-3`, 
                CONCAT(`root_set`, ':', `sub_set`) AS `setSpec`
            FROM `collection` 
            WHERE `identifier` = :identifier
            ";
        try {
            $arr = array(
                ':identifier'=>$this->record_id
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
        return $this->record_id;
    }
    
    public function getURN()
    {
        return $this->urn;
    }
}
