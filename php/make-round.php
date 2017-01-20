<?php
include_once '../inc/mysql-conn.php';

$last_sql = "SELECT * FROM beta_rounds WHERE start > NOW() - INTERVAL 1 HOUR ORDER BY ID DESC LIMIT 1;";
//echo $last_sql . "<br />";
$results = $conn->query($last_sql);

if($results->num_rows > 0){
	// Add 30 Min
	while($rows = $results->fetch_assoc()){
		//echo "Last: {$rows['start']}<br />\r\n";
		$new_start = date('Y-m-d H:i:s', strtotime($rows[start]) + (30 * 60));
	}
} else {
	//echo "No recent Rounds.<br />";
	// New Day
	$mm = date('i') < 30 ? "30" : "00";
	$new_start = date('Y-m-d H:') . $mm . ":00";
}
echo "Next: $new_start<br />\r\n";
$new_sql = "INSERT INTO beta_rounds VALUES (NULL, '$new_start', 1, NULL, NULL);";
$conn->query($new_sql);
$conn->close();
exit();
?>
