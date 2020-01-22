<?php
header('Content-Type: application/json');
global $pdo;
class PDOcontroller {
		private $host =  'localhost';
		private $user = 'root';
		private $password = '12345';
		private $dbname = 'loggingdb';
		function pdoconnect (){
			try {
				$pdo = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				echo 'succes';
			} catch (PDOException $e) {
				echo $e->getMessage();
				die('Failed to connect to database!');
			}
			return $pdo;
		}
	function runQuery($query) {
		$result = $pdo->prepare($query);
		while($resultset = $result->fetch(PDO::FETCH_ASSOC)){
			echo $resultset['name'];
		} 
		if(!empty($resultset))
			return $resultset;
	}
	function numRows($query) {
		$result = $pdo->prepare($query);
		$rowcount = PDO::rowCount($result);
		return $rowcount;	
	}
	function execute($query) {
		$result = $pdo->prepare($query);
		$result->execute(['name' => $name]);
		$toy = $result->fetchAll();
		return $toy;	
	}
}
?>