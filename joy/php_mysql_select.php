<?php 
	echo "<table style='border: solid 1px black;'>";
	echo "<tr>
			<th>Id</th>
			<th>Firstname</th>
			<th>Lastname</th>
		  </tr>";

	class TableRows extends RecursiveIteratorIterator{
		function __construct ($it){
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current(){
			return "<td style='width:150px;border:1px solid black;'>"
					.parent::current()."</td>";
		}
		function beginChildren(){
			echo "<tr>";
		}

		function endChildren(){
			echo "</tr>". "\n";
		}
	}
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbName = "mydbPDO";

		try{
			$dsn = 'mysql:host='. $host .';dbname='.$dbName;
			$pdo = new PDO($dsn, $user,$password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare("SELECT id, firstname,lastname FROM MyGuests");
			$stmt->execute();

			// set the resulting array to associative
			$result = $stmt-> setFetchMode(PDO::FETCH_ASSOC);
			foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				# code...
				echo $v;
			}

		}
		catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
		$conn = null;
		echo "</table>";

?>
