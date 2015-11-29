<?php 

class ViewListIdentifiers extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">metadataPrefix="' . $http_request->getKEV('metadataPrefix') . '"</error>' . "\n";
        } else {
            $this->buildListIdentifiersContent($http_request, $config, $model);
        }
    }
    
    private function buildListIdentifiersContent($http_request, $config, $model)
    {
        $list_identifiers_content = '';
        if ($model instanceof ModelListIdentifiers) {
            $list_identifiers_content = '';
        }
        $this->xml_content .= '<ListIdentifiers>' . "\n";
        $this->xml_content .= $list_identifiers_content;
        $this->xml_content .= '</ListIdentifiers>' . "\n";
    }
}
