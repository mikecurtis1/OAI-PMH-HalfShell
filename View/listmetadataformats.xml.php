<ListMetadataFormats>
	<metadataFormat>
<?php foreach ($config_metadata_formats as $metadata_format): ?>
		<metadataPrefix><?php echo $metadata_format; ?></metadataPrefix>
<?php endforeach; ?>
		<schema>http://www.openarchives.org/OAI/2.0/oai_dc.xsd</schema>
		<metadataNamespace>http://www.openarchives.org/OAI/2.0/oai_dc/</metadataNamespace>
	</metadataFormat>
</ListMetadataFormats>
