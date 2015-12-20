<?php 

class Config
{
    private $params = array();
    
    public function __construct()
    {
        $this->params = parse_ini_file('config.ini');
        $this->setAdminEmails();
        $this->setVerbs();
        $this->setRequestAttrs();
        $this->setMetadataFormats();
        $this->setFieldMap();
    }
    
    private function setAdminEmails()
    {
        if (isset($this->params['admin_email_list'])) {
            $admin_emails = explode(',', $this->params['admin_email_list']);
            foreach ($admin_emails as $admin_email) {
                $this->params['admin_emails'][] = $admin_email;
            }
        }
    }
    
    private function setVerbs()
    {
        if (isset($this->params['verb_list'])) {
            $verbs = explode(',', $this->params['verb_list']);
            foreach ($verbs as $verb) {
                $this->params['verbs'][] = $verb;
            }
        }
    }
    
    private function setRequestAttrs()
    {
        if (isset($this->params['request_attr_list'])) {
            $request_attrs = explode(',', $this->params['request_attr_list']);
            foreach ($request_attrs as $request_attr) {
                $this->params['request_attrs'][] = $request_attr;
            }
        }
    }
    
    private function setMetadataFormats()
    {
        if (isset($this->params['metadata_format_list'])) {
            $metadata_formats = explode(',', $this->params['metadata_format_list']);
            foreach ($metadata_formats as $metadata_format) {
                $this->params['metadata_formats'][] = $metadata_format;
            }
        }
    }
    
    private function setFieldMap()
    {
        foreach ($this->params as $param => $value) {
            if (substr($param,0,10) === 'map_field_') {
                $this->params['field_map'][substr($param,10)] = $value;
            }
        }
    }
    
    public function getFieldMap()
    {
        return $this->params['field_map'];
    }
    
    public function getParamsArray()
    {
        return $this->params;
    }
    
    public function getParam($name)
    {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        } else {
            return false;
        }
    }
    
    public function getTemplateNameByVerb($verb)
    {
        if ($this->getParam('template_' . $verb)) {
            return $this->getParam('template_' . $verb);
        } else {
            return false;
        }
    }
    
    public function validVerb($verb)
    {
        if (in_array($verb, $this->params['verbs'])) {
            return true;
        } else {
            return false;
        }
    }
    
    public function metadataFormatSupported($metadata_prefix)
    {
        if (in_array($metadata_prefix, $this->params['metadata_formats'])) {
            return true;
        } else {
            return false;
        }
    }
}
