<?php 

class View extends AbstractView
{
    public function buildContent(HTTPRequest $http_request, Config $config, $model=null)
    {
        if (! $config->validVerb($http_request->getKEV('verb'))) {
            $this->xml_content .= '<error code="badVerb">Illegal OAI verb.</error>' . "\n";
        }
    }
}
