<?php 

class View
{
    private $xml_request_attrs = '';
    private $oai_template_path = '';
    
    public function __construct(HTTPRequest $http_request, Config $config)
    {
        $this->buildRequestAttrs($http_request, $config);
        $this->setOAITemplate($http_request, $config);
        
    }
    
    private function buildRequestAttrs($http_request, $config)
    {
        foreach ( $config->getParam('request_attrs') as $key ) {
            if ( $value = $http_request->getKEV($key) ) {
                $this->xml_request_attrs .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
            }
        }
    }
    
    private function setOAITemplate($http_request, $config)
    {
        if (! $config->validVerb($http_request->getKEV('verb'))) {
            $this->oai_template_path = dirname(__FILE__) . '/badverb.xml.php';
        } elseif ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix'))) {
            $this->oai_template_path = dirname(__FILE__) . '/cannotdisseminateformat.xml.php';
        } else {
            $this->oai_template_path = dirname(__FILE__) . '/' . $config->getTemplateNameByVerb($http_request->getKEV('verb'));
        }
    }
    
    public function renderTemplate(HTTPRequest $http_request, Config $config)
    {
        foreach ($http_request->getArray() as $name => $value) {
            ${'request_' . $name} = $value;
        }
        foreach ($config->getParamsArray() as $name => $value) {
            ${'config_' . $name} = $value;
        }
        $date = date("Y-m-dTH:i:sz");
        $xml_request_attrs = $this->xml_request_attrs;
        $oai_template_path = $this->oai_template_path;
        require_once 'document.xml.php';
    }
}
