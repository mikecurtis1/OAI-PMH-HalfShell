<?php 

class ViewGetRecord extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">metadataPrefix="' . $http_request->getKEV('metadataPrefix') . '"</error>' . "\n";
        } else {
            $this->buildGetRecordContent($http_request, $config, $model);
        }
    }
    
    private function buildGetRecordContent($http_request, $config, $model)
    {
        $get_record_content = '';
        if ($model instanceof ModelGetRecord) {
            $get_record_content = '';
        }
        $this->xml_content .= '<GetRecord>' . "\n";
        $this->xml_content .= $get_record_content;
        $this->xml_content .= '</GetRecord>' . "\n";
    }
}
