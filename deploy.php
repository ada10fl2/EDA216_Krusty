<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
$cmd = "'ssh-add /c/Users/ur/.ssh/deploy; cd /c/database-proj-xampp/htdocs; \"/c/Program Files (x86)/Git/bin/git\" pull origin master'";
echo "Runnning...\n<br>";
$agent = "C:\\Program Files (x86)\\Git\\bin\\ssh-agent.exe";
$bash =  "C:\\Program Files (x86)\\Git\\bin\\bash.exe";
$exec = "\"$agent\" \"$bash\" -c $cmd 2>&1";
echo "<pre>$exec</pre>";
echo shell_exec($exec);
echo "<br>...Done!";
?>
