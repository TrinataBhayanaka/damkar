<style>
	.select2-container-multi .select2-choices {
			background-image:none !important;;
				
		}
		
	.select2-container-multi.select2-container-active .select2-choices {
		border:none !important;
		box-shadow:none !important;
		outline: none !important;
	}
</style>

<?
$data_file_all=array();
if(cek_array($data_file)):
foreach($data_file as $x=>$val):
	$tmp=array();
	$tmp=array_map("trim",$val);
	$tmp["relative_path"]=$tmp["file_path"];
	$tmp["idx"]=$tmp["id_file"];
	$data_file_all[$val["tipe_doc"]][]=$tmp;
endforeach;
endif;

		$arrDasar=array();
		$arrDasarID=array();
		$arrDasarTentang=array();
		$dasarTxtStr="";
		$dasarIDStr="";
		$dasarTentangStr="";
		
		if(cek_array($data_detail_uu)):
			foreach($data_detail_uu as $x=> $val):
				$arrDasar[]=$val["no_peraturan"];
				$arrDasarID[]=$val["idx"];
				$arrDasarTentang[]=$val["tentang"];
			endforeach;
			$dasarTxtStr=join("|",$arrDasar);
			$dasarIDStr=join("|",$arrDasarID);
			$dasarTentangStr=join("|",$arrDasarTentang);
		endif;
		
?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Batas Wilayah</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">Edit</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<? $id=$this->encrypt_status==TRUE?encrypt($data["idx"]):$data["idx"];?>
<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?=$this->module?>listview/">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?=$this->module?>add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input  <?=$this->module_title?>
                    </a>
                </li>
                
                 <li>
                    <a href="<?=$this->module?>view/<?=$id?>">
              
                        <span class="block text-center">
                            <i class="icon-search"></i> 
                        </span>
                       	View <?=$this->module_title?>
                    </a>
                </li>
                
                 <li class="active">
                    <a href="javascript:void(0)">
              
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_title?>
                    </a>
                </li>
               
            </ul>
        </div>
    	
    </div>
</div>


<div class="row">
<div class="col-md-12 col-lg-12">
	<?php echo message_box();?>
    <form id="frm" method="post" action="<?php echo $this->module;?>edit/<?=$id?>" class="form-horizontal control-label-left" role="form">
    	<input type="hidden" name="act" id="act" value="update"/>
        <div class="row">
        <div class="col-md-8">
        <h5 class="heading">SK</h5>
        <div class="form-group">
        	<label for="category" class="control-label no-padding-right col-md-3">No SK</label>
            <div class="col-md-9">
            	<div class="row">
                <div class="col-md-5">
            	<? $arrJenisPeraturan=m_lookup("jenis_peraturan","id_jenis_peraturan","jenis_peraturan"); ?>
                <? echo form_dropdown("id_jenis_peraturan",$arrJenisPeraturan,$data["id_jenis_peraturan"],"id='id_jenis_peraturan' class='form-control input-xs' style='width:100%'");?>
                </div>
                <div class="col-md-3">
                <input type="text" id="no_peraturan" name="no_peraturan" class="form-control input-xs required" style="width:100%" placeholder="Nomor" value="<?=$data["no_peraturan"]?>" />
                </div>
                <div class="col-md-4">
                <input type="text" id="tahun_peraturan" name="tahun_peraturan" class="form-control input-xs required" placeholder="Tahun" value="<?=$data["tahun_peraturan"]?>" />	</div>
                </div>
                <div class="formSep"></div>
            </div>
        </div><!-- /control-group category-->
        
        <div class="form-group">
				<label  class="control-label no-padding-right col-md-3 " for="timepicker1">Tanggal Terbit SK</label>
				<div class="col-md-9">
                	<div class="row" style="padding-left:15px">
					<div class="input-group col-md-6">
					<span class="input-group-addon"><i class="icon-calendar"></i></span>
					  <input type="text" id="tanggal_terbit_sk_selector" class="input-sm form-control input-date required" value="<?=date("d/m/Y",strtotime($data["tanggal_terbit_sk"]))?>" placeholder="dd/mm/yyyy"/>
                      <input type="hidden" id="tanggal_terbit_sk" name="tanggal_terbit_sk" value="<?=date("Y-m-d",strtotime($data["tanggal_terbit_sk"]));?>" class="required" />
				</div>	
                </div>
                </div>
		</div>
        <br><br>
        <h5 class="heading">Batas Wilayah</h5>
        
        <div class="form-group">
				<label  class="control-label no-padding-right col-md-3 " for="timepicker1">Propinsi</label>
				 <div class="col-md-9">
				<?php
						$arrPropinsi=m_lookup("propinsi","kode_bps","nama");
						$arrPropinsi1=array(""=>"--Pilih Propinsi 1--")+$arrPropinsi;
						$arrPropinsi2=array(""=>"--Pilih Propinsi 2--")+$arrPropinsi;
				?>
                <? echo form_dropdown("id_propinsi_1",$arrPropinsi1,$data["id_propinsi_1"],"id='id_propinsi_1' class='select2' style='width:100%'");?>
               
               <? $strSelectPropinsi2=form_dropdown("id_propinsi_2[]",$arrPropinsi2,"","class=\"select2 id_propinsi_2\" style=\"width:100%\"");?>
               <div class="formSep"></div>
                </div>
		</div>
        
         <div class="form-group">
        	<label for="description" class="control-label no-padding-right col-md-3 ">Kabupaten</label>
            <div class="col-md-9">
            	<div id="div_kabupaten">
  						<!--<span class="red">* Pilih Propinsi terlebih dahulu..</span>-->
                        <? echo form_dropdown("id_kabupaten_1",$arr_kab1,$data["id_kabupaten_1"],"id='id_kabupaten_1' class='select2 id_kabupaten_1 id_kabupaten' placeholder='--Pilih Kabupaten--' style='width:100%'");?>              	
                </div>
                <div class="formSep"></div>
            </div>
        </div>
        
        <div class="form-group">
                            <label for="category" class="control-label no-padding-right col-md-3 ">Berbatasan dengan</label>
                            <div class="col-md-9">
                            	<a href="#" id="add_batas" class="btn btn-xs btn-primary" style="display:none;margin-top:2px"><i class="icon-table"></i> Tambah Kabupaten</a>
                                <table class="batas_wilayah table table-bordered table-condensed" style="width:100%;padding:0;margin-top:10px">
                                        <thead>
                                        <tr>
                                            <th style="width:10px"></th><th width="200px">Propinsi</th><th>Kabupaten</th><th style="width:20px"></th></tr>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <? if(cek_array($data_detail_concat)):
											?>
                                        	<? foreach($data_detail_concat as $x=>$dt):
												?>
                                            	<tr><td class='no'></td><td class='propinsi_2'><? echo form_dropdown("id_propinsi_2[]",$arrPropinsi1,$dt["id_propinsi_2"],"class='select2 id_propinsi_2 id_propinsi' style='width:100%'");?></td><td class='kabupaten_2'>
                                                <? echo form_dropdown("id_kabupaten_2[".$dt["id_propinsi_2"]."][]",$dataKab[$dt["id_propinsi_2"]],$dt["id_kabupaten_2"],"multiple placeholder='--Pilih Kabupaten--' class='select2 id_kabupaten_2 id_kabupaten' style='width:100%'");?>
                                                </td><td><a href='/remove_batas' class='remove_batas'><i class='icon-remove red'></i></a></td></tr>
                                            <? endforeach;?>
                                        <? endif;?>
                                        
                                        </tbody>
                                        <tfoot>
                                            <tr><td></td><td colspan="3"></td></tr>
                                        </tfoot>
                                    </table>
                                    <div class="formSep"></div>
                            </div>
                            
                        </div><!-- /control-group category-->
        
        
        <!-- <div class="form-group">
        	<label for="description" class="control-label no-padding-right col-md-4 ">Description</label>
            <div class="col-md-8">
            	<textarea class="input-xlarge form-control" id="description" name="description"></textarea>
            </div>
        </div>-->
        
        <div class="form-group">
        	<input type="hidden" name="dasar_txt" value="<?=$dasarTxtStr?>" id="dasar_txt"/>
        	<input type="hidden" name="dasar_tentang" value="<?=$dasarTentangStr?>" id="dasar_tentang"/>
        	<input type="hidden" name="dasar_id" value="<?=$dasarIDStr?>" id="dasar_id"/>
        	<label for="description" class="control-label no-padding-right col-md-3 ">UU Pembentukan Daerah</label>
            <div class="col-md-9">
            	<a href="<?=base_url()?><?=$this->module?>list_uu" class="a_uu"><i class="icon-search"></i> Pilih </a>
        		<ol id="ul_uu">
                	<? if(cek_array($data_detail_uu)):?>
                    <? foreach($data_detail_uu as $x=>$data):?>
                    <li data-no="<?=$data["no_peraturan"]?>" data-id="<?=$data["idx"]?>" data-txt="<?=$data["tentang"]?>"><?=$data["no_peraturan"]." Tentang ".$data["tentang"];?><a href="javascript:void()" class='a_remove_dasar c-alert' style='display:none'><i class='icon-minus-sign'></i></a></li>
                	<? endforeach;?>
                    <? endif;?>
                </ol>
            </div>
        </div>
        
        
        
        
        </div>
        
        
        <div class="col-md-4">
          <div class="box box-success" >
            <div class="box-body">    
        <h5 class="heading">Upload Peta</h5>
         <div class="form-group">
        	
            <div class="col-md-12">
                <a id="browse" class="btn btn-xs btn-primary" href="javascript:;">Pilih File</a> 
    			<a id="start-upload" class="btn btn-xs btn-primary" href="javascript:;">[Start Upload]</a>
                <br>
                <ul id="filelist"></ul>
                <div class="table-responsive" style="overflow-y:hidden;overflow-x:auto">
                <table id="table_file_peta" class="table table-condensed file_list table-bordered">
                	<thead>
                		<tr><td width="10px">#</td><td>File</td><td width="10px">#</td></tr>
                	</thead>
                    <tbody>
                    <? if(cek_array($data_file_peta)):?>
                    		<? foreach($data_file_peta as $xfilep=>$filep):?>
                            	<tr class='file_row' id="file_peta_<?=$filep["id_file"]?>" data-file_id="<?=$filep["id_file"]?>">
	<td><input type="hidden" name="peta_file_id[]" value="<?=$filep["id_file"]?>"/><a href="./<?=$filep["file_path"]?>" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<label style='height:auto;'><?=$filep["file_name"]?></label></td><td><a href="" class='peta_file_remove red'><i class="icon-remove"></i> </a></td></tr>
							<? endforeach;?>
						<? endif;?>
                    </tbody>
	                </table>
                </div> <!-- end responsive -->
            </div>
        </div>
        </div></div><!-- end box -->
        
          <div class="box box-success" >
            <div class="box-body">    
        <h5 class="heading">Upload File</h5>
       <div class="form-group">
        	
            <div class="col-md-12">
                <a id="browse2" class="btn btn-xs btn-primary" href="javascript:;">Pilih File</a> 
    			<a id="start-upload2" class="btn btn-xs btn-primary" href="javascript:;">[Start Upload]</a>
                <br>
                <ul id="filelist2"></ul>
                <div class="table-responsive" style="overflow-y:hidden;overflow-x:auto">
               <table id="table_file_upload" class="table table-condensed file_list table-bordered">
                	<thead>
                		<tr><td width="10px">#</td><td>File</td><td width="10px">#</td></tr>
                	</thead>
                    <tbody>
                    <? if(cek_array($data_file)):?>
                    		<? foreach($data_file as $xfile=>$file):?>
                            	<tr class='file_row' id="file_upload_<?=$file["id_file"]?>" data-file_id="<?=$file["id_file"]?>">
	<td><input type="hidden" name="upload_file_id[]" value="<?=$file["id_file"]?>"/><a href="./<?=$file["file_path"]?>" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<label style='height:auto;'><?=$file["file_name"]?></label></td><td><a href="" class='upload_file_remove red'><i class="icon-remove"></i> </a></td></tr>
							<? endforeach;?>
						<? endif;?>
                    
                    </tbody>
	           </table>
                </div> <!-- end responsive -->
            </div>
        </div>
        </div></div> <!-- end box -->
        
        
        </div>
        </div>
        <div class="formSep"></div>
        <div class="row">
        <div class="col-md-12">
        <div class="form-actions col-md-12">
        	<button class="btn btn-primary save" type="submit"><i class="icon-book icon-white"></i> Save </button>
        	<button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
        </div>
        </div>
        </div>
        
        
        
    </form>	
            
</div></div>



<form id="hidden_form" method="post" enctype="multipart/form-data" action="upload/all/">
	<!--<h4>Test UPLOAD</h4>-->
	<div id="div_file_submit">
    </div>
</form>

<?=loadFunction("colorbox");?>
<?php echo js_asset("plugin/form/jquery.form.js");?>
<? loadFunction("json");?>
<?php echo js_asset("jquery.tmpl.min.js");?>
<?php echo js_asset("jquery.tmplPlus.min.js");?>
<?=js_asset("plugin/amplify/amplify.min.js");?>
	<?=js_asset("plugin/amplify/amplify.contrib.js");?>
    <?=js_asset("plugin/amplify/amplify_store_ext.js");?>

<script id="tmp_file" type="text/x-jquery-tmpl">
	<tr id="file_${idx}" data-file_id="${idx}" class='file_row'>
	<td><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a><input type="hidden" name="file_id[]" value="${idx}"/></a><input type="hidden" name="tipe_doc[]" value="${tipe_doc}"/></td><td><input name='dasar_surat[]' value="${file_name}" type="hidden" style='width:300px' class="required form-control input-sm"/><label style='height:auto;'>${file_name}</td><td><a href="" class='file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>
    
    
<script id="tmp_file_peta" type="text/x-jquery-tmpl">
	<tr class='file_row' id="file_peta_${idx}" data-file_id="${idx}">
	<td><input type="hidden" name="peta_file_id[]" value="${idx}"/><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<label style='height:auto;'>${file_name}</label></td><td><a href="" class='peta_file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>

<script id="tmp_file_upload" type="text/x-jquery-tmpl">
	<tr class='file_row' id="file_upload_${idx}" data-file_id="${idx}">
	<td><input type="hidden" name="upload_file_id[]" value="${idx}"/><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<label style='height:auto;'>${file_name}</label></td><td><a href="" class='upload_file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>
        

<?=loadFunction("select2");?>

<script>
	$(function(){
		$(".a_uu").click(function(e){
			e.preventDefault();
			var mytxt=$("#dasar_txt").val();
			var myid=$("#dasar_id").val();
			var url=$(this).attr("href");
			if(mytxt!=""){
				url+="?id="+encodeURIComponent(myid)+"&txt="+encodeURIComponent(mytxt);
			}
			
			$.colorbox({
				href:url,
				iframe:false,
				width:'85%',
				height:'85%'			
			});
			
		});
		
		$(document).bind('cbox_complete', function(){
  				var idStr=$("#dasar_id").val();
				if(idStr!=""){
					var idSplit=idStr.split("|");
					for(i=0;i<idSplit.length;i++){
						$(".cbsel[data-id='"+idSplit[i]+"']").attr("checked","checked");
					}
				}
				$("#search_tbl").quicksearch("#tbl_uu tbody tr");
		});
		
		
		
		$(document).on("click","#checkall",function(){
			$(".cbsel").attr("checked",$(this).attr('checked')?$(this).attr('checked'):false);
		});
		
		$(document).on("click",".cbsel",function(){
			var count_check=$("[name='chk[]']:checked").length;
			var count_all=$(".cbsel").length;
			if(count_check==count_all){
				$("#checkall").attr("checked","checked");
			}else{
				$("#checkall").removeAttr("checked");
			}
		});
		
		$(document).on("click",".a_pilih_uu",function(e){
			e.preventDefault();
			var myvalArr=new Array();
			var mytentangArr=[];
			var myidArr=new Array();
			
			$("#ul_uu").html("");
			
			$(".cbsel:checked").each(function(){
				myvalArr.push($(this).data("no"));
				mytentangArr.push($(this).data("txt"));	
				myidArr.push($(this).val());	
				$("#ul_uu").append("<li data-no='"+$(this).data("no")+"' data-id='"+$(this).data("id")+"' data-txt='"+$(this).data("txt")+"'>"+$(this).data("no")+" Tentang "+ $(this).data("txt") +" <a href='/hapus dasar hukum' class='a_remove_dasar c-alert' style='display:none'><i class='icon-minus-sign'></i></a></li>");
			});
			
			$("#dasar_txt").val(myvalArr.join("|"));
			$("#dasar_id").val(myidArr.join("|"));
			$("#dasar_tentang").val(mytentangArr.join("|"));
			
			$.colorbox.close();
			
		});
		
		
		
	});
	
	

</script> 


<script>
		$(function(){
			$("#id_propinsi_1").select2({'placeholder':"--Pilih Propinsi --"});
			$(".id_propinsi_2").select2({'placeholder':"--Pilih Propinsi --"});
			$(".id_kabupaten_2").select2({'placeholder':"--Pilih Kabupaten--"});
			
			//$("#id_propinsi_2").select2({'placeholder':"--Pilih Propinsi 2--"});
			$("#id_kabupaten_1").select2({'placeholder':"--Pilih Kabupaten --"});
			
			
			
			$("#tahun_peraturan").on("blur",function(){
				var tanggal=$("#tanggal_terbit_sk").val();
				var splitText=tanggal.split("-");
				var tahun_old=splitText[0];
				var bulan=splitText[1];
				var tanggal=splitText[2];
				
				tahun=$(this).val()||tahun_old;
				//update_date();
				$("#tanggal_terbit_sk").val(tahun+"-"+bulan+"-"+tanggal);
				$("#tanggal_terbit_sk_selector").val(tanggal+"/"+bulan+"/"+tahun);
				$("#tanggal_terbit_sk_selector").datepicker("update");
				
			});
			
			setInterval(function(){
				console.log("test");
				var id_propinsi_1=$("#id_propinsi_1").find("option:selected").val();
				var propinsi_1=$("#id_propinsi_1").find("option:selected").text();
				
				var id_kabupaten_1=$(".id_kabupaten_1").find("option:selected").val()||"";
				var kabupaten_1=$(".id_kabupaten_1").find("option:selected").text();
				$("#add_batas").hide();
				if((id_propinsi_1!="")&&(id_kabupaten_1!="")){
					$("#add_batas").show();
				}
			},500)
			
			$("#add_batas").click(function(e){
				e.preventDefault();
				var id_propinsi_1=$("#id_propinsi_1").find("option:selected").val();
				var propinsi_1=$("#id_propinsi_1").find("option:selected").text();
				
				
				var dd_propinsi="<?php echo preg_replace("/(\r\n)|(\n)/","",str_replace("\"","'",$strSelectPropinsi2))?>";
				
				$("table.batas_wilayah tbody").append('<tr><td class="no"></td><td class="propinsi_2">'+dd_propinsi+'</td><td class="kabupaten_2"></td><td><a href="/remove_batas" class="remove_batas"><i class="icon-remove red"></i></a></td></tr>')
				$("table.batas_wilayah tbody tr:last").find(".id_propinsi_2").select2({placeholder:"--Pilih Propinsi--"});
				$("table.batas_wilayah tbody tr:last .id_propinsi_2").select2({"placeholder":"--Pilih Propinsi--"});
				
				/*
				var id_propinsi_2=$("table.batas_wilayah tbody tr:last").find(".id_propinsi_2").find("option:selected").val();
				var propinsi_2=$("table.batas_wilayah tbody tr:last").find(".id_propinsi_2").find("option:selected").text();
				*/
				/*
				$("table.batas_wilayah tbody tr:last").find(".kabupaten_2").load("<?=$this->module?>get_kab_kota2/"+id_propinsi_2+"/2"+"/?time="+new Date().getTime(),function(){
					$("table.batas_wilayah tbody tr:last").find(".id_kabupaten_2").select2({placeholder:"--Pilih Kabupaten--"});
				});
				*/
				
				/*
				$("table.batas_wilayah tbody tr:last").find(".propinsi_2").load("<?=$this->module?>get_kab_kota/"+id_propinsi_2+"/2"+"/?time="+new Date().getTime(),function(){
					$("table.batas_wilayah tbody tr:last").find(".id_kabupaten_2").select2({placeholder:"--Pilih Kabupaten--"});
				});
				*/
				
				$("table.batas_wilayah .no").each(function(i){
					$(this).text(i+1);
				});
			});
			
			
			$("table.batas_wilayah").on("click",".remove_batas",function(e){
					e.preventDefault();
					$(this).closest("tr").hide().remove();
					$(".no").each(function(i){
						$(this).text(i+1);
					});
					
					if($(".remove_batas").length>1){
						$(".remove_batas").show();
					}else{
						$(".remove_batas").hide();
					}
					return false;
				});
			
			$(document).on("change","#id_propinsi_1",function(){
				var id_propinsi=$(this).find("option:selected").val();
				var selected=$(this).find("option:selected").text();
				$("#add_batas").hide();
				$("#div_kabupaten").load("<?=$this->module?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
					$(".id_kabupaten_1").select2({placeholder:"--Pilih Kabupaten--"});
				});

			});
			
			
			$(document).on("change","#id_propinsi_2",function(){
				var id_propinsi=$(this).find("option:selected").val();
				var selected=$(this).find("option:selected").text();
				//$("#propinsi").val(selected);
				//$("#kab_kota").val("");
				/*
				$("#id_kab_kota1").load("<?=$this->module?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
					$("#kd_bps_kab_kota").select2({placeholder:"--Pilih Kabupaten--"});
				});
				*/
				//$("table.batas_wilayah thead").find(".propinsi_2").text(selected);
				$("table.batas_wilayah tbody").find(".propinsi_2").load("<?=$this->module?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
					$(".id_kabupaten").select2({placeholder:"--Pilih Kabupaten--"});
				});
			});
			
			
			
			$(document).on("change",".id_propinsi_2",function(){
				var id_propinsi=$(this).find("option:selected").val();
				var selected=$(this).find("option:selected").text();
				var tr=$(this).closest("tr");
				tr.find(".kabupaten_2").load("<?=$this->module?>get_kab_kota2/"+id_propinsi+"/2/?time="+new Date().getTime(),function(){
					tr.find(".kabupaten_2 .id_kabupaten_2").select2({placeholder:"--Pilih Kabupaten--"});
				});
			});
			
			
			$(document).on("change","#kd_bps_kab_kota",function(){
				var selected=$(this).find("option:selected").text();
				$("#kab_kota").val(selected);
			});
			
			$("#frm").validate({ignore:''});
			//$("#frm").validate();
			
			
			$("#frm .btn.save").click(function(e){
				e.preventDefault();
				$("#frm").submit();
			});
			
		});
		
</script>

<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script>
	//test plupload
	$(function(){
	var uploader = new plupload.Uploader({
		  browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		 
		uploader.init();
		
		uploader.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#"+file.id).hide().remove();
				var data=response.data_file;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_file_peta";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				$('#table_file_peta tbody').append($("#"+tmpFile).tmpl(data));
				//console.log(data);
			}
		}); 
		 
		uploader.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  document.getElementById('filelist').innerHTML += html;
		});
		 
		uploader.bind('UploadProgress', function(up, file) {
		  document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		});
		 
		uploader.bind('Error', function(up, err) {
		  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		});
		 
		document.getElementById('start-upload').onclick = function() {
		  uploader.start();
		};
		
		$("#filelist").on("click",".a_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var li=that.closest("li");
			var file_id=li.attr("id");
			uploader.removeFile(uploader.getFile(file_id));
			li.remove();
		});
	})
	
	$(function(){
		$(document).on("click","a.peta_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var id=that.closest("tr").data("file_id");
			$.post("<?=base_url()?><?=$this->module?>delete_peta_file/"+id,function(ret){
				if(ret=="ok"){
					that.closest("tr").slideUp().remove();
				}
			}); //end ajax
			
		});
	
	})
	
</script>


<script>
	//test plupload
	$(function(){
	var uploader2 = new plupload.Uploader({
		  browse_button: 'browse2', // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		
		uploader2.init();
		
		uploader2.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#f_"+file.id).hide().remove();
				var data=response.data_file;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_file_upload";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				$('#table_file_upload tbody').append($("#"+tmpFile).tmpl(data));
				//console.log(data);
			}
		}); 
		 
		uploader2.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="f_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  document.getElementById('filelist2').innerHTML += html;
		});
		 
		uploader2.bind('UploadProgress', function(up, file) {
		  document.getElementById("f_"+file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		  //$("#filelist2").find("#"+file.id).find("b").html("<span>" + file.percent + "%</span>");
		});
		 
		uploader2.bind('Error', function(up, err) {
		  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		});
		 
		document.getElementById('start-upload2').onclick = function() {
		  uploader2.start();
		};
		
		$("#filelist2").on("click",".a_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var li=that.closest("li");
			var file_id=li.attr("id").replace("f_","");
			uploader2.removeFile(uploader2.getFile(file_id));
			li.remove();
		});
	})
	
	
	$(function(){
		$(document).on("click","a.upload_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var id=that.closest("tr").data("file_id");
			$.post("<?=base_url()?><?=$this->module?>delete_upload_file/"+id,function(ret){
				if(ret=="ok"){
					that.closest("tr").slideUp().remove();
				}
			}); //end ajax
			
		});
	});
	
</script>

<script>
	$(function(){
		var act_link="<?=$this->module?>gb";	
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>

<? //$this->load->view("active_menu");?>