<?php $page = "pallets"; $title = "Pallets In Storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$startDate = (isset($_GET['startDate']) ? $_GET['startDate'] : null);
	$endDate = (isset($_GET['endDate']) ? $_GET['endDate'] : null);
		if ($startDate && $endDate) {
			$pallets = $db->getPallets($startDate, $endDate);
		}
	?>
	<form>
			<p>
			Start date: <input type="date" name="startDate" value="<?php echo ($startDate ? $startDate : '2014-01-01') ?>"/>
			End date: <input type="date" name="endDate" value="<?php echo ($endDate ? $endDate : '2015-01-01')  ?>"/>
			</p>
			<input type="submit" title="Submit">
		</form>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Kakor</th>
			</tr>
		</thead>
		<tbody>

			<?php if($pallets && is_array($pallets)){
			 	foreach ($pallets as $pallet) { ?>
			<tr>
				<td><?= $pallet->palletId ?></td>
				<td><?= $pallet->creationDate ?></td>
				<td><?= $pallet->state ?></td>
			</tr>
			<?php }
		} ?>
		</tbody>
	</table>
<?php include "includes/footer.php"; ?>
