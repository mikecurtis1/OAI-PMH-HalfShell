<?php 

class ViewGetRecord extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if ($config->metadataFormatSupported($http_request->getKEV('metadataPrefix')) === false) {
            $this->xml_content .= '<error code="cannotDisseminateFormat">You requested format &quot;' . $http_request->getKEV('metadataPrefix') . '.&quot; Only &quot;oai_dc&quot; supported.</error>' . "\n";
        } else {
            $this->buildGetRecordContent($http_request, $config, $model);
        }
    }
    
    private function buildGetRecordContent($http_request, $config, $model)
    {
        $get_record_content = '';
        if ($model instanceof ModelGetRecord) {
            $get_record_content .= $this->mapDCElements($model, $config);
        }
        $this->xml_content .= '<GetRecord>' . "\n";
        $this->xml_content .= '<record>' . "\n";
        $this->xml_content .= '<header status="' . $this->getHeaderStatus($model) . '">' . "\n";
        $this->xml_content .= '<identifier>' . $this->getIdentifier($model, $config) . '</identifier>' . "\n";
        $this->xml_content .= '<datestamp>' . $this->getDatestamp($model) . '</datestamp>' . "\n";
        $this->xml_content .= '<setSpec>' . $this->getSetSpec($model) . '</setSpec>' . "\n";
        $this->xml_content .= '</header>' . "\n";
        $this->xml_content .= '<metadata>' . "\n";
        $this->xml_content .= '<oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">' . "\n";
        $this->xml_content .= $get_record_content;
        $this->xml_content .= '</oai_dc:dc>' . "\n";
        $this->xml_content .= '</metadata>' . "\n";
        $this->xml_content .= '</record>' . "\n";
        $this->xml_content .= '</GetRecord>' . "\n";
    }
    
    private function mapDCElements($model, $config)
    {
        $xml = '';
        if (isset($model->getSQLRows()[0])) {
            foreach ($config->getFieldMap() as $field => $dc) {
                if ($dc === 'language') {
                    $attr = ' xsi:type="dcterms:ISO639-3"';
                } elseif ($dc === 'identifier') {
                    $attr = ' xsi:type="dcterms:URI"';
                } else {
                    $attr = '';
                }
                if (isset($model->getSQLRows()[0][$field])) {
                    $xml .= '<dc:' . $dc . $attr . '>' . htmlspecialchars($model->getSQLRows()[0][$field]) . '</dc:' . $dc . '>' . "\n";
                }
            }
        }
        
        return $xml;
    }
    
    private function getHeaderStatus($model)
    {
        if (isset($model->getSQLRows()[0]['header_status'])) {
            return htmlspecialchars($model->getSQLRows()[0]['header_status']);
        } else {
            return '';
        }
    }
    
    private function getIdentifier($model, $config)
    {
        if (isset($model->getSQLRows()[0]['identifier'])) {
            $prefix = 'urn:';
            $prefix .= $config->getParam('urn_domain') . "/";
            $prefix .= $config->getParam('urn_db') . ":";
            $prefix .= $config->getParam('urn_table') . ":";
            return htmlspecialchars($prefix . $model->getSQLRows()[0]['identifier']);
        } else {
            return '';
        }
    }
    
    private function getDatestamp($model)
    {
        if (isset($model->getSQLRows()[0]['modified'])) {
            return htmlspecialchars($model->getSQLRows()[0]['modified']);
        } else {
            return '';
        }
    }
    
    private function getSetSpec($model)
    {
        if (isset($model->getSQLRows()[0]['setSpec'])) {
            return htmlspecialchars($model->getSQLRows()[0]['setSpec']);
        } else {
            return '';
        }
    }
}
