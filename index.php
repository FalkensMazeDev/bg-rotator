<?php

$bgimageslocation = "bgimages";
$files = scandir($bgimageslocation);

$bgimages = array();
$allowed_ext = array("jpg","png","jpeg","gif");
foreach ($files as $filename) {
	$ext = end(explode('.', $filename));
	$ext = strtolower(substr(strrchr($filename, '.'), 1));
	//echo $filename . " EXT: " .$ext. "<br>";
	if (in_array($ext,$allowed_ext)) {
		$bgimages[] = $bgimageslocation ."/" . $filename ;
	}
}
$bgcount = count($bgimages);

?><html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<style>
		.rotator {
			position: absolute;
			width:100%;
			height:100%;
			top:0px;
			left:0px;
			z-index:-9999;
		}
<?php
if ($bgcount > 0) {
	foreach ($bgimages as $bgid => $bgimage) {
		
		?>
		#image<?=$bgid;?> {
			background:url('<?=$bgimage;?>') no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php 
			if ($bgid == 0) echo "display:block;";
			else echo "display:none;";
			
			?>
		}
		<?php
	}
	
}
?>
		#main-content {
			max-width: 900px;
			margin:auto;
			background-color:#fff;
			opacity:.7;
			padding:20px;
		}
		</style>
		
	</head>
	<body>
<?php
if ($bgcount > 0)
	for ($x = 0; $x < $bgcount; $x++) {
		?>
		<div id="image<?=$x?>" class="rotator"></div>
		<?php
	}
?>
		<div id="main-content">
			<h1>
				BG Rotator Script
			</h1>
			<p>
				This little script crawls a given directory for files with extensions that are matching specified extensions.  It then takes those images and outputs them as background images and fades between them.
			</p>
			<p>
				This project can be found on GitHub at <a target="_blank" href="https://github.com/WPCMSNinja/bg-rotator" >https://github.com/WPCMSNinja/bg-rotator</a>
			</p>
			<p>
				<a href="#" class="stopBgImages">Stop Rotating</a>
				<a href="#" class="startBgImages">Start Rotating</a>
			</p>
		</div>
</body>
<script>
		jQuery( document ).ready(function() {
			var imgcnt = <?=$bgcount;?>;
			var curimage = 0;
			var rotatorCall;
			var fadetime = 1000;
			var waittime = 3000;
			var stopBgImages = false;
			
			var changeBgImage = function () {
				if (!stopBgImages) {
				    var newimg;
				    if (curimage == (imgcnt-1)) newimg = 0;
				    else newimg = curimage + 1;

				    jQuery("#image" + curimage).fadeToggle(fadetime);
				    jQuery("#image" + newimg).fadeToggle(fadetime);
					jQuery("#image" + newimg).promise().done(function(){
						rotatorCall = setTimeout(function(){ changeBgImage()}, waittime);
					});
					curimage = newimg;
				}
			}
			
			rotatorCall = setTimeout(function(){ changeBgImage()}, waittime);
			
			jQuery(".stopBgImages").click(function(){
				stopBgImages = true;
				//console.log("attemptstop");
			});
			
			jQuery(".startBgImages").click(function(){
				stopBgImages = false;
				changeBgImage();
				//console.log("attemptstop");
			});
			
		});
</script>
</html>