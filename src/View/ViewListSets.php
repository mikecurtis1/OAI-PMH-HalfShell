<?php 

class ViewListSets extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        $this->xml_content .= '<ListSets>' . "\n";
        foreach ($model->getSQLRows() as $row) {
            $this->xml_content .= '<set>' . "\n";
            $this->xml_content .= '<setSpec>' . $row['setSpec'] . '</setSpec>' . "\n";
            $this->xml_content .= '<setName>' . $row['setName'] . '</setName>' . "\n";
            $this->xml_content .= '</set>' . "\n";
        }
        $this->xml_content .= '</ListSets>' . "\n";
    }
}
