<?php
session_start();
$title = "PLAY SYMAN"
?>
<html>
<?php include_once 'inc/header.php'; ?>
<body>
<div data-role="page">
	<div data-role="header">
		<h2>PLAY</h2>
	</div>
	<div data-role="content">
<?php
?>
		<div id="wait-next-round" class="ui-widget">
			<div class="ui-widget-header center">Please Wait...</div>
			<div class="ui-widget-content center">
				<p>Round <span id="roundId">0</span> will begin in <span id="roundCounter">00:00</span>.</p>
			</div>
		</div>
		<div id="player-details" class="ui-widget center" style="margin-top: 2em;">
			<label class="ui-widget-header center">Your Round</label>
			<div id="playerRound" class="ui-widget-content center">0</div>
			<label for="playerName" class="ui-widget-header">Player Name</label>
			<div class="ui-widget-content">
				<input type="text" id="playerName" style="display: inline-block; width: 75%;" value="<?php echo $_SESSION['player']['name']; ?>" /> <a href="#" id="save-player-btn" data-ajax="false" style="float: left;">Save</a>
				<p class="info">This will be stored in a cookie on your browser.</p>
			</div>
		</div>
<?php
?>
		<div id="play-board" class="ui-widget">
		</div>

	</div>
</div>
<script>
var $c = $("#roundCounter");
var $r = $("#roundId");
var diff, timeinterval;
$.getJSON("php/next-round-time.php", function(round){
	var now = new Date(round.now);
	var start = new Date(round.start);
	diff = start - now;
	$r.html(round.id.toString());
	$c.html(showTime(diff));
	timeinterval = setInterval(function(){
		diff -= 1000;
		$c.html(showTime(diff));
		if(diff < 1000){
			clearInterval(timeinterval);
			location.reload(true);
		}
	}, 1000);
});
</script>
</body>
</html>
