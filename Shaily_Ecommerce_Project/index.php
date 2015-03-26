<html>
	<head>
		<title>E-Lottery Pool Homepage</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="countdown.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$( document ).ready(function() {
				
				$.ajax({
					url: 'get_total.php',
					type: 'post',
					data: {'action': 'get_total'},
					success: function(output) {
						document.getElementById("pool_value").innerHTML = '$'+output;
					},
					
					
				});
			});
			
			
		</script>
		
	</head>
	<body>
		<div id="title_div" onclick="location.href='index.php';">
			<p id="title">E-Lottery Pool</p>
			
		</div>
		<div id="option_bar">
			<ul>
				<div id="home_tab" onclick="location.href='index.php';"><li class="bar">Home</li></div>	
				<div id="about_tab" onclick="location.href='about.php';"><li class="bar">How It Works</li></div>	
				<div id="buy_tab" onclick="location.href='buy.php';"><li class="bar">Buy Tickets</li></div>	
				
			</ul>
		</div>
		
		
		
		
		<div id="countdown2">
		<table align="center">
		<tr>
			<p id="time_left">Time To Next Draw:</p>
			</tr>
			<tr>
			<div id="countdown">
				<?php
					
					$draw_date = getdate();
					$draw_date[0] -= $draw_date['seconds'];
					$draw_date[0] -= $draw_date['minutes'] * 60;
					
					$current_hour = $draw_date['hours'];
					
					$draw_date[0] -= $draw_date['hours'] *60 * 60;
					
					$draw_date[0] += 14 * 60 * 60;
					
					if ($current_hour >= 14)
					{
						$draw_date[0] += 86400;
						
					}
					$seconds_remaining = $draw_date[0] - time();
					
					
					$str = '<script>var myCountdown1 = new Countdown({time:'.$seconds_remaining.',onComplete : countdownComplete, rangeHi : "hour", hideLine : true,
					numbers		: 	{
					font 	: "Arial", // Arial Times Verdana etc... see "numberMarginTop" above to correct vertical centering
					color	: "#000000",
					bkgd	: "#FFFFFF",
					rounded	: 0.15,				// percentage of size 
					shadow	: {
					x : 0,			// x offset (in pixels)
					y : 3,			// y offset (in pixels)
					s : 0,			// spread
					c : "#000000",	// color
					a : 0.0			// alpha	// <- no comma on last item!
					}
					}});
					function countdownComplete(){location.reload();}</script>';
					echo $str;
					
				?>
			</div>
			
			<br>
			<br>
			</tr>
			<tr>
			<div id="pool">
			<p id="pool_text"> Current Pool Amount:</p><p id="pool_value"></p>
			</div>
			</tr>
			<tr>
			<div id="start" onclick="location.href='buy.php';">
				<p id="start_text">Join The Pool!</p>
			</div>
			</tr>
		</div>
	</body>
	
	
</html>
