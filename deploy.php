<?php
 
// Use in the "Post-Receive URLs" section of your GitHub repo.
 
if ( isset($_POST['payload']) && is_object($_POST['payload']) ) {

	$cmd = "ssh-add /c/Users/ur/.ssh/deploy && cd  /c/database-proj-xampp/htdocs && git pull origin master";
        echo "Runnning...";
	echo shell_exec("ssh-agent bash -c '$cmd'");
        echo "Done!";
}
?>
