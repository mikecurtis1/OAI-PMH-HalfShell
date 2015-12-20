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
            $get_record_content .= $this->mapDCElements($model, $config);
        }
        $this->xml_content .= '<GetRecord>' . "\n";
        $this->xml_content .= '<record>' . "\n";
        $this->xml_content .= '<header>' . "\n";
        $this->xml_content .= '<identifier>' . $model->getURN() . '</identifier>' . "\n";
        $this->xml_content .= '<datestamp></datestamp>' . "\n";
        $this->xml_content .= '<setSpec></setSpec>' . "\n";
        $this->xml_content .= '<setSpec></setSpec>' . "\n";
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
                if (isset($model->getSQLRows()[0][$field])) {
                    $xml .= '<dc:' . $dc . '>' . $model->getSQLRows()[0][$field] . '</dc:' . $dc . '>' . "\n";
                }
            }
        }
        
        return $xml;
    }
}
