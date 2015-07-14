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
			display:none;
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
			<?php if ($bgid == 0) echo "display:block;"; ?>
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
		}
		</style>
		<script>
		jQuery( document ).ready(function() {
			var imgcnt = <?=$bgcount;?>;
			var curimage = 0;
			
		    imageinterval = setInterval(function() {
			    var newimg;
			    if (curimage == imgcnt) newimg = 1;
			    else newimg = curimage + 1;
			    
			    jQuery("#image" + curimage).fadeToggle(1000);
			    jQuery("#image" + newimg).fadeToggle(1000);
			    curimage = newimg;
			    
		    }, 3000);
		});
		</script>
	</head>
	<body>
<?php
if ($bgcount > 0)
	for ($x = 0; $x <= $bgcount; $x++) {
		?>
		<div id="image<?=$x?>" class="rotator"></div>
		<?php
	}
?>
		<div id="main-content">
			<h1>
				Test Content
			</h1>
		</div>
</body>
</html>
