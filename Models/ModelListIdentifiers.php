<?php 

class ModelListIdentifiers extends AbstractModel implements ModelInterface
{
    private $from = '';
    private $until = '';
    private $set = '';
    
    public function __construct(HTTPRequest $http_request, Config $config)
    {
      if ($http_request->getKEV('from') !== '') {
        $this->from = $http_request->getKEV('from');
      } else {
        $this->from = $config->getParam('earliest_datestamp');
      }
      if ($http_request->getKEV('until') !== '') {
        $this->until = $http_request->getKEV('until');
      } else {
        $this->until = date("Y:m:d H:i:s");
      }
      if ($http_request->getKEV('set') !== '') {
        //HACK: append wildcard for quick partial set match
        $this->set = $http_request->getKEV('set') . '%';
      } else {
        $this->set = '%';
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
        WHERE 1=1
        AND `modified` >= :from
        AND `modified` <= :until
        HAVING `setSpec` LIKE :set
        ";
        try {
            $this->stmt = $this->dbh->prepare($sql);
            $arr = array(
              ':from'=>$this->from,
              ':until'=>$this->until,
              ':set'=>$this->set
              );
            $this->stmt->execute($arr);
            $this->rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
