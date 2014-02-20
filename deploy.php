<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
$cmd = "ssh-add /c/Users/ur/.ssh/deploy; cd /c/database-proj-xampp/htdocs; git pull origin master";
echo "Runnning...\n";
$exec = "\"C:\\Program Files (x86)\\Git\\bin\\ssh-agent.exe\" bash -c '$cmd' 2>&1";
echo $exec;
echo shell_exec($exec);
echo "\n...Done!";
?>
