<?php 

class ViewListRecords extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">metadataPrefix="' . $http_request->getKEV('metadataPrefix') . '"</error>' . "\n";
        } else {
            $this->buildListRecordsContent($http_request, $config, $model);
        }
    }
    
    private function buildListRecordsContent($http_request, $config, $model)
    {
        $record_list_content = '';
        if ($model instanceof ModelListRecords) {
            $record_list_content = '';
        }
        $this->xml_content .= '<ListRecords>' . "\n";
        $this->xml_content .= $record_list_content;
        $this->xml_content .= '</ListRecords>' . "\n";
    }
}
