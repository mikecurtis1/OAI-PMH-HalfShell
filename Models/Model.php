<?php

/*

http://webservices.itcs.umich.edu/mediawiki/oaibp/index.php/Deleted_Record_Example_1

SELECT 
    CONCAT('urn:example.com/half_shell:books:', `identifier`) AS `identifier`, 
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
ORDER BY `modified` DESC
*/

/*

SELECT * 
FROM `sets` 
LEFT JOIN `sub_sets` on `sets`.`id` = `sub_sets`.`set_id`
WHERE 1

SELECT 
CONCAT (`sets`.`id`, ':', `sub_sets`.`id`) AS `setSpec`,
CONCAT (`sets`.`name`, ' / ', `sub_sets`.`name`) AS `setName`
FROM `sets` 
LEFT JOIN `sub_sets` on `sets`.`id` = `sub_sets`.`set_id`
WHERE 1
HAVING `setSpec` <> '' 
ORDER BY `sets`.`name` ASC, `sub_sets`.`name` ASC

*/
