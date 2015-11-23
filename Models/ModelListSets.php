<?php 

class ModelListSets extends Model implements ModelInterface
{
    public function composeSQL()
    {
        $sql = "
            SELECT 
            CONCAT (`sets`.`id`, ':', `sub_sets`.`id`) AS `setSpec`,
            CONCAT (`sets`.`name`, ' / ', `sub_sets`.`name`) AS `setName`
            FROM `sets` 
            LEFT JOIN `sub_sets` on `sets`.`id` = `sub_sets`.`set_id`
            WHERE 1
            HAVING `setSpec` <> '' 
            ORDER BY `sets`.`name` ASC, `sub_sets`.`name` ASC
            ";
        try {
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->execute();
            $this->rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
