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
            foreach ($model->getSQLRows() as $row) {
              $list_identifiers_content .= '<header status="' . $row['header_status'] . '">' . "\n";
              $list_identifiers_content .= '<identifier>' . $row['identifier'] . '</identifier>' . "\n";
              $list_identifiers_content .= '<datestamp>' . $row['modified'] . '</datestamp>' . "\n";
              $list_identifiers_content .= '<setSpec>' . $row['setSpec'] . '</setSpec>' . "\n";
              $list_identifiers_content .= '</header>' . "\n";
            }
        }
        $this->xml_content .= '<ListIdentifiers>' . "\n";
        $this->xml_content .= $list_identifiers_content;
        $this->xml_content .= '</ListIdentifiers>' . "\n";
    }
}
