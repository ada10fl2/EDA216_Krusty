<?php $page = "pallets"; $title = "Pallets In Storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$startDate = (isset($_GET['startDate']) ? $_GET['startDate'] : null);
	$endDate = (isset($_GET['endDate']) ? $_GET['endDate'] : null);
	$pallets = [];
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
	<table class="table table-striped ">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>State</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($pallets)){
		 	foreach ($pallets as $pallet) { ?>
			<tr class='<?= isset($pallet->state) && $pallet->state === "blocked" ? "danger" : "" ?>'>
				<td><?= $pallet->palletId ?></td>
				<td><?= $pallet->creationDate ?></td>
				<td><?= $pallet->state ?></td>
				<td><button type="button" class="btn btn-default" 
							onclick="document.location='showpallet.php?palletid=<?= $pallet->palletId ?>'">View</button>
				</td>
			</tr>
			<?php }
		} ?>
		</tbody>
	</table>
<?php include "includes/footer.php"; ?>
