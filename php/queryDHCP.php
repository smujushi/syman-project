<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$command = "dhcp-lease-list --lease /var/lib/dhcp/dhcpd.leases";

exec($command, $lines);

$rLines = array_slice($lines, 2);

//echo "<pre>";
//var_export($lines);
//var_export($rLines);
$results = array();

foreach($rLines as $line){
	$vals = preg_split("/\s{2}/i", $line);
	$vals[2] = trim($vals[2]);
	$host = substr($vals[2], 0, stripos($vals[2], "2016"));
	$vals[3] = substr($vals[2], strpos($vals[2], "2016"));
	$vals[4] = substr($vals[3], strpos($vals[3], " ", 12) + 1);
	$vals[3] = substr($vals[3], 0, 19);
	array_push(
		$results,
		array(
			"mac" => $vals[0],
			"ip" => $vals[1],
			"host" => $host,
			"expire" => $vals[3],
			"manf" => $vals[4]
		)
	);
}
//var_export($results);
//echo "</pre>";
header('Content-Type: application/json');
echo json_encode($results);
?>
