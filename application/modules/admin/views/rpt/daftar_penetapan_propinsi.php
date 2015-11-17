<?php
	$data_request=get_post();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="simple_box box_shadow" style="background-color:#FBFBFB;padding:10px">
            <form class="form-inline" id="frm" method="get" role="form">
              <div class="form-group">
                  <label class="sr-only" for="name">Search</label>
                  <input type="text" class="form-control" id="q" name="q"  value="<?=$data_request["q"]?>"
                     placeholder="Search...">
                </div>	
              <div class="checkbox">
                  <label>
                  <input id="ck_filter" name="ck_filter" value="1" <?=$data_request["ck_filter"]==1?"checked='checked'":'';?> type="checkbox"> Filter
                  </label>
               </div>
               
               <!-- start: div_filter -->
               <div class="form-group filter hidden">
                  <? $arrJenisPeraturan=m_lookup("jenis_peraturan","id_jenis_peraturan","jenis_peraturan"); 
				  	 $arr_first=array('" class="disabled'=>"Semua Jenis Peraturan");
					 $arrJenisPeraturan=$arr_first+$arrJenisPeraturan;
				  ?>
                <? echo form_dropdown("id_jenis_peraturan",$arrJenisPeraturan,$data_request["id_jenis_peraturan"],"id='id_jenis_peraturan' class='form-control input-xs' placeholder='Semua Jenis Peraturan' style='width:100%'");?>
               </div>
              
               <div class="form-group filter hidden">
               		<?php 
					 $arr_tahun_first=array('" class="disabled'=>"Semua Tahun");
					 $arrDataTahun=$arr_tahun_first+$arrDataTahun;
					 
					 ?> 
               	 <? echo form_dropdown("tahun_peraturan",$arrDataTahun,$data_request["tahun_peraturan"],"id='tahun_peraturan' class='form-control input-xs' placeholder='Semua Tahun' style='width:100%'");?>
               </div>
               
               <div class="form-group filter hidden">
                 <label class="sr-only" for="name">Propinsi</label>
                 <?php
						$arrPropinsi=m_lookup("propinsi","kode_bps","nama",""," order by nama");
						$arr_first_propinsi=array('" class="disabled'=>"Semua Propinsi");
					    $arrPropinsi=$arr_first_propinsi+$arrPropinsi;
				 ?>
                 <? echo form_dropdown("id_propinsi",$arrPropinsi,$data_request["id_propinsi"],"id='id_propinsi' class='select2 form-control' style='width:100%'");?>
               </div>
                <!-- end: div_filter -->
                
               <div class="btn-group pull-right">
               <!--<a href="javascript:void()" class="btn btn-default btn-sm box_shadow export-pdf"><i class="fa fa-print"></i></a>-->
               
               <div class="btn-group">
                      <a id="btn_down" class="btn btn-sm btn-default" href="#"><i class="icon-download-alt"></i> Print/Download </a>
                      <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"> </span></a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="#" class="print-pdf" data-url=""><i class="fam-page_white_acrobat"></i> PDF</a></li>
                        <li><a href="#" class="print-html" data-url=""><i class="icon icon-print"></i> Print</a></li>
                        <li><a href="#" class="print-excel" data-url=""><i class="fam-page_white_excel"></i> Excel</a></li>
                        
                      </ul>
            </div>
               
               <!--<a href="/print" class="btn btn-primary btn-sm"><i class="fa fa-close"></i></a>-->
               
               </div>
               <button class="btn btn-sm btn-default save">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="formSep"></div>

<div id="print_this">

<p class="tc">DAFTAR HASIL PENETAPAN BATAS DAERAH ANTAR PROVINSI</p>

<div class="row">
<div class="col-sm-12">
<table class="table table-condensed table-bordered">
	<thead>
    	<tr>
        		<td>No.</td>
            	<td>Propinsi</td>
                <td>No SK</td>
                <td width="135px">Tanggal</td>
                <td width="300px">UU Pembentukan Daerah</td>
                <td width="80px">Peta Digital</td>
         </tr>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):
			foreach($arrData as $x=>$val):?>
            <?
            	$head_uu=array("idx","no_peraturan","tentang");
				$head_file=array("id","file_name","file_path");
				$head_file_peta=array("id","file_name","file_path");
				
				$detail_uu=$val["detail_uu"];
				$data_uu_detail=array();
				$detail_uu_arr=preg_split("/\;/",$detail_uu);
				foreach($detail_uu_arr as $xx=>$valx):
					$data_uu_tmp=preg_split("/\|/",$valx);
					if($data_uu_tmp[0]==''):
							continue;
						endif;
					$data_uu_detail[]=array_combine($head_uu,$data_uu_tmp);
				endforeach;
				
				$detail_file=$val["detail_file"];
				$data_file_detail=array();
				$detail_file_arr=preg_split("/\;/",$detail_file);
				if(cek_array($detail_file_arr)):
					foreach($detail_file_arr as $xx=>$valx):
						$data_file_tmp=preg_split("/\|/",$valx);
						if($data_file_tmp[0]==''):
							continue;
						endif;
						$data_file_detail[]=array_combine($head_file,$data_file_tmp);
					endforeach;
				endif;
				
				$detail_peta=$val["detail_file_peta"];
				$data_peta_detail=array();
				
				$detail_peta_arr=preg_split("/\;/",$detail_peta);
				if(cek_array($detail_peta_arr)):
					foreach($detail_peta_arr as $xx=>$valx):
						$data_peta_tmp=preg_split("/\|/",$valx);
						if($data_peta_tmp[0]==''):
							continue;
						endif;
						$data_peta_detail[]=array_combine($head_file_peta,$data_peta_tmp);
					endforeach;
				endif;
			?>
            
        	<tr class="ttop">
            	<td><?=$x+1?></td>
                <td>
					<?="Prov. ".$val["propinsi_1"]." - Prov. ".$val["propinsi_2"];?>
                	<? if(cek_array($val["data_detail"])):?>
                    	<ul>
						<? foreach($val["data_detail"] as $xx=>$valx):?>
                        	<li style="list-style:none"><?=$xx+1?>. <?=ucwords(strtolower($valx["kabupaten_1"]))?> - <?=ucwords(strtolower($valx["kabupaten_2"]))?></li>
                        <? endforeach;?>
                        </ul>
					<? endif;?>
                </td>
                <td><?=$val["no_sk"]?></td>
                <td><?=date2indo($val["tanggal_terbit_sk"])?></td>
                <td>
                	<? if(cek_array($data_uu_detail)):?>
					<ol style="padding-left:15px">
					<? foreach($data_uu_detail as $xx=>$valx): ?>
                		<li style="padding:0"><?=$valx["no_peraturan"]." Tentang ".$valx["tentang"]?></li>
					<? endforeach;?>
                    </ol>
                    <? endif;?>
                </td>
                <td><?=cek_array($data_peta_detail)?"Ada":"Tidak Ada"?></td>
            </tr>	
		<?php endforeach;
			  endif;
		?>
    </tbody>
</table>
</div>
</div>

</div><!-- end:print-this-->

<script type="text/javascript" src="assets/js/lingkar/jquery.export2excel.js"></script>
<script type="text/javascript" src="assets/js/lingkar/jquery.table2csv.js"></script>
<script>
	$.fn.clearForm = function() {
	  return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if ((tag == 'form')||(tag == 'div'))
		  return $(':input',this).clearForm();
		if (type == 'text' || type == 'password' || tag == 'textarea')
		  this.value = '';
		else if (type == 'checkbox' || type == 'radio')
		  this.checked = false;
		else if (tag == 'select')
		  //this.selectedIndex = -1;
		  $(this).val("");
	  });
	};
	
	function clearFormOri(form) {
	  // iterate over all of the inputs for the form
	  // element that was passed in
	  $(':input', form).each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		// it's ok to reset the value attr of text inputs,
		// password inputs, and textareas
		if (type == 'text' || type == 'password' || tag == 'textarea')
		  this.value = "";
		// checkboxes and radios need to have their checked state cleared
		// but should *not* have their 'value' changed
		else if (type == 'checkbox' || type == 'radio')
		  this.checked = false;
		// select elements need to have their 'selectedIndex' property set to -1
		// (this works for both single and multiple select elements)
		else if (tag == 'select')
		  this.selectedIndex = -1;
	  });
	}
	
	$.fn.cleanDataSubmit= function() {
	  return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag == 'form')
		  return $(':input',this).cleanDataSubmit();
		if (type == 'text' || type == 'password' || tag == 'textarea'){
		  if(this.value == ''){
		  	//$(this).remove();
			$(this).attr("disabled","disabled");
		  }
		 }
		else if (type == 'checkbox' || type == 'radio'){
			  if(this.checked == false){
				//$(this).remove();
				$(this).attr("disabled","disabled");
			  };
		 }
		else if (tag == 'select'){
		  //this.selectedIndex = -1;
			  if($(this).find("option:selected").val()==""){
				 //$(this).remove();
				 $(this).attr("disabled","disabled");
			  }
		  }
	  });
	};
	//usage
	//$('#frm').clearForm();

	$(function(){
		cek_filter();
		
		$("#ck_filter").click(function(){
			cek_filter();
		});
		
		$(".btn.save").click(function(){
			$("#frm").cleanDataSubmit();
			$("#frm").submit();
		});
		
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
	function cek_filter(){
		var status=$("#ck_filter").attr("checked")||"";
		if(status=="checked"){
			$(".form-group.filter").removeClass("hidden").hide();
			$(".form-group.filter").show();
		}else{
			$(".form-group.filter").fadeOut(500);
			/*
			$(".form-group.filter").each(function(){
				$(this).find("select,input").val("");
			});
			*/
			$(".form-group.filter").clearForm();
			
		}
	}
	
	
</script>