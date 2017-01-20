<?php

// Check service status of primary services
// hostapd, isc-dhcp-server
// return JSON of status list
header('Content-Type: application/json');

$services = array(
	"hostapd" => "",
	"isc-dhcp-server" => "",
	"apache2" => "",
	"mysql" => ""
);

foreach($services as $k => $v){
	$o = shell_exec("service $k status | grep -i active");
	//echo json_encode($o);
	if(strpos("\n")){
		$p = explode("\n", $o);
		$services[$k] = $p[0];
	} else {
		$services[$k] = trim($o);
	}
}

echo json_encode($services);
?>
