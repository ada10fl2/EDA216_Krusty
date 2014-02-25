<?php include "includes/header.php"; ?>
<?php
	$id = getSafeParam("id","None");
	$url = getSafeParam("relocation","None");
	$action = getSafeParam("action","None");
?>
	<h1>Please hold...</h1>
	<p>
		<?php
			$filter = unserialize(base64_decode(urldecode(getSafeParam("filter","YToxOntzOjU6ImVtcHR5IjtzOjQ6InRydWUiO30=")))) ;
			if(is_numeric($id)){ //remove single
				if($action === "block"){
					$db->blockSinglePallet($id);
				} else if($action === "unblock") {
					$db->unblockSinglePallet($id);
				} else{
					echo "Unsupported action";
				}
			} else { //Remove query
				$db->blockQuery($filter);
			}
		?>
	</p>
	<script>
		document.location = '<?= $url ?>';
	</script>
<?php include "includes/footer.php"; ?>
