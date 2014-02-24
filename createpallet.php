<?php $page = "pallets"; $title = "Produce Pallet"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$prodDate = $db->getTime();
	$productName = getSafeParam('product', false);
	$blocked = getSafeParam('blocked', false);
	$pdate = getSafeParam('pdate', false);
	$order = getSafeParam('order', false);
	if($productName){
		$prodid= $db->getProductIDFromProductName($productName);
		$splitorder = explode('-', $order);
		if(count($splitorder) === 2){
			$db->createPallet($prodid, $splitorder[1], ($blocked ? "BLOCKED": ""), $pdate);
		}
	}
	$products = $db->getProducts();
	$orders = $db->getCustomerOrders();
	?>
		<fieldset>
	    <legend>Filter</legend>
	    <form>
		    <div class='row'>
		    	<div class='col-sm-2'>   
		    		<div class='form-group'>
						<label>Products:</label>
						<select type="select" class="form-control" name="product">
						<?php
							foreach ($products as $prod) { ?>
								<option><?= $prod ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-2'>  
					<div class='form-group'>
						<label>Production Date:</label>
				 		<input type="text" name="pdate" value="<?php echo $prodDate ?>"/>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-2'>  
					<div class='form-group'>
						<label>Order:</label>
							<select type="select" class="form-control" name="order">
							<?php
								foreach ($orders as $ord) { ?>
									<option><?= $ord ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-2'>  
					<div class='form-group'>
						<label>Blocked:</label>
						<input type="checkbox" name="blocked" value="true"/><br>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-2'>  
					<div class='form-group'>
						<input type="submit" class="btn btn-primary" title="Submit">
					</div>
				</div>
		</div>
	</form>
</fieldset>
<?php include "includes/footer.php"; ?>