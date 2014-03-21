<?php $page = "pallets"; $title = "Produce Pallet"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
	$remains = array();
	$prodDate = $db->getTime();
	$productName = getSafeParam('product', false);
	$blocked = getSafeParam('blocked', false);
	$pdate = getSafeParam('pdate', false);
	$order = getSafeParam('order', false);
	$was_submit = ($productName !== false);
	$success = false;
	if($was_submit){
		function is_negative($ing){ return $ing->amountInStorage < 0; }
		
		$prodid= $db->getProductIDFromProductName($productName);
		$subtractedIngredients = $db->getSubtractedIngredients($prodid);
		$remains = array_filter($subtractedIngredients, "is_negative");
		$success = (count($remains) === 0);
		if($success) {
			$splitorder = explode('-', $order);
			$id = "(None)";
			if(count($splitorder) === 2){
	            $state = ($blocked ? "BLOCKED": "STORED");
				$id = $db->createPallet($prodid, $splitorder[1], $state, $pdate);
			}
			?>
			<div class="alert alert-success">
				<strong>Well done!</strong>
				Pallet (ID: <?= $id ?>) was successfully created!
			</div>
			<?php
		} else { 
			?>
			<div class="alert alert-danger">
				<strong>Oh Snap!</strong>
				Missing ingredients!
			</div>
			<?php 
		}
	}

	$products = $db->getProducts();
	$orders = $db->getCustomerOrders();

	$hasError = ($was_submit && !$success) ? "has-error" : "";

	?>
		<fieldset>
	    <form class="form-horizontal col-xs-6 well well-lg" role="form">
		    <div class='form-group <?= $hasError ?>'>
				<label class="col-sm-4 control-label">Products:</label>
				<div class="col-sm-8">
					<select type="select" class="form-control" name="product" 
					onchange="$('.form-group').removeClass('has-error'); $('#remains').fadeOut(); $('.alert').fadeOut()">
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
			<?php if(is_array($remains) && count($remains) > 0){ ?>
			<div class='form-group <?= $hasError ?>' id="remains">
				<label class="col-sm-4 control-label">Missing:</label>
				<div class="col-sm-8">
					<table class="table table-striped pallet-table well">
						<thead>
							<tr>
								<th>Name</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						 	<?php foreach ($remains as $rem) { ?>
							<tr>
								<td><?= $rem->name ?></td>
								<td><?= abs($rem->amountInStorage) ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php } ?>
			<div class='form-group'>
				<div class="col-sm-12">
					<span class="glyphicon glyphicon-ban-circle pull-left btn-lg" style="padding-right:0px; position:relative; top:3px;"></span>
					<a role="button" class="btn btn-link btn-lg pull-left" style="padding-left:4px" href="/">Cancel</a>
					<input type="submit" class="btn btn-success btn-lg pull-right" title="Submit">
				</div>
			</div>
		</div>
	</form>
</fieldset>

<?php include "includes/footer.php"; ?>