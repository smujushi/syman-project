<?php
$title = "SYMAN";
include_once 'inc/mysql-conn.php';
//include_once __PATH__ . '/inc/cleanup.php';
?>
<!DOCTYPE html>
<html>
<?php include_once 'inc/header.php'; ?>
<body>
<div data-role="page">
	<div data-role="header">
		<h2>SYMAN</h2>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<div class="center">
			<p>Are you ready to play?</p>
			<a href="php/new-player.php" id="play-btn" data-ajax="false">)'( Play</a>
			<p>The next round begins in <span id="time-counter">00:00</span>
		</div>
		<div class="about ui-widget">
			<div class="ui-widget-header center ui-corner-top" style="padding: 7px;">About</div>
			<div class="ui-widget-content ui-corner-bottom" style="padding: 0 10px;">
				<p>You are connected to a competative interactive game of Simon Says. When the round starts, patterns will be shown on the light board in front of you. You, and the other people playing that round, are tasked with repeating that pattern. Get the pattern correct and do it as fast as you can to score more points. The next level will begin.</p>
				<p>At the end of 10 levels, the winner is the person with the highest score.</p>
			</div>
		</div>
		<div class="hidden">
			PSST! I have a secret! Tap on me.
		</div>
	</div><!-- /content -->

	<div data-role="footer">
		<h4>Part of the South Bay Burners Art Projects for 2017</h4>
	</div><!-- /footer -->
</div><!-- /page -->
<script>
$(".hidden").click(function(){
	window.location.href = ".hidden";
});
$c = $("#time-counter");
var diff, timeinterval;
$.getJSON("php/next-round-time.php", function(round){
        var now = new Date(round.now);
        var start = new Date(round.start);
        diff = start - now;
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
