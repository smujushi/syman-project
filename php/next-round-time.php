<?php
include_once '../inc/mysql-conn.php';

$sql = "SELECT ID, NOW() as 'now', start, start - NOW() as 'diff' FROM `beta_rounds` WHERE open = 1 AND NOW() > start - INTERVAL 30 MINUTE;";
$results = $conn->query($sql);
if($results->num_rows > 0){
	while($row = $results->fetch_assoc()) {
		$round['id'] = $row['ID'];
		$round['now'] = $row['now'];
		$round['start'] = $row['start'];
		$round['diff'] = $row['diff'];
	}
} else {
	echo "MySQLi Rows: " . $results->num_rows . "<br />\r\n";
	echo "MySQLi Query Error: " . $conn->error;
	$conn->close();
	die();
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($round);
?>
