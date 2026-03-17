<?php 

abstract class AbstractView
{
    protected $xml_date = '';
    protected $xml_request_attrs = '';
    protected $xml_config_base_url = '';
    protected $xml_content = '';
    
    public function __construct(HTTPRequest $http_request, Config $config)
    {
        $this->xml_date = date("Y-m-dTH:i:sz");
        $this->buildRequestAttrs($http_request, $config);
        $this->xml_config_base_url = $config->getParam('base_url');
    }
    
    protected function buildRequestAttrs($http_request, $config)
    {
        foreach ( $config->getParam('request_attrs') as $key ) {
            if ( $value = $http_request->getKEV($key) ) {
                $this->xml_request_attrs .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
            }
        }
    }
    
    public function renderTemplate()
    {
        $xml_date = $this->xml_date;
        $xml_request_attrs = $this->xml_request_attrs;
        $xml_base_url = $this->xml_config_base_url;
        $xml_content = $this->xml_content;
        require_once 'document.xml.php';
    }
    
    abstract public function buildContent(HTTPRequest $http_request, Config $config, $model);
}
