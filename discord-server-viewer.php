<?php
	### CONFIG ###

	$json = "https://discordapp.com/api/guilds/xxxxxxxxxxxxxxxxxxxx.json"; # Discord widget json link
	$title = "Discord Server Viewer"; # Title.

	## COLOURS ##
	$online_color = "#2dc448";
	$idle_color = "#ff9f1c";
	$dnd_color = "#e71d36";

	### CONFIG END ###

	$j = json_decode(file_get_contents($json), true);
?>
<html>
<head>
	<title>discord</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body { font-family: Arial; font-size:120%; line-height:1.2; }
		ul {list-style: none; padding: 0;}
	</style>
</head>
<body>
	<h1 class="title"></i> <?php echo $title; ?></h1>
	<div class="content">
		<ul>
			<?php
				foreach ($j["members"] as $m) {
					$status = "";
					$voice = "";
					if(strcmp($m["status"], "online")) {
						$status = "<i class=\"fa fa-user\" style=\"color:".$online_color."\"></i> ";

						if(isset($m["channel_id"])) {
							$voice = " <i class=\"fa fa-headphones\" style=\"color:".$online_color."\"></i>";
						}
					} elseif(strcmp($m["status"], "idle")) {
						$status = "<i class=\"fa fa-user\" style=\"color:".$idle_color."\"></i> ";
						
						if(isset($m["channel_id"])) {
							$voice = " <i class=\"fa fa-headphones\" style=\"color:".$idle_color."\"></i>";
						}
					} elseif(strcmp($m["status"], "dnd")) {
						$status = "<i class=\"fa fa-user\" style=\"color:".$dnd_color."\"></i> ";
						
						if(isset($m["channel_id"])) {
							$voice = " <i class=\"fa fa-headphones\" style=\"color:".$dnd_color."\"></i>";
						}
					}

					if(isset($m["nick"])) {
						print("<li>".$status.$m["nick"].$voice.(isset($m["game"]["name"]) ? " <i class=\"fa fa-arrow-right\"></i> ".$m["game"]["name"] : "")."</li>");
					} else {
						print("<li>".$status.$m["username"].$voice.(isset($m["game"]["name"]) ? " <i class=\"fa fa-arrow-right\"></i> ".$m["game"]["name"] : "")."</li>");
					}
				}
			?>
		</ul>
	</div>
	<a href="<?php print($j["instant_invite"]); ?>"><h3>Join! <i class="fa fa-child"></i></h3></a>
</body>
</html>