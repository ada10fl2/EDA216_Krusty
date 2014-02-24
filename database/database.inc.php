<?php
/*
 * Class Database: interface to the movie database from PHP.
 *
 * You must:
 *
 * 1) Change the function userExists so the SQL query is appropriate for your tables.
 * 2) Write more functions.
 *
 */
require_once('./database/pallet.php');

class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", 
				$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
		} catch (PDOException $e) {
			return $e->getMessage();
		} 
			// $error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			// die($error);
	}

	private function createPallets($pallets){
		$output = [];
		foreach ($pallets as $result) {
			$pallet = new Pallet();
			$pallet->palletId = $result['palletID'];
			$pallet->creationDate = $result['creationDate'];
			$pallet->state = $result['currentState'];
			$pallet->productName = $result['productName'];
			$pallet->customerName = $result['customerName'];
			$pallet->deliveryDate = $result['loadingDate'];
			array_push($output, $pallet);
		}
		return $output;
	}

	public function getPallets($startDate, $endDate, $productName, $blocked, $customer){
		//Dat join
		$sql = "SELECT Pallets.palletID, Pallets.creationDate, Pallets.currentState, Products.productName, Customers.customerName, LoadingOrders.loadingDate FROM pallets LEFT OUTER JOIN loadingOrderContents ON Pallets.palletId = loadingOrderContents.palletId LEFT OUTER JOIN LoadingOrders ON loadingOrderContents.loadingOrderlD = LoadingOrders.loadingOrderlD INNER JOIN products ON Products.productid = Pallets.productid INNER JOIN Orders ON Orders.orderID = Pallets.orderID INNER JOIN Customers ON Orders.customerID = Customers.customerID WHERE creationDate >= ? AND creationDate <= ?";
		$parameters = [$startDate, $endDate];
		if ($blocked) {
			$sql = $sql." AND Pallets.currentState = 'BLOCKED'";
		}
		if ($productName) {
			$sql = $sql." AND Products.productName = ?";
			array_push($parameters, $productName);
		}
		if ($customer) {
			$sql = $sql." AND Customers.customerName = ?";
			array_push($parameters, $customer);
		}
		$sql = $sql." ORDER BY Pallets.palletID";
		return $this->createPallets($this->executeQuery($sql,$parameters));
	}

	public function getPallet($palletId){
		$sql = "SELECT * FROM Pallets WHERE palletId = ?";
		$results = $this->executeQuery($sql, array($palletId));
		return $this->createPallets($results)[0];
	}

	public function getProducts(){
		$sql = "SELECT productName from Products";
		$results = $this->executeQuery($sql);
		$output = [];
		foreach ($results as $result) {
			array_push($output, $result['productName']);
		}
		return $output;
	}

	public function getCustomers(){
		$sql = "SELECT customerName from Customers";
		$results = $this->executeQuery($sql);
		$output = [];
		foreach ($results as $result) {
			array_push($output, $result['customerName']);
		}
		return $output;
	}
}
?>
