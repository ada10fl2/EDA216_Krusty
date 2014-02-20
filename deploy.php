<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
$cmd = "ssh-add /c/Users/ur/.ssh/deploy; cd /c/database-proj-xampp/htdocs; git pull origin master";
echo "Runnning...\n<br>";
echo shell_exec("ssh-agent bash -c '$cmd'");
echo "...Done!";
?>
