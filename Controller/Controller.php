<?php 

class Controller
{
    private $verbs = array('GetRecord', 'Identify', 'ListIdentifiers', 'ListMetadataFormats', 'ListRecords', 'ListSets');
    private $verb = '';
    private $metadataprefix = 'oai_dc';
    private $identifier = '';
    private $set = '';
    private $from = '';
    private $until = '';
    
    public function __construct(HTTPRequest $http_request, Config $config, View $view)
    {
        $this->setVerb($http_request);
        $this->setMetadataPrefix($http_request);
        $this->setIdentifier($http_request);
        $this->setSet($http_request);
        $this->setFrom($http_request);
        $this->setUntil($http_request);
        #echo var_dump($config);
        $view->renderTemplate($http_request, $config);
    }
    
    private function setVerb($http_request)
    {
        if (in_array($http_request->getKEV('verb'), $this->verbs)) {
            $this->verb = $http_request->getKEV('verb');
        }
    }
    
    private function setMetadataPrefix($http_request)
    {
        $this->metadataprefix = $http_request->getKEV('metadataPrefix');
    }
    
    private function setIdentifier($http_request)
    {
        $this->identifier = $http_request->getKEV('identifier');
    }
    
    private function setSet($http_request)
    {
        $this->set = $http_request->getKEV('set');
    }
    
    private function setFrom($http_request)
    {
        $this->from = $http_request->getKEV('from');
    }
    
    private function setUntil($http_request)
    {
        $this->until = $http_request->getKEV('until');
    }
}
