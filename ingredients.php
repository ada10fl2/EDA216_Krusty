<?php $page = "ingredients"; $title = "Ingredients in storage"; include "includes/header.php"; ?>
	<h1><?= $title ?></h1>
	<?php 
		$ings = $db->getIngredients();
	?>
	<table class="table table-striped pallet-table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($ings)){
		 	foreach ($ings as $ing) { ?>
			<tr>
				<td><?= $ing->ingredientID ?></td>
				<td><?= $ing->name ?></td>
				<td><?= $ing->amountInStorage ?></td>
			</tr>
			<?php 
			}
		} else { ?>
			<tr>
				<td colspan="3">No ingredients registered</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<?php include "includes/footer.php"; ?>
