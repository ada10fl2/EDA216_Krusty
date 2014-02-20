<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
$git = "/c/Program Files (x86)/Git/bin/git";
$sshadd = "/c/Program Files (x86)/Git/bin/ssh-add";
$cmd = "'\"$sshadd\" /c/Users/ur/.ssh/deploy; "
     . "cd /c/database-proj-xampp/htdocs; "
     . "\"$git\" pull origin master'";

$agent = "C:\\Program Files (x86)\\Git\\bin\\ssh-agent.exe";
$bash =  "C:\\Program Files (x86)\\Git\\bin\\bash.exe";
$exec = "\"$agent\" \"$bash\" -c $cmd 2>&1";
echo "Runnning...\n<br>";
echo "<pre>$exec</pre>";
echo shell_exec($exec);
echo "<br>...Done!";
?>
