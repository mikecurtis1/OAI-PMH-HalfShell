<?php 

class View extends AbstractView
{
    public function buildContent($http_request=null, $config=null)
    {
        if (! $config->validVerb($http_request->getKEV('verb'))) {
            $this->xml_content .= '<error code="badVerb">Illegal OAI verb.</error>' . "\n";
        }
    }
}
