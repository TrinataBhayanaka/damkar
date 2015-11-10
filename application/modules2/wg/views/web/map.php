<?php 
	$w=($width)?$width:"100%"; 
	$h=($width)?$height:200; 
?>
<?php if ($title) { ?><h3 class="rightsub" style="border-bottom:0px solid #0a3e73">Map</h3><? } ?>
<iframe src="/portal/gis/map_widget?w=<?=$width;?>&h=<?=$height;?>" frameborder="0" height="<?=$h;?>" width="<?=$w;?>" scrolling="no"></iframe>