<?php 
	include "includes/header.php";
	$palletId = getSafeParam('palletid', FALSE);
	if ($palletId) {
		$pallet = $db->getPallet($palletId);
	}
	
	?>
	<h2>Pallet <?php echo $palletId; ?></h2>
		<div>Creation date: <?php echo $pallet->creationDate; ?></div>
<?php include "includes/footer.php" ?>
