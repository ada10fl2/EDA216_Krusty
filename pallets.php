<?php $page = "pallets"; $title = "Pallets In Storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$startDate = getSafeParam('startdate', '2014-01-01');
	$endDate = getSafeParam('enddate', '2015-01-01');
	$productName = getSafeParam('productname', null);
	$customerName = getSafeParam('customer', null);
	$blocked = getSafeParam('blocked', null);
	$pallets = $db->getPallets($startDate, $endDate, $productName, $blocked, $customerName);
	$products = $db->getProducts();
	$filter = array(
		"startdate" => $startDate,
		"enddate" => $endDate,
		"customer" => $customerName,
		"product" => $productName,
		"blocked" => $blocked
	);
	$customers = $db->getCustomers();
	?>
	<fieldset>
	    <legend>Filter</legend>
	    <form>
		    <div class='row'>
		    	<div class='col-sm-1'>    
		            <div class='form-group'>
		            	<label for="user_title">&nbsp</label>
		    			<button type="reset" onclick="document.location='pallets.php'" class="btn btn-warning form-control">Reset</button>
		    		</div>
		    	</div>
		        <div class='col-sm-2'>    
		            <div class='form-group'>
		                <label for="user_title">Start date</label>
		                <input type="date" class="form-control" name="startdate" value="<?php echo $startDate ?>"/>
		            </div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label for="user_firstname">End date</label>
		                <input type="date" class="form-control" name="enddate" value="<?php echo $endDate ?>"/>
		            </div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label for="user_lastname">Product name</label>
		                <select class="form-control" name="productname">
						<option value="">All products</option>
						<?php foreach ($products as $product) { ?>
						<option value="<?php echo $product; ?>" <?php echo $product == $productName ? "selected=\"yes\"" : ""; ?>><?php echo $product; ?></option>
						<?php } ?>
						</select>
		        	</div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label for="user_lastname">Customers</label>
		                <select class="form-control" name="customer">
					<option value="">All customers</option>
					<?php foreach ($customers as $customer) { ?>
					<option value="<?php echo $customer; ?>" <?php echo $customer == $customerName ? "selected=\"yes\"" : ""; ?>><?php echo $customer; ?></option>
					<?php } ?>
					</select>
		            </div>
		        </div>
		        <div class='col-sm-1'>
		            <div class='form-group'>
		                <label for="user_lastname">Blocked</label>
		                <input type="checkbox" class="form-control" name="blocked" value="true" <?php echo $blocked ? "checked" : ""; ?> />
		            </div>
		        </div>
		        <div class='col-sm-1'>
		            <div class='form-group'>
		                <label for="user_lastname">&nbsp</label>
		                <button type="submit" class="btn btn-success">Submit</button>
		            </div>
		        </div>
		    </div>
	    </form>
	</fieldset>
	<legend>Result</legend>
	<a role="button" class="btn btn-danger pull-right" 
		href="block.php?id=all&filter=<?= urlencode(base64_encode(serialize($filter))) ?>&action=block&relocation=<?= urlencode(url()) ?>">
		Block Visible Pallets
	</a>
	<table class="table table-striped pallet-table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Creation date</th>
				<th>Delivery date</th>
				<th>Recipient</th>
				<th>State</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($pallets)){
			function isBlocked(&$pallet){
				return (isset($pallet->state) && $pallet->state === "BLOCKED") ? TRUE : FALSE;
			}
		 	foreach ($pallets as $pallet) { ?>
			<tr class='<?= isBlocked($pallet) ? "danger" : "" ?>'>
				<td><?= $pallet->palletId ?></td>
				<td><?= $pallet->productName ?></td>
				<td><?= $pallet->creationDate ?></td>
				<td><?= ($pallet->deliveryDate ? $pallet->deliveryDate : "Not delivered") ?></td>
				<td><?= $pallet->customerName ?></td>
				<td class='state'><?= $pallet->state ?></td>
				<td class='viewbutton'>
					<a 	role="button" 
						class="btn btn-default" 
						href="showpallet.php?palletid=<?= $pallet->palletId ?>">
							View
					</a>
					<a 	role="button" 
						class="btn <?= isBlocked($pallet) ? "btn-warning" : "btn-danger" ?> pull-right" 
						href="block.php?id=<?= $pallet->palletId ?>&action=<?= isBlocked($pallet) ? "unblock" : "block" ?>&relocation=<?= url() ?>">
							<?= isBlocked($pallet) ? "Unblock" : "Block" ?>
					</a>
				</td>
			</tr>
			<?php }
		} ?>
		</tbody>
	</table>
</div>
<?php include "includes/footer.php"; ?>
