<?php 
if ( ! headers_sent() ) {
	header('Content-Type: text/xml; charset=utf-8');
}
?>
<?xml version="1.0" encoding="UTF-8"?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
<responseDate><?php echo $xml_date; ?></responseDate> 
<request<?php echo $xml_request_attrs; ?>><?php echo $xml_base_url; ?></request>
<?php echo $xml_content; ?>
</OAI-PMH>