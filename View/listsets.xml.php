<ListSets>
<?php foreach ($rows as $row): ?>
    <set>
		<setSpec><?php echo $row['setSpec']; ?></setSpec>
		<setName><?php echo $row['setName']; ?></setName>
	</set>
<?php endforeach; ?>
</ListSets>
