<?php 

class ViewListIdentifiers extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">You requested format &quot;' . $http_request->getKEV('metadataPrefix') . '.&quot; Only &quot;oai_dc&quot; supported.</error>' . "\n";
        } else {
            $this->buildListIdentifiersContent($http_request, $config, $model);
        }
    }
    
    private function buildListIdentifiersContent($http_request, $config, $model)
    {
        $list_identifiers_content = '';
        if ($model instanceof ModelListIdentifiers) {
            foreach ($model->getSQLRows() as $row) {
              $list_identifiers_content .= '<header status="' . $this->getHeaderStatus($row) . '">' . "\n";
              $list_identifiers_content .= '<identifier>' . $this->getIdentifier($row, $config) . '</identifier>' . "\n";
              $list_identifiers_content .= '<datestamp>' . $this->getDatestamp($row) . '</datestamp>' . "\n";
              $list_identifiers_content .= '<setSpec>' . $this->getSetSpec($row) . '</setSpec>' . "\n";
              $list_identifiers_content .= '</header>' . "\n";
            }
        }
        $this->xml_content .= '<ListIdentifiers>' . "\n";
        $this->xml_content .= $list_identifiers_content;
        $this->xml_content .= '</ListIdentifiers>' . "\n";
    }
    
    private function getHeaderStatus($row)
    {
        if (isset($row['header_status'])) {
            return htmlspecialchars($row['header_status']);
        } else {
            return '';
        }
    }
    
    private function getIdentifier($row, $config)
    {
        if (isset($row['identifier'])) {
            $prefix = 'urn:';
            $prefix .= $config->getParam('urn_domain') . "/";
            $prefix .= $config->getParam('urn_db') . ":";
            $prefix .= $config->getParam('urn_table') . ":";
            return htmlspecialchars($prefix . $row['identifier']);
        } else {
            return '';
        }
    }
    
    private function getDatestamp($row)
    {
        if (isset($row['modified'])) {
            return htmlspecialchars($row['modified']);
        } else {
            return '';
        }
    }
    
    private function getSetSpec($row)
    {
        if (isset($row['setSpec'])) {
            return htmlspecialchars($row['setSpec']);
        } else {
            return '';
        }
    }
}
