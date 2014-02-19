<?php
 
// Use in the "Post-Receive URLs" section of your GitHub repo.
 
if ( isset($_POST['payload']) && $_POST['payload'] ) {

	$cmd = "ssh-add /c/Users/ur/.ssh/deploy && cd  /c/database-proj-xampp/htdocs && git pull";

	echo shell_exec("ssh-agent bash -c '$cmd'");
}
?>
