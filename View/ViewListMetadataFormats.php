<?php 

class ViewListMetadataFormats extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        $this->xml_content .= '<ListMetadataFormats>' . "\n";
        $this->xml_content .= "\t" . '<metadataFormat>' . "\n";
        $this->xml_content .= "\t\t" . '<metadataPrefix>oai_dc</metadataPrefix>' . "\n";
        $this->xml_content .= "\t\t" . '<schema>http://www.openarchives.org/OAI/2.0/oai_dc.xsd</schema>' . "\n";
        $this->xml_content .= "\t\t" . '<metadataNamespace>http://www.openarchives.org/OAI/2.0/oai_dc/</metadataNamespace>' . "\n";
        $this->xml_content .= "\t" . '</metadataFormat>' . "\n";
        $this->xml_content .= '</ListMetadataFormats>' . "\n";
    }
}
