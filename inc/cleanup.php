<?php
require_once 'options.php';
require_once 'mysql-conn.php';
$t = $table_prefix . "rounds";
$conn->query("UPDATE $t SET open = 0 WHERE `start` < NOW();");
$r = $conn->query("SELECT ID FROM beta_rounds WHERE open = 1;");
if($r->num_rows == 0){
	include __PATH__ . '/php/make-round.php';
}
?>

