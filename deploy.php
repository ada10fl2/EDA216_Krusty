<?php
 
// Use in the "Post-Receive URLs" section of your GitHub repo.
 
if ( $_POST['payload'] ) {
	shell_exec( 'cd  C:\database-proj-xampp\htdocs && git reset --hard HEAD && git pull' );
}
 
?>hi