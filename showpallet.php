<?php 
	include "includes/header.php";
	$palletId = getSafeParam('id', FALSE);
	if ($palletId) {
		$pallet = $db->getPallet($palletId, null);
	}
	?>
	<h2>Pallet <?= $palletId; ?></h2>
	<div>Creation date: <?= $pallet->creationDate; ?></div>
<?php include "includes/footer.php" ?>
