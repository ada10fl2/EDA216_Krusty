<?php include "includes/header.php"; ?>
	<pre>
	Date: 
	<?php
	$db->getPallets('2001-01-01', '2015-01-01');
	?>
	</pre>
<?php include "includes/footer.php"; ?>
