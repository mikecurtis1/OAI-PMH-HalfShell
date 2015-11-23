<?php
$row = $rows[0];
$header_status = '';
if ($row['header_status'] === 'deleted') {
    $header_status = ' status="deleted"';
}
?>
<GetRecord>
<record>
	<header<?php echo $header_status; ?>>
		<identifier><?php echo htmlspecialchars($row['identifier']); ?></identifier>
		<datestamp><?php echo htmlspecialchars($row['modified']); ?></datestamp>
<?php if ( $row['header_status'] !== 'deleted' ) { ?>
        <setSpec><?php echo htmlspecialchars($row['setSpec']); ?></setSpec>
<?php } ?>
	</header>
<?php if ( $row['header_status'] !== 'deleted' ) { ?>
	<metadata>
		<oai_dc:dc 
			xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" 
			xmlns:dc="http://purl.org/dc/elements/1.1/" 
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
			xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/
			http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
			<dc:title><?php echo htmlspecialchars($row['title']); ?></dc:title>
			<dc:description><?php echo htmlspecialchars($row['description']); ?></dc:description>
		</oai_dc:dc>
	</metadata>
<?php } ?>
</record>
</GetRecord>