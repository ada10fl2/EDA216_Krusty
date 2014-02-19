<?php
 
// Use in the "Post-Receive URLs" section of your GitHub repo.
 
if ( $_POST['payload'] ) {

	$cmd = "ssh-add /c/Users/ur/.ssh/deploy && cd  /C/database-proj-xampp/htdocs && git pull"

	shell_exec("ssh-agent bash -c '$cmd'");
}
?>hi
