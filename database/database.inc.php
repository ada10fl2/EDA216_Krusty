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
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
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

	public function getPallets($startDate, $endDate){
		$sql = "SELECT palletId, creationDate FROM Pallets WHERE creationDate > ? AND creationDate < ?";
		$results = $this->executeQuery($sql, array($startDate, $endDate));
		echo $results;
	}

	public function getMovieNames() {
		$sql = "select name from Movies";
		$results = $this->executeQuery($sql);
		$output = [];
		foreach ($results as $result) {
			array_push($output, $result["name"]);
		}
		return $output; 
	}

	public function getShowDates($movieName){
		$sql = "SELECT showDate FROM Shows WHERE movieName = ?";
		$results = $this->executeQuery($sql, array($movieName));
		$output = [];
		foreach ($results as $result) {
			array_push($output, $result["showDate"]);
		}
		return $output; 
	}

	public function getShow($movieName, $showDate){
		$sql = "SELECT * FROM Shows WHERE movieName = ? AND showDate = ?";
		$results = $this->executeQuery($sql, array($movieName, $showDate));
		return $results[0];
	}

	public function makeBooking($userId, $showId){
		$sql = "INSERT INTO Reservations VALUES (null, ?, ?)";
		$error = $this->executeUpdate($sql, array($userId,$showId));
		if (!is_null($error)) {
			return ['error' => $error];
		}
		$sql_fetch = "SELECT resNbr FROM Reservations WHERE userName = ? AND showId = ?";
		$results = $this->executeQuery($sql_fetch, array($userId,$showId));
		return end($results);
	}

	/*
	 * *** Add functions ***
	 */
}
?>
