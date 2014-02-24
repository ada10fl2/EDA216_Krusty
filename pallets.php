<?php $page = "pallets"; include "includes/header.php"; ?>
	<h1>Pallets</h1>
	<?php 
		$items= array( 
			array("name" => "pallet1", "id" => 1, "product" => "Nut Rings"),
			array("name" => "pallet2", "id" => 2, "product" => "Nut Rings"),
			array("name" => "pallet3", "id" => 3, "product" => "Nut Rings"),
			array("name" => "pallet4", "id" => 4, "product" => "Nut Rings"),
			array("name" => "pallet5", "id" => 5, "product" => "Nut Rings"),
			array("name" => "pallet6", "id" => 6, "product" => "Nut Rings"),
			array("name" => "pallet7", "id" => 7, "product" => "Nut Rings") 
		); 
	?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Kakor</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($items as $i){ ?>
			<tr>
				<td><?= $i['id'] ?></td>
				<td><?= $i['name'] ?></td>
				<td><?= $i['product'] ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
<?php include "includes/footer.php"; ?>
