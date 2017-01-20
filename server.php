<?php
session_start();
$title = "SYMAN STATS";
if($_GET['status']){
	// Check Server status
	$conn = new mysqli("localhost", "syman.play", "BxL2GRlqfcpT0fSr8tRk");
	if ($conn->connect_error) {
		die("{ \"error\": \"Connection failed: " . $conn->connect_error . "\" }");
	}
	$player_id = $_SESSION['pid'];
	$conn->close();
}
?>
<html>
<?php include_once 'inc/header.php' ?>
<body>
<div data-role="page">
	<div data-role="header">
		<a href="./" data-ajax="false">Back</a>
		<h2>Stats</h2>
		<a href="./play.php" data-ajax="false">Play</a>
	</div>
	<div data-role="content">
<?php
if(isset($player['name'])){
}
// Server Stats
//$serverStats = file_get_contents("./php/phpsysinfo-3.2.6/xml.php?json");
//var_export($serverStats);
?>
		<script>
		$(function(){
			var leases;
			var services;
			$.getJSON("php/queryDHCP.php", function(l){
				console.log(l[0]);
				leases = l.length;
			});
			$.getJSON("php/queryServices.php", function(s){
				console.log(s);
				services = s;
			});
			$.ajax({
				url: "php/phpsysinfo-3.2.6/xml.php?json",
				type: "GET",
				dataType: "json",
				success: function(s){
					var vitals = s.Vitals['@attributes'];
					var lastBoot = new Date(Date.now() - vitals.Uptime);
					var options = {
						weekday: "long", year: "numeric", month: "short",
						day: "numeric", hour: "2-digit", minute: "2-digit"
					};
					var cpu = s.Hardware.CPU.CpuCore['@attributes'];
					//var temp = s.MBInfo.Temperature.Item['@attributes'];
					var mem = s.Memory['@attributes'];
					var net = s.Network.NetDevice['@attributes'];
					var $t = $("#vital-stats-table tbody");
					console.log(cpu, vitals, mem, net);
					$t.append("<tr><td class='ui-widget-header'>CPU Model</td><td>" + cpu.Model + "</td><tr>");
					$t.append("<tr><td class='ui-widget-header'>OS</td><td>" + vitals.OS + "</td></tr>");
					$t.append("<tr><td class='ui-widget-header'>Kernel</td><td>" + vitals.Kernel + "</td></tr>");
					$t.append("<tr><td class='ui-widget-header'>Distro</td><td><img style='height: 1em;' src='php/phpsysinfo-3.2.6/gfx/images/" + vitals.Distroicon + "' /> " + vitals.Distro + "</td></tr>");
					$t.append("<tr><td class='ui-widget-header'>Uptime</td><td>" + secondsToString(vitals.Uptime) + "</td></tr>");
					$t.append("<tr><td class='ui-widget-header'>Last Boot</td><td>" + lastBoot.toLocaleDateString("en-US", options) + "</td></tr>");
					$t.append("<tr><td class='ui-widget-header'>Memory</td><td><div id='memory-bar' style='position: relative'><div class='progress-label' style='position: absolute; left: 50%; top: 4px; font-weight: bold; text-shadow: 1px 1px 0 #fff;'>" +mem.Percent + "% In Use</div></div></td></tr>");
					$("#memory-bar").progressbar({ value: parseInt(mem.Percent) });
					$t.append("<tr><td class='ui-widget-header'>Network</td><td>RX: " + humanFileSize(parseInt(net.RxBytes),true) + ", TX: " + humanFileSize(parseInt(net.TxBytes),true) + ", Leases: " + leases + "</td></tr>");
					var html = "<tr><td class='ui-widget-header'>Services</td><td>";
					$.each(services, function(k, v){
						html += "<label class='serviceLabel'>" + k.toUpperCase() + "</label>";
						html += "<span class='serviceValue'>" + v + "</span>";
					});
					html += "</td></tr>";
					$t.append(html);
				}
			});
		})
		</script>
		<div id="serverStats">
			<table id="vital-stats-table" data-role="table">
				<thead>
					<tr>
						<th colspan="2">Server</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>
