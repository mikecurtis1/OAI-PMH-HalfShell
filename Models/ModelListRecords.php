<?php 

class ModelListRecords extends AbstractModel implements ModelInterface
{
    public function composeSQL()
    {
        $sql = "";
        try {
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute();
            $this->rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
