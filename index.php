<?php $title = "Pallets in storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$startDate = getSafeParam('startdate', '2000-01-01');
	$endDate = getSafeParam('enddate', '2016-01-01');
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
	    <form>
		    <div class='row'>
		    	<div class='col-sm-2'>    
		            <div class='form-group'>
		                <label>Start date</label>
		                <input type="date" class="form-control" name="startdate" value="<?= $startDate ?>"/>
		            </div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label>End date</label>
		                <input type="date" class="form-control" name="enddate" value="<?= $endDate ?>"/>
		            </div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label>Product name</label>
		                <select class="form-control" name="productname">
							<option value="">All products</option>
							<?php foreach ($products as $product) { ?>
							<option value="<?= $product; ?>" <?= ($product == $productName ? "selected=\"yes\"" : "") ?>><?= $product; ?></option>
							<?php } ?>
						</select>
		        	</div>
		        </div>
		        <div class='col-sm-2'>
		            <div class='form-group'>
		                <label>Customers</label>
		                <select class="form-control" name="customer">
							<option value="">All customers</option>
							<?php foreach ($customers as $customer) { ?>
							<option value="<?= $customer ?>" <?= $customer == $customerName ? "selected=\"yes\"" : ""; ?>><?= $customer; ?></option>
							<?php } ?>
						</select>
		            </div>
		        </div>
		        <div class='col-sm-1'>
		            <div class='form-group'>
		                <label>Blocked</label>
		                <input type="checkbox" class="form-control checkboxfix" name="blocked" value="true" <?= $blocked ? "checked" : ""; ?> />
		            </div>
		        </div>
				<div class='col-sm-1'>
		            <div class='form-group actionbuttons'>
		            	<label>Reset</label>
				        <button id="_reset_btn" type="reset" class="btn btn-default">
		    				<span class="glyphicon glyphicon-trash"></span> Reset 
						</button>
		    		</div>
		    	</div>
		        <div class='col-sm-1'>
		            <div class='form-group actionbuttons'>
		            	<label>Submit</label>
		                <button id="_search_btn" type="submit" class="btn btn-primary expandw">
		                	<span class="glyphicon glyphicon-search"></span> Search
	                	</button>
		    		</div>
		    	</div>

		    	
		    </div>
	    </form>
	</fieldset>
	<legend>Results</legend>
	<a role="button" class="btn btn-success pull-left" 
		href="createpallet.php">
		<span class="glyphicon glyphicon-plus"></span>
		Register Pallet
	</a>
	<a role="button" class="btn btn-danger pull-right" 
		href="block.php?id=all&filter=<?= urlencode(base64_encode(serialize($filter))) ?>&action=block&relocation=<?= urlencode(url()) ?>">
		Block Visible Pallets
		<span class="glyphicon glyphicon-ban-circle"></span>
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
		 	foreach ($pallets as $pallet) { ?>
			<tr class='<?= $pallet->isBlocked() ? "danger" : "" ?>'>
				<td><?= $pallet->palletId ?></td>
				<td><?= $pallet->productName ?></td>
				<td><?= $pallet->creationDate ?></td>
				<td><?= ($pallet->deliveryDate ? $pallet->deliveryDate : "Not delivered") ?></td>
				<td><?= $pallet->customerName ?></td>
				<td class='state'><?= $pallet->state ?></td>
				<td class='viewbutton'>
					<a 	role="button" 
						class="btn btn-default" 
						href="showpallet.php?id=<?= $pallet->palletId ?>">
							Details
					</a>
					<?php if (is_null($pallet->deliveryDate)){ $msg="Oh no, Cookie Monster is VERY hungry & took the whole pallet!" ?>
						<a 	role="button" class="btn btn-success" href="javascript:alert('<?= $msg; ?>');">Deliver</a>
					<?php } ?>
					<a 	role="button" 
						class="btn <?= $pallet->isBlocked() ? "btn-warning" : "btn-danger" ?> pull-right" 
						href="block.php?id=<?= $pallet->palletId ?>&action=<?= $pallet->isBlocked() ? "unblock" : "block" ?>&relocation=<?= urlencode(url()) ?>">
							<?= $pallet->isBlocked() ? "Unblock" : "Block" ?>
							<span class="glyphicon glyphicon-remove-circle"></span>
					</a>
				</td>
			</tr>
			<?php }
		} ?>
		</tbody>
	</table>
</div>
<?php include "includes/footer.php"; ?>
