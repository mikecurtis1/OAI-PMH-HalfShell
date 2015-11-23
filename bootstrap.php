<?php 

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

//NOTE: http://www.openarchives.org/OAI/openarchivesprotocol.html

/*
// load required files
require_once(dirname(__FILE__).'/../Controller/HTTPRequest.php');

// MySQL defaults
$resource_list = array();
$resource_id = '';
$collection = '';
$mime_type = '';
$tag_id = '';

// OAI defaults
$verb = HttpRequest::getValue('verb'); // GetRecord | Identify | ListIdentifiers | ListMetadataFormats | ListRecords | ListSets
$metadataprefix = HttpRequest::getValue('metadataPrefix'); // oai_dc
$identifier = HttpRequest::getValue('identifier');
$set = HttpRequest::getValue('set');
$from = HttpRequest::getValue('from');
$until = HttpRequest::getValue('until');

// build request attrs from original 
$xml_request_attrs = buildRequestAttrs();
function buildRequestAttrs($arguments=array('verb','metadataPrefix','identifier','set','from','until')) {
	$xml_request_attrs = '';
	foreach ( $arguments as $argument ) {
		if ( isset($_GET[$argument]) ) {
			$xml_request_attrs .= ' ' . htmlspecialchars($argument) . '="' . htmlspecialchars($_GET[$argument]) . '"';
		} elseif ( isset($_POST[$argument]) ) {
			$xml_request_attrs .= ' ' . htmlspecialchars($argument) . '="' . htmlspecialchars($_POST[$argument]) . '"';
		}
	}
	
	return $xml_request_attrs;
}

// process protocol request input
if ( $verb === 'GetRecord' ) {
	$oai_template = 'getrecord.tpl.php';
	$identifier_nodes = explode(':',$identifier);
	if ( isset($identifier_nodes[0]) && strcasecmp($identifier_nodes[0],'urn') === 0 ) {
		if ( isset($identifier_nodes[1]) && $identifier_nodes[1] === 'resource-id' ) {
			if ( isset($identifier_nodes[2]) ) {
				$resource_id = $identifier_nodes[2];
			}
		}
	}
	$set = '';
} elseif ( $verb === 'ListRecords' ) {
	$oai_template = 'listrecords.tpl.php';
	$set_nodes = explode(':',$set); // collection -> mime_type -> tag_id
	if ( isset($set_nodes[0]) ) {
		$collection = $set_nodes[0];
	}
	if ( isset($set_nodes[1]) ) {
		$mime_type = $set_nodes[1];
	}
	if ( isset($set_nodes[2]) ) {
		$tag_id = $set_nodes[2];
	}
} elseif ( $verb === 'ListMetadataFormats' ) {
	$oai_template = 'listmetadataformats.tpl.xml';
} elseif ( $verb === 'Identify' ) {
	$oai_template = 'identify.tpl.xml';
} elseif ( $verb === 'ListIdentifiers' ) {
	$oai_template = 'listrecords.tpl.php';
} elseif ( $verb === 'ListSets' ) {
	$oai_template = 'listsets.tpl.xml';
} else {
	$xml_request_attrs = '';
	$oai_template = 'badverb.tpl.xml';
}
if ( ( $verb === 'GetRecord' || $verb === 'ListRecords' || $verb === 'ListIdentifiers' ) && $metadataprefix !== 'oai_dc' ) {
	$oai_template = 'cannotdisseminateformat.tpl.xml';
}

// run MySQL query for appropriate OAI verbs
if ( $verb === 'GetRecord' || $verb === 'ListRecords' || $verb === 'ListIdentifiers' ) {

// get HTTP request params
$resource_id_sql = $resource_id;
if ( $resource_id === '' && $verb !== 'GetRecord' ) {
	$resource_id_sql = '%';
}
$collection_sql = $collection;
if ( $collection === '' ) {
	$collection_sql = '%';
}
$mime_type_sql = $mime_type;
if ( $mime_type === '' ) {
	$mime_type_sql = '%';
}

// where clause defaults
$where_clause_tag_id = '';
$where_clause_date_updated = '';

// create MySQL instance 
try {
	//TODO: use PDO and mysqli in the DAOMySQL object
	$mysql = DAOMySQL::create(DB_HOST,DB_USER,DB_PASS);
	//NOTE: mysql_real_escape_string can work only after connecting to the db
	if ( $tag_id !== '' ) {
		$where_clause_tag_id = "AND `resource_tags`.`id` LIKE '" . mysql_real_escape_string($tag_id) . "' \n";
	}
	if ( $from !== '' && $until !== '' ) {
		$where_clause_date_updated = "AND  ( `resources`.`date_updated` >= '" . mysql_real_escape_string($from) . "' AND `resources`.`date_updated` <= '" . mysql_real_escape_string($until) . "' ) \n";
	}
} catch (Exception $e) {
	$message = $e->getMessage() . '<br />' . basename($e->getFile()) . '<br />' . 'Line: ' . $e->getLine() . '<br />';
	header('HTTP/1.0 500 Internal Server Error');
	echo '<h1>500 Internal Server Error</h1>' . "\n";
	echo '<p>' . $message . "</p>\n";
	exit;
}

// build MySQL query
$sql = "
SELECT 
`resources`.`id` AS `resource_id`,
`resources`.`date_updated`,
`resources`.`name`,
`description`,
`collection`, 
`resources`.`mime_type`,
`resources`.`active`,
`urls`.`uri`,
`urls`.`proxy`, 
`urls`.`short_code`, 
'' AS `tag`, 
'' AS `private_tag`, 
GROUP_CONCAT(CONCAT(`resource_tags`.`id`,0x1F,`resource_tags`.`tag`) SEPARATOR 0x1E) AS tags 
FROM `resources` 
LEFT JOIN `resource_tag_index` 
ON `resources`.`id`  = `resource_tag_index`.`resource_id` 
LEFT JOIN `resource_tags`
ON `resource_tags`.`id` = `resource_tag_index`.`tag_id` 
LEFT JOIN `urls` 
ON `resources`.`url_id` = `urls`.`id` 
WHERE 1=1 
AND `resources`.`id` LIKE '" . mysql_real_escape_string($resource_id_sql) . "' " 
. $where_clause_tag_id 
. $where_clause_date_updated 
. "AND `resources`.`collection` LIKE '" . mysql_real_escape_string($collection_sql) . "' \n" 
. "AND `resources`.`mime_type` LIKE '" . mysql_real_escape_string($mime_type_sql) . "' \n" 
. "GROUP BY `resources`.`id`,`resources`.`date_updated`,`resources`.`name`,`description`,`collection`,`resources`.`mime_type`,`resources`.`active`,`urls`.`uri`,`proxy`,`urls`.`short_code` \n";

// run query and get results
try {
	//TODO: put this in the create method, then use the 'sendRequest' method of the DAO interface
	$mysql->runQuery($sql,DB_NAME,DB_CHAR);
	$resource_list = $mysql->getData();
} catch  (Exception $e) {
	echo $e->getMessage() . '<br />' . basename($e->getFile()) . '<br />' . 'Line: ' . $e->getLine() . '<br />'; 
}

}

// load view file
if ( is_file(dirname(__FILE__) . $view_path  . OAI_VIEW) ) {
	require_once(dirname(__FILE__) . $view_path  . OAI_VIEW);
} else {
	die('Could not find view file.');
}
*/

require_once dirname(__FILE__) . '/Controller/OAIIdentifier.php';
require_once dirname(__FILE__) . '/Models/ModelInterface.php';
require_once dirname(__FILE__) . '/Models/Model.php';
require_once dirname(__FILE__) . '/Models/ModelListSets.php';
require_once dirname(__FILE__) . '/Models/ModelGetRecord.php';

require_once dirname(__FILE__) . '/Config.php';
$config = new Config();

require_once dirname(__FILE__) . '/Controller/HTTPRequest.php';
$http_request = new HTTPRequest();
#echo var_dump($http_request);

require_once dirname(__FILE__) . '/View/View.php';
$view = new View($http_request, $config);
#echo var_dump($view);

require_once dirname(__FILE__) . '/Controller/Controller.php';
$controller = new Controller($http_request, $config, $view);
#echo var_dump($controller);
