<?php
session_start();

require_once '../inc/mysql-conn.php';

if(isset($_SESSION['player'])){
	echo "Found Player.<br />";
	$player = $_SESSION['player'];
} else {
	echo "No Player Found.<br />";

	$player = array();
	// Find next Player ID
	$t = $table_prefix . "player";
	$new = "INSERT INTO $t VALUES (NULL, NOW(), 1, NULL, NULL);";
	if($conn->query($new)){
		$player['id'] = $conn->insert_id;
		$player['name'] = "Player {$player['id']}";
	} else {
		echo "MySQLi Querry Error: " . $conn->error;
		$conn->close();
		die();
	}
}
/*
// Find next round, add player
$round = "SELECT ID, NOW() as 'now', start FROM `beta_rounds` WHERE `open` = 1 AND `start` >= NOW() + INTERVAL 5 MINUTE;";
if($results = $conn->query($round) === true){
	if($results->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$next = $row['ID'];
			$players = unserialize($row['players'];
			$start = $row['start'];
			if(count($players) < 50){
				array_push($players, $player['id']);
				$player['round'] = $next;
				break;
			}
		}
	}
}

//$meta = "INSERT INTO beta_playersmeta VALUES (NULL, $player_id, 'score', 0);";
*/
$conn->close();

//$_SESSION['player'] = $player;
//echo json_encode($player);
header("location: ../play.php");
?>
