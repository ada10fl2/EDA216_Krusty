<?php $page = "pallets"; include "includes/header.php"; ?>
	<h1>Pallets</h1>
<?php $items= array( array("name" => "pallet1", "id" => 123), array("name" => "pallet2", "id" => 1234) ); ?>
	<table class="table table-striped">
		<tr>
			<th>#</th>
			<th>Name</th>
        </tr>
		<?php foreach($items as $i){ ?>
		<tr>
			<td><?= $i['id'] ?></td>
			<td><?= $i['name'] ?></td>
		</tr>
		<?php } ?>
	</table>
<?php include "includes/footer.php"; ?>
