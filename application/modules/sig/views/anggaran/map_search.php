<?php
$num = count($list);
$display = ($num>1)?"none":"block";
if (is_array($list)) {
	?>
		<?php 
            foreach($list as $k=>$v) {
			//if ($diff>0) $index = floor((($v[$indikator_aktif]*1000)-($min*1000))/($diff*1000));
			$index=0;
			$val = $v[$indikator_aktif];
			for($z=0;$z<count($range);$z++) {
				if ($val>$range[$z]['min'] && $val<=$range[$z]['max']) {
					$index=$z;
					break;
				}
			}
			//echo "diff:".$diff.",min:".$min.",val:".$v[$indikator_aktif].",index".$index."<BR>";
			$legend = $color[$index];
        ?>
    	<div class="search-item">
        <div style="width:9px; height:9px; position:absolute; left:10px; top:10px; background-color:<?php echo $legend;?>"></div>
        <div style="margin-bottom:5px">
         <strong><?php echo $v['nama_wilayah'];?></strong>
         <div style="font-size:large"><?php echo $indikator[$indikator_aktif]['kategori'];?> : <?php echo number_format($v[$indikator_aktif],0,0,".");?> <?php echo $indikator[$indikator_aktif]['satuan'];?></div>
         <span><?php echo ($tahun)?"Tahun ".$tahun:"";?></span>

         <div style="margin-bottom:5px"><br />
         <small>
         <blockquote>
         <?php
         if (is_array($indikator)) { 
            foreach($indikator as $ik=>$iv) {
                if ($iv['colom_nilai']!=$indikator_aktif) {
				if (strlen($iv['kategori'])>30) {
					$alt = $iv['kategori'];
					$iv['kategori']=substr($iv['kategori'],0,25)."... ";
				}
         ?>
            <div style="width:120px; display:inline-block" title="<?php echo $alt;?>"><?php echo $iv['kategori'];?></div> <span style="margin-left:5px;border-bottom:1px dotted #999">: <strong><?php echo number_format($v[$iv['colom_nilai']],0,0,".");?></strong>  <?php echo $iv['satuan'];?></span><br />
         <?php
         }}}
         ?>
         </blockquote>
         </small>
         </div>
        <small><em style="color:#666666">Sumber: <?php echo $v['ket_dasar_hukum'];?></em></small>
     </div>
     <div class="map_search_detil">
        <a href="" class="link_small open_detil" data-kode="<?php echo $v['kode_wilayah'];?>" data-tahun="<?php echo $v['tahun'];?>" data-indikator="<?php echo $indikator_aktif;?>" >Detail</a> | <a class="link_small" href="javascript:zoomDetail('<?php echo $v['kode_wilayah'];?>')">Zoom</a>
     </div>
     </div>
         
    <?php 
    } 
    ?>
 <?php } ?>
<script>
$(document).ready(function () {
	//$("#theme_information").find("ul").remove();
	//$("#theme_information").append('<ul>info</ul>');
})
</script>