<?php 
	include "includes/header.php";
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	if ($startDate && $endDate) {
		$pallets = $db->getPallets($startDate, $endDate);
	}
	
	?>
	<h2>Select pallet dates</h2>
		<form>
			<p>
			Start date: <input type="date" name="startDate" value="<?php echo ($startDate ? $startDate : '2014-01-01') ?>"/>
			End date: <input type="date" name="endDate" value="<?php echo ($endDate ? $endDate : '2015-01-01')  ?>"/>
			</p>
			<input type="submit" title="Submit">
		</form>
		<?php if($pallets) { ?>
			<?php foreach ($pallets as $pallet) { ?>
			<a href="<?php echo "#showpallet?palletid=".$pallet->palletId; ?>"><div>
				<span><?php echo $pallet->palletId; ?></span> <span><?php echo $pallet->creationDate;?></span>
			</div></a>
		<?php } ?>
		<?php } ?>
<?php include "includes/footer.php" ?>
