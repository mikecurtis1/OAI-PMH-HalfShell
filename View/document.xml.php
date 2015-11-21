<?php 
if ( ! headers_sent() ) {
	header('Content-Type: text/xml; charset=utf-8');
}
?>
<?xml version="1.0" encoding="UTF-8"?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
<responseDate><?php echo $date; ?></responseDate> 
<request<?php echo $xml_request_attrs; ?>><?php echo $config_base_url; ?></request>
<?php 
if (is_file($oai_template_path)) {
    include($oai_template_path); 
}
?>
</OAI-PMH>