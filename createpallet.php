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
                        $state = ($blocked ? "BLOCKED": "STORED");
			$db->createPallet($prodid, $splitorder[1], $state, $pdate);
		}
	}
	$products = $db->getProducts();
	$orders = $db->getCustomerOrders();
	?>
		<fieldset>
	    <form class="form-horizontal col-xs-6 well well-lg" role="form">
		    <div class='form-group'>
				<label class="col-sm-4 control-label">Products:</label>
				<div class="col-sm-8">
					<select type="select" class="form-control" name="product">
					<?php
						foreach ($products as $prod) { ?>
							<option><?= $prod ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class='form-group'>
				<label class="col-sm-4 control-label">Production Date:</label>
				<div class="col-sm-8">
		 			<input type="text" class="form-control" name="pdate"  value="<?= $prodDate ?>"/>
		 		</div>
			</div>
			<div class='form-group'>
				<label class="col-sm-4 control-label">Order:</label>
				<div class="col-sm-8">
					<select type="select" class="form-control" name="order">
						<?php
							foreach ($orders as $ord) { ?>
								<option><?= $ord ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class='form-group'>
				<label class="col-sm-4 control-label">Blocked:</label>
				<div class="col-sm-2">
					<input type="checkbox" class="form-control checkboxfix" name="blocked" value="true"/>
				</div>
				<div class="col-sm-6"></div>
			</div>
			<div class='form-group'>
				<div class="col-sm-12">
					<a role="button" class="btn btn-link btn-lg pull-left" href="/">
					<span class="glyphicon glyphicon-ban-circle"></span>
					Cancel
					</a>
					<input type="submit" class="btn btn-success btn-lg pull-right" title="Submit">
				</div>
			</div>
		</div>
	</form>
</fieldset>
<?php include "includes/footer.php"; ?>