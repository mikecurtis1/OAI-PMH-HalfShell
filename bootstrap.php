<?php 

//NOTE: do not display errors in production
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__) . '/View/AbstractView.php';
require_once dirname(__FILE__) . '/View/View.php';
require_once dirname(__FILE__) . '/View/ViewIdentify.php';
require_once dirname(__FILE__) . '/View/ViewListMetadataFormats.php';
require_once dirname(__FILE__) . '/View/ViewListSets.php';
require_once dirname(__FILE__) . '/View/ViewListRecords.php';
require_once dirname(__FILE__) . '/View/ViewListIdentifiers.php';
require_once dirname(__FILE__) . '/View/ViewGetRecord.php';
require_once dirname(__FILE__) . '/Models/OAIIdentifier.php';
require_once dirname(__FILE__) . '/Models/ModelInterface.php';
require_once dirname(__FILE__) . '/Models/AbstractModel.php';
require_once dirname(__FILE__) . '/Models/ModelListSets.php';
require_once dirname(__FILE__) . '/Models/ModelListIdentifiers.php';
require_once dirname(__FILE__) . '/Models/ModelListRecords.php';
require_once dirname(__FILE__) . '/Models/ModelGetRecord.php';
require_once dirname(__FILE__) . '/Config.php';

$config = new Config();

require_once dirname(__FILE__) . '/Controller/HTTPRequest.php';
$http_request = new HTTPRequest();

require_once dirname(__FILE__) . '/Controller/Controller.php';
$controller = new Controller($http_request, $config);
