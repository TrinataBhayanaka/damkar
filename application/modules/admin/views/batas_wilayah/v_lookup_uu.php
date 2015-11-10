<? $this->load->view("admin_lte_layout/lookup_header");
?>
<style>
	body{
		background-color:#FAFAFA !important; 
	}
	#content{
		border:none;
	}
</style>
<? $header_col=array("No","Tentang","Tahun");
   $val_col=array("no_peraturan","tentang","tahun_peraturan");
?>

<div class="row" style="padding-top:30px">
	<!-- start: right side -->
    <div class="col-md-12">
    <?=portlet_simple_start();?>

  			<div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <form class="search_form form-inline"  action="<?=$this->module?><?=$this->search_link?$this->search_link:$this->router->method?>" method="get">
                        <?php $this->load->view("widget/search_box_db"); ?>
                     </form>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                	 <div class="formSep"></div>
                </div>
            </div>
            <!-- /END SEARCH BOX-->
    
    <div class="row">
    	<div class="col-md-12">        
            
            <h4 class="heading">Personel</h4>
<table class="table table-hover small-font">
	<thead>
    	<tr>
        <th width="14"><input name="checkall" id="checkall" class="sOption" type="checkbox" /></th>
        <th width="20px">#</th>
         <!--<th width="20px">#</th>-->
    	<? foreach($header_col as $head):?>
        	<th><?php echo $head ?></th>
		<? endforeach;?>
        </tr>
    </thead>
    <tbody>
    	
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):?>
            	<? 
					//$id=$this->encrypt_status==TRUE?encrypt($val["id"]):$val["id"];
					/* explode data to tr */
					$data_tmp=array();
					foreach($val as $xx=>$valxx):
						$data_tmp[]="data-".$xx."='".$valxx."'";
					endforeach;
					$data_str=join(" ",$data_tmp);
				?>	
            	<tr <?=$data_str?>>
                	<td style="width:10px"><input name="chk[]" id="cbsel_<?=$val["idx"]?>" data-id="<?=$val["idx"]?>" data-txt="<?=$val["tentang"]?>" data-no="<?=$val["no_peraturan"]?>" class="cbsel sOption" type="checkbox" value="<?php echo $val["idx"]?>" /></td>
                	<td><a href="/pilih" class="btn btn-sm btn-primary a_pilih" data-val="<?=$val["idx"]?>" data-id="<?=$val["idx"]?>">Pilih</a></td>
					<? foreach($val_col as $colname):?>
                    	<td><?php echo $val[$colname];?></td>
                    <? endforeach;?>
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
	</div></div>

<? $this->load->view("paging_std");?>
<?=portlet_simple_end();?>
</div></div>

<nav class="navbar navbar-default navbar-fixed-top box_shadow" style="background-image:none;background-color:#FBFBFB;min-height:35px" role="navigation">
  <div class="container" style="height:30px;padding-top:5px">
    <div class="pull-left">
    	<h5><b>Lookup UU Pembentukan Daerah<small></small><b></h5>
    </div>
    <div class="btn-group pull-right">
    	<a href="/tutup" class="btn btn-sm btn-warning a_close"><i class="icon-remove"></i> Close</a>
    </div>
  </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom box_shadow" style="background-image:none;background-color:#FBFBFB;min-height:40px" role="navigation">
  <div class="container" style="padding-top:5px">
    <div class="btn-group pull-right">
    	<a href="/tutup" class="btn btn-sm btn-warning a_close"><i class="icon-remove"></i> Close</a>
    </div>
  </div>
</nav>

<script>
	$(function(){
		$("table").on("click","#checkall",function(){
			$(".cbsel").prop("checked",$("#checkall").prop('checked')?$("#checkall").prop('checked'):false);
		});
		
		$(".cbsel").click(function(){
			console.log($(this))
			var status=$(this).prop("checked");
			//var st=store.get("dasar_id")||[];
			
			if(status){
				//alert($(this).data());
			
				console.log($(this).data());
				//st.append($(this).closest("tr").data())
				//store.set("dasar_id",st);
			}else{
				//store.clear($(this).closest("tr").data());
			}
			
			var count_check=$("[name='chk[]']:checked").length;
			var count_all=$(".cbsel").length;
			if(count_check==count_all){
				$("#checkall").prop("checked",status);
			}else{
				$("#checkall").prop("checked",false);
			}
		});
	});
</script>

<script>
	var isInIFrame = (window.location != window.parent.location);
	var data_all={};
	var data_all_id=[];
	var data=[];
	var posisi_active="";
	$(function(){
		/*
		if(isInIFrame){
			$("#form-result").val(parent.$("#form-result").val());
			posisi_active=parent.$("#posisi_active").val();
			$("#posisi_active").val(posisi_active);
			//data_all_id=JSON.parse(parent.$("#id_pegawai_pilih").val());
			//$("#id_pegawai_pilih").val(data_all_id[posisi_active]);
			//$("#txt_pilih").val(JSON.stringify(data_all[posisi_active]));
		}
		*/
		
		$(".a_pilih").click(function(e){
			e.preventDefault();
			//alert($(this).data("val"));
			if(isInIFrame){
				//parent.get_kepala_upt($(this).data("val"));
				parent.render_data($(this).closest("tr").data());
				parent.$.colorbox.close();
			}
		});
		
		/*
		$(".ck_pilih").change(function(){
			var id_pegawai=[];
			//var txt_pilih=data_all[posisi_active]||[];
			var txt_pilih=[];
			$(".ck_pilih:checked").each(function(){
				txt_pilih.push($(this).closest("tr").data());
				id_pegawai.push($(this).val());
			});
			$("#txt_pilih").val(JSON.stringify(txt_pilih));
			$("#id_pegawai_pilih").val(id_pegawai.join("|"));
		});
		*/
	
		$(".a_close").click(function(e){
			e.preventDefault();
			parent.$.colorbox.close();
		});
	
		$(".a_pilih_all").click(function(e){
			e.preventDefault();
			if(isInIFrame){
				//parent.get_kepala_upt($(this).data("val"));
				parent.render_data_personel_all(JSON.parse($("#txt_pilih").val()));
				parent.$.colorbox.close();
			}
		});
	});

</script>
<? //using store or using amplify js ?>
<?php //echo js_asset("plugin/store/store.min.js");?>
<?php //echo js_asset("plugin/json2/json2.js");?>



<? $this->load->view("admin_lte_layout/lookup_footer");?>