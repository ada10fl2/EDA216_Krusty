<?php $page = "pallets"; $title = "Pallets In Storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
		$startDate = getSafeParam('startdate', '2014-01-01');
		$endDate = getSafeParam('enddate', '2015-01-01');
		$productName = getSafeParam('productname', null);
		$blocked = getSafeParam('blocked', null);
		$pallets = $db->getPallets($startDate, $endDate, $productName, $blocked);
	?>
	<h3>Filter</h3>
	<form>
		<p>
			Start date: <input type="date" name="startdate" value="<?php echo $startDate ?>"/>
			End date: <input type="date" name="enddate" value="<?php echo $endDate ?>"/>
			Product name: <input type="text" name="productname" value="<?php echo $productName ?>"/>
			Blocked: <input type="checkbox" name="blocked" value="true" <?php echo $blocked ? "checked" : ""; ?> />
		</p>
		<p>
			<input type="reset"  class="btn btn-warning" title="Reset">
			<input type="submit" class="btn btn-success" title="Submit">
		</p>
	</form>
	<table class="table table-striped pallet-table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Creation date</th>
				<th>Recipient</th>
				<th>State</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($pallets)){
		 	foreach ($pallets as $pallet) { ?>
			<tr class='<?= (isset($pallet->state) && $pallet->state === "BLOCKED") ? "danger" : "" ?>'>
				<td><?= $pallet->palletId ?></td>
				<td><?= $pallet->productName ?></td>
				<td><?= $pallet->creationDate ?></td>
				<td><?= $pallet->customerName ?></td>
				<td class='state'><?= $pallet->state ?></td>
				<td class='viewbutton'>
					<button type="button" class="btn btn-default" 
							onclick="document.location='showpallet.php?palletid=<?= $pallet->palletId ?>'">
							View
					</button>
				</td>
			</tr>
			<?php }
		} ?>
		</tbody>
	</table>
<?php include "includes/footer.php"; ?>
