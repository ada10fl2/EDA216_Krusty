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
	<form>
		<p>
			Product: <select type="select" name="product">
					<?php

					foreach ($products as $prod) { ?>
						<option><?= $prod ?></option>
					<?php } ?>
						
						</select> <br>
			Production Date: <input type="text" name="pdate" value="<?php echo $prodDate ?>"/><br>
			Order: <select type="select" name="order">
					<?php

					foreach ($orders as $ord) { ?>
						<option><?= $ord ?></option>
					<?php } ?>
						
						</select> <br>
			Blocked: <input type="checkbox" name="blocked" value="true"/><br>
			<input type="submit" class="btn btn-primary" title="Submit">
		</p>
	</form>
<?php include "includes/footer.php"; ?>