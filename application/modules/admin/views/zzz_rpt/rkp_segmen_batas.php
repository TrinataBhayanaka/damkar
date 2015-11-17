<div class="row">
    <div class="col-sm-12">
        <div class="simple_box box_shadow" style="background-color:#FBFBFB;padding:10px;">
               <div class="btn-group pull-right">
                   <div class="btn-group">
                          <a id="btn_down" class="btn btn-sm btn-default" href="#"><i class="icon-download-alt"></i> Print/Download </a>
                          <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"> </span></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="#" class="print-pdf" data-url=""><i class="fam-page_white_acrobat"></i> PDF</a></li>
                            <li><a href="#" class="print-html" data-url=""><i class="icon icon-print"></i> Print</a></li>
                            <li><a href="#" class="print-excel" data-url=""><i class="fam-page_white_excel"></i> Excel</a></li>
                            
                          </ul>
   </div></div>
   <div class="clearfix"></div>
   </div>
   
   </div></div>

<div class="formSep"></div>


<div class="row">
<div class="col-sm-12">
<div id="print_this">
<p class="tc">REKAP PENEGASAN BATAS BERDASARKAN SEGMEN BATAS :</p>
<? 
	foreach($arrData as $x=>$val):
    	$data_tmp=array();
		$tahun_max_arr[]=max(array_keys($val["data_per_tahun"]));
		foreach($val["data_per_tahun"] as $x1=>$val1):
			if($x1<=2003):
				$data_tmp[]=$val1;
			endif;
		endforeach;
		if(cek_array($data_tmp)):
			$arrData[$x]["data_lt_2003"]=array_sum($data_tmp);
		endif;
	endforeach;
	$tahun_max_arr[]=date("Y");
	
?>
<table class="table table-bordered">
	<thead>
    		<th>Wilayah</th>
 		   	<th class="tc">1945-2003</th>
			<?php for($i=2004;$i<=max($tahun_max_arr);$i++):?>
            	<th class="tc"><?php echo $i?></th>
            <?php endfor;?>
    </thead>
    <tbody>
    	<?php foreach($arrData as $x=>$val):?>
    	<tr>
        	<td><?php echo strtoupper($val["batas_wilayah"])?></td>
			<td class="tc"><?php echo cek_var($val["data_lt_2003"])?$val["data_lt_2003"]:'-'?></td>
			<?php for($i=2004;$i<=max($tahun_max_arr);$i++):?>            
            	<td class="tc"><?php echo cek_var($val["data_per_tahun"][$i])?$val["data_per_tahun"][$i]:'-'?></td>
			<?php endfor; ?>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div><!-- end : print_this -->
</div></div>

<script type="text/javascript" src="assets/js/lingkar/jquery.export2excel.js"></script>
<script type="text/javascript" src="assets/js/lingkar/jquery.table2csv.js"></script>
<script>
	$(function(){
		var style = '<style>table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>';
		
		$("a.print-excel").click(function(e){
			e.preventDefault();
			//var file="file_20140929134835.xls";
			var file="penetapan_batas_propinsi_<?="_".date("YmdHis").".xls";?>";
			var base_url="<?=base_url()?>";
			/*get html table */
			var tbl = $('<div>').append($('div#print_this').clone()).remove().html();
			
			/* add table to div to export */
			var div = $('<div>').append(tbl);
			div.find("table").attr("border","1");
			
			$(div).Export2XLS({filename:file,urlAction:base_url+"export/xls/"});
		});
		
		$("a.print-html").click(function(e){
			e.preventDefault();
			var base_url="<?=base_url()?>";
            var html=$("div#print_this").html();
			var file="penetapan_batas_propinsi_<?="_".date("YmdHis").".html";?>";
            UrlSubmit(base_url+"export/html_print/",{filename:file,tbl:encodeURIComponent(html),target:"_blank"});
			return false;
			//$(this).attr("target","_blank");
			
		});
		
		$("a.print-pdf").click(function(e){
			e.preventDefault();
			var base_url="<?=base_url()?>";
			var html=style+$("div#print_this").html();
			var file="penetapan_batas_propinsi_<?="_".date("YmdHis").".pdf";?>";
			UrlSubmit(base_url+"export/proxy_pdf/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70});
		});
	});
</script>