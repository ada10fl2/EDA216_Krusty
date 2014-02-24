<?php
$host = "127.0.0.1";
$username = "eda216";
$password = "eda216";
$database = "eda216";

$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("select now()");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<html>
<head><title>PDO Connection Test</title><head>
<body>
<h2>PDO Connection Test</h2>

Now is (fetched from <?php echo $host ?>): 
<?php 
    print $result[0][0];
	print ".";
?>
</body>
</html>
