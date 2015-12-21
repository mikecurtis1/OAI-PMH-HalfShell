<?php 

class ViewListRecords extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">You requested format &quot;' . $http_request->getKEV('metadataPrefix') . '.&quot; Only &quot;oai_dc&quot; supported.</error>' . "\n";
        } else {
            $this->buildListRecordsContent($http_request, $config, $model);
        }
    }
    
    private function buildListRecordsContent($http_request, $config, $model)
    {
        $record_list_content = '';
        if ($model instanceof ModelListRecords) {
            foreach ($model->getSQLRows() as $row) {
                $record_list_content .= $this->buildRecord($row, $config);
            }
        }
        $this->xml_content .= '<ListRecords>' . "\n";
        $this->xml_content .= $record_list_content;
        $this->xml_content .= '</ListRecords>' . "\n";
    }
    
    private function buildRecord($row, $config)
    {
        $xml = '<record>' . "\n";
        $xml .= '<header status="' . $this->getHeaderStatus($row) . '">' . "\n";
        $xml .= '<identifier>' . $this->getIdentifier($row, $config) . '</identifier>' . "\n";
        $xml .= '<datestamp>' . $this->getDatestamp($row) . '</datestamp>' . "\n";
        $xml .= '<setSpec>' . $this->getSetSpec($row) . '</setSpec>' . "\n";
        $xml .= '</header>' . "\n";
        $xml .= '<metadata>' . "\n";
        $xml .= '<oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">' . "\n";
        $xml .= $this->mapDCElements($row, $config);
        $xml .= '</oai_dc:dc>' . "\n";
        $xml .= '</metadata>' . "\n";
        $xml .= '</record>' . "\n";
        
        return $xml;
    }
    
    private function mapDCElements($row, $config)
    {
        $xml = '';
        foreach ($config->getFieldMap() as $field => $dc) {
            if ($dc === 'language') {
                $attr = ' xsi:type="dcterms:ISO639-3"';
            } elseif ($dc === 'identifier') {
                $attr = ' xsi:type="dcterms:URI"';
            } else {
                $attr = '';
            }
            if (isset($row[$field])) {
                $xml .= '<dc:' . $dc . $attr . '>' . htmlspecialchars($row[$field]) . '</dc:' . $dc . '>' . "\n";
            }
        }
        
        return $xml;
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
