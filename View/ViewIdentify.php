<?php 

class ViewIdentify extends AbstractView
{
    public function buildContent($http_request=null, $config=null)
    {
        $this->xml_content .= '<Identify>' . "\n";
        $this->xml_content .= "\t" . '<repositoryName>' . $config->getParam('repository_name') . '</repositoryName>' . "\n";
        $this->xml_content .= "\t" . '<baseURL>' . $config->getParam('base_url') . '</baseURL>' . "\n";
        $this->xml_content .= "\t" . '<protocolVersion>' . $config->getParam('protocol_version') . '</protocolVersion>' . "\n";
        foreach ($config->getParam('admin_emails') as $admin_email) {
            $this->xml_content .= "\t" . '<adminEmail>' . $admin_email . '</adminEmail>' . "\n";
        }
        $this->xml_content .= "\t" . '<earliestDatestamp>' . $config->getParam('earliest_datestamp') . '</earliestDatestamp>' . "\n";
        $this->xml_content .= "\t" . '<deletedRecord>' . $config->getParam('deleted_record') . '</deletedRecord>' . "\n";
        $this->xml_content .= "\t" . '<granularity>' . $config->getParam('granularity') . '</granularity>' . "\n";
        $this->xml_content .= '</Identify>' . "\n";
    }
}
