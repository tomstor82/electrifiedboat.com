<!DOCTYPE html>
<html lang="en" id="html"><!-- Created by Tom Storebø, 24th of March 2020 -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electric Sailing Yacht</title>
		<link rel="stylesheet" content="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="/favicon.ico">
	</head>
	<body id="intro">
		<header class="background-color color-white">	<!--The visitors count derived from PHP-->
			<div id="php">
				<?php
	// Read user IP address from server
	function getUserIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  			//ip from shared internet
  			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  			//ip pass from proxy
 			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
  			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	$ip = getUserIpAddr();
		
	// Open external visitors IP file and place in array
	$visIpArray = file("ip_record/visIp.txt");

	// Search for current IP
	if (in_array($ip . "\n", $visIpArray)) {
		$inVisArray = 1;
	}
	else {
		$inVisArray = 0;
	}
	
	// Open external bot IP file and place in array
	$botIpArray = file("ip_record/botIp.txt");
	if (in_array($ip . "\n", $botIpArray)) {
		$inBotArray = 1;
	}
	else {
		$inBotArray = 0;
	}
	
	// Open external my IP file
	$myIp = file("ip_record/myIp.txt");
	if ($ip === $myIp[0]) {
		$inMyArray = 1;
	}
	else {
		$inMyArray = 0;
	}
	
	// If new visitor
	if ($inVisArray === 0 && $inBotArray === 0 && $inMyArray === 0) {
		
		// Open visitors file
		$file = "ip_record/visitors.txt";
		$readVis = file_get_contents($file);
		// Increment visitors variable
		$currVis = $readVis+1;	// $result++ and $result+=1 works only a few times before it stops counting
		// Write new visitors to file
		if ($currVis > $readVis) {
			file_put_contents($file, $currVis);
			echo "Welcome! You are guest number " . $currVis . ". Enjoy your visit!";
		}
		// Debugging purposes when counter fails
		else {
			echo "Visitors log: " . $readVis . ". Updated visitors: " . $currVis;
		}
		
		// If array is larger than 30 entries remove first and push onto the last
		if (sizeOf($visIpArray) > 60) {
			// Remove first index and shift the remaining one space forward
			array_shift($visIpArray);
			// Add new value after last index
			array_push($visIpArray, $ip);
			// DEBUG
			//echo "<br /\n" . "New array size is " . sizeOf($searchArray) . "<br />\n";
		}
		// If array is not exceeding preset size simply push new value behind last index
		else {
			array_push($visIpArray, "\n" . $ip);	// Must have a new line created for this to work bizarrely enough PHP IS FUCKED
		}
		// Write array to file
		file_put_contents("ip_record/visIp.txt", $visIpArray);
	}
	// If my IP
	else if ($inMyArray === 1) {
		$result = file_get_contents("ip_record/visitors.txt");
		/*$read = fopen("ip_record/visitors.txt", "r");
		$result = fgets($read);
		fclose($read);*/
		echo "Hi Tom, we've had " . $result . " guests so far.";
	}
	// If visited before
	else {
		echo "Nice to see you and have a lovely day.";
	}
	// Delete error log created by the ridiculous $visitors incrementation as ++ does not work in this shite
	if (file_exists("error_log"))	unlink(error_log);
	
?>
			</div>
			<h1>Looking to convert your boat to Electric?</h1>
			<h3>Here's how you can save money and do it youself</h3>
			<nav>
				<ul>
					<li><a href="diesel.html">Strip</a></li>
					<li><a href="electrics.html">Electrifying</a></li>
					<li><a href="arduino.html">Magic</a></li>
					<li><a href="power.html">Power</a></li>
					<li><a href="cost.html">Cost</a></li>
				</ul>
			</nav>
		</header>
		<main>
			<div id="subheader">
				This is the story of electrifying<br />
				<a href="boat.html">Mystic</a>
			</div>
			<div id="intro-img">
				<a href="images/backgrounds/mystic.jpg"><img src="images/backgrounds/mystic.jpg" alt="At anchor" /></a>
			</div>
		</main>
		<footer class="background-color">
			<address>
				<small class="color-white">Tom Storeb&oslash; 2020 - contact:</small>
				<a href="mailto:&#116;&#111;&#109;&#64;&#101;&#108;&#101;&#99;&#116;&#114;&#105;&#102;&#105;&#101;&#100;&#98;&#111;&#97;&#116;&#46;&#99;&#111;&#109;?subject=WebPage">&#116;&#111;&#109;&#64;&#101;&#108;&#101;&#99;&#116;&#114;&#105;&#102;&#105;&#101;&#100;&#98;&#111;&#97;&#116;&#46;&#99;&#111;&#109;</a>
			</address>
		</footer>
	</body>
</html>
