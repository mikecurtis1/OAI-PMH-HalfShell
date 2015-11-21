<Identify>
	<repositoryName><?php echo $config_repository_name; ?></repositoryName>
	<baseURL><?php echo $config_base_url; ?></baseURL>
	<protocolVersion><?php echo $config_protocol_version; ?></protocolVersion>
<?php foreach ($config_admin_emails as $admin_email): ?>
	<adminEmail><?php echo $admin_email; ?></adminEmail>
<?php endforeach; ?>
	<earliestDatestamp><?php echo $config_earliest_datestamp; ?></earliestDatestamp>
	<deletedRecord><?php echo $config_deleted_record; ?></deletedRecord>
	<granularity><?php echo $config_granularity; ?></granularity>
</Identify>
