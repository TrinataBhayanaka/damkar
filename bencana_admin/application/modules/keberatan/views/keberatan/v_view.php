<style>
	.simplecolorpicker{
		border:thin solid #DADADA !important;
	}
	.frm h3{
		color:#aaa;
		background:#eee;
		padding:5px;
		border-radius:3px
	}
</style>

<?php
	$arrLookupGroup=m_lookup("event_categories","id_name","name",""," order by order_num asc "); 
?>

<div class="row">
    <div class="col-sm-12 col-lg-12">
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
            <li><a href="<?=$this->module?>">Wilayah Adat</a> <span class="divider"></span></li>
			<li class="active">Pengajuan Keberatan</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<? $id=$this->encrypt_status==TRUE?encrypt($data["idx"]):$data["idx"];
?>
<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<ul class="tab-bar grey-tab">
                <li>
                    <a href="<?=$this->module?>listview/">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <!--<li>
                    <a href="<?//=$this->module?>add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?//=$this->module_title?>
                    </a>
                </li>-->
                
                 <li class="active">
                    <a href="javascript:void(0)">
              
                        <span class="block text-center">
                            <i class="icon-search"></i> 
                        </span>
                        View
                    </a>
                </li>
                
                 <li>
                    <a href="<?=$this->module?>edit/<?=$id?>">
                  		<span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit
                    </a>
                </li>
               
                <!--<li class="pull-right">
                    <a class='red' onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$this->module?>del/<?=$id?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete
                    </a>
                </li>-->
                
            </ul>
       
    	
    </div>
</div>

<div class="row">
	<div class="col-md-12">
	<?php echo message_box();?>
    <ul id="myTab" class="nav nav-tabs">
	<li class="active">
      <a href="#view3" data-toggle="tab">
        <i class="fa fa-fw fa-list-alt"></i> List Pengajuan Keberatan
      </a>
	</li>                
	<li>
      <a href="#view1" data-toggle="tab">
        <i class="fa fa-fw fa-file"></i> Pengajuan Keberatan
      </a>
	</li>
	<li><a href="#view2" data-toggle="tab"><i class="icon-search"></i> Data</a></li>   
	
	</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade" id="view1">
		<div class="row">
			<form id="frm" action="<?php echo $this->module;?>add/<?=$id;?>" method="post" enctype="multipart/form-data" >
			<input type="hidden" name="act" id="act" value="create"/>
			<input type="hidden" name="id_wa" id="act" value="<?=$data['id_wa'];?>"/>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<label>Nama Pelapor<span class="asterix">&nbsp;*</span></label>
						<input name="nama_pelapor" id="nama_pelapor" class="form-control required" type="text">
					</div>
					<div class="col-md-6">
						<label>Komunitas<span class="asterix">&nbsp;*</span></label>
						<input name="komunitas" id="komunitas" class="form-control required" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>No Kartu Identitas Diri<span class="asterix">&nbsp;*</span></label>
						<input name="no_kartu" id="no_kartu" class="form-control required" type="text">
					</div>
					<div class="col-md-6">
						<label>Jabatan<span class="asterix">&nbsp;*</span></label>
						<input name="jabatan" id="jabatan" class="form-control required" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Materi Gugatan<span class="asterix">&nbsp;*</span></label>
						<textarea name="materi_gugatan" id="materi_gugatan" class="form-control required" rows="3" ></textarea>
					</div>
					<div class="col-md-6">
						<label>Alamat<span class="asterix">&nbsp;*</span></label>
						 <textarea name="alamat" id="alamat" class="form-control required" rows="3" ></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Bukti Gugatan<span class="asterix">&nbsp;*</span></label>
						 <textarea name="bukti_gugatan" id="bukti_gugatan" class="form-control required" rows="3" ></textarea>
					</div>
					<div class="col-md-6">
						<label>Tanggal Pengajuan<span class="asterix">&nbsp;*</span></label>
						<input name="tanggal_pengajuan" id="tanggal_pengajuan" class="form-control input-date required" placeholder="yyyy-mm-dd" type="text">
						<label style="padding-top:7px;">Dokumen Pengajuan Keberatan <span class="help-block" style="display:inline">(Max filesize: 500kb)</span></label>
						<input name="dok_name" required type="file">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				</div>
			</div>
		  </form>
		</div>
   </div><!-- tab1-->
   <div class="tab-pane fade" id="view2">
      <div class="row">
            <div class="col-md-12">
            <?=$data_view2;?>
            </div>
        </div>
   </div><!-- tab2-->
   <div class="tab-pane fade in active" id="view3">
      <div class="row">
            <div class="col-md-12">
				<table class="table table-hover small-font">
					<thead>
						<tr>
						<th width="40"></th>
						<th style="width:10px">No</th>
						<th style="width:100px">Tanggal Pengajuan</th>
						<th width="150">No Kartu Identitas Diri</th>
						<th width="150">Nama Pelapor</th>
						<th style="width:250px">Dokumen </th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(cek_array($arrDataDok)):
						?>
							<?php foreach($arrDataDok as $xs=>$vals):
							$id_dok=$this->encrypt_status==TRUE?encrypt($vals["idx"]):$vals["idx"];
							?>	
								<tr >
									<td>
										<a href="#" data-toggle="modal" data-target="#myModal<?=$id_dok?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
										<a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$this->module?>del_dok/<?=$id_dok?>/<?=$id?>"><i class="icon-remove icon-alert"></i></a>
									</td>
									<td><?=$this->pagination->cur_page+$xs+1; ?></td>
									<td valign="top"><?php $time = strtotime($vals["tanggal_pengajuan"]); echo date("Y-m-d", $time)?></td>
									
									<td valign="top"><?=$vals['no_kartu'];?></td>
									<td valign="top"><?=$vals['nama_pelapor'];?></td>
									<td valign="top"><a target="_blank" href="docs/wa_doc/keberatan/<?php echo $vals["dok_name"]?>"><i class="icon-download icon-white"></i> Download</a></td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
            </div>
        </div>
		
		<?php $page_link=$this->pagination->create_links(); ?>
		<div class="rows well well-sm">
		<div class="col-md-4 col-lg-4">
			<div style="vertical-align:middle;line-height:25px">
			<?php 
				$to_page=$this->pagination->cur_page * $this->pagination->per_page;
				$from_page=($to_page-$this->pagination->per_page+1);
				if($from_page>$to_page):
					$from_page=1;
					$to_page=$from_page;
				endif;
				$total_rows=$this->pagination->total_rows;
				if($to_page>1):
					echo "Displaying : ".$from_page." - ".$to_page." of ". 
							$this->pagination->total_rows." entries";
				endif;
				if($to_page<=1):
					echo "Displaying : 1 of ". 
							$this->pagination->total_rows." entries";		
				endif;		
			?>
			 </div>
		</div><!-- end span 6-->
		<div class="col-md-8 col-lg-8">

		<span class="pull-right">
		<?php
		$arrPerPageSelect=array(
				3=>3,
				10=>10,
				25=>25,
				50=>50,
				-1=>"All"
			);
			$pp=$perPage;
		?>
		Rows/page:<?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select' class='input-mini'")?>	
		<input type="hidden" id="pp" name="pp" value="" />
		</span>

		<span class="pull-right">
			<div style="margin-top:-23px; margin-right:10px">
			<?php echo $page_link; ?>
			</div>
		</span>

		</div><!-- end span 6-->
		<div class="clearfix" style="height:24px"></div>

		</div><!-- end class well -->
   </div><!-- tab3-->
</div>
    </div>
</div>
<?php if(cek_array($arrDataDok)):?>
	<?php foreach($arrDataDok as $xs=>$vals):
	$id_dok=$this->encrypt_status==TRUE?encrypt($vals["idx"]):$vals["idx"];
	?>	
<!-- Modal -->
<div class="modal fade"  id="myModal<?=$id_dok?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:900px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Data Pengajuan Keberatan</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<form id="frm" action="<?php echo $this->module;?>edit_dok/<?=$id;?>/<?=$id_dok;?>" method="post" enctype="multipart/form-data" >
			<input type="hidden" name="act" id="act" value="update"/>
			<input type="hidden" name="id_wa" id="act" value="<?=$data['id_wa'];?>"/>
			<input type="hidden" name="dok_name_url" id="act" value="<?=$vals['dok_name'];?>"/>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<label>Nama Pelapor<span class="asterix">&nbsp;*</span></label>
						<input name="nama_pelapor" id="nama_pelapor" value="<?=$vals['nama_pelapor'];?>" class="form-control required" type="text">
					</div>
					<div class="col-md-6">
						<label>Komunitas<span class="asterix">&nbsp;*</span></label>
						<input name="komunitas" id="komunitas" value="<?=$vals['komunitas'];?>" class="form-control required" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>No Kartu Identitas Diri<span class="asterix">&nbsp;*</span></label>
						<input name="no_kartu" id="no_kartu" value="<?=$vals['no_kartu'];?>" class="form-control required" type="text">
					</div>
					<div class="col-md-6">
						<label>Jabatan<span class="asterix">&nbsp;*</span></label>
						<input name="jabatan" id="jabatan" value="<?=$vals['jabatan'];?>" class="form-control required" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Materi Gugatan<span class="asterix">&nbsp;*</span></label>
						<textarea name="materi_gugatan" id="materi_gugatan" class="form-control required" rows="3" ><?=$vals['materi_gugatan'];?></textarea>
					</div>
					<div class="col-md-6">
						<label>Alamat<span class="asterix">&nbsp;*</span></label>
						 <textarea name="alamat" id="alamat" class="form-control required" rows="3" ><?=$vals['alamat'];?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Bukti Gugatan<span class="asterix">&nbsp;*</span></label>
						 <textarea name="bukti_gugatan" id="bukti_gugatan" class="form-control required" rows="3" ><?=$vals['bukti_gugatan'];?></textarea>
					</div>
					<div class="col-md-6">
						<label>Tanggal Pengajuan<span class="asterix">&nbsp;*</span></label>
						<input name="tanggal_pengajuan" id="tanggal_pengajuan<?=$id_dok;?>" class="form-control input-date required" value="<?php $times = strtotime($vals["tanggal_pengajuan"]); echo date("Y-m-d", $times)?>" placeholder="yyyy-mm-dd" type="text">
						<label>Dokumen Pengajuan Keberatan <span class="help-block" style="display:inline">(Max filesize: 500kb)</span></label>
						<input name="dok_name" type="file">
					</div>
				</div>
			</div>
		  
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form> 
    </div>
  </div>
</div>
	<?php endforeach;?>
<?php endif;?>
<script>
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
		$(".pagination .active a").click(function(e){
			e.preventDefault();
		});
		
		$("#pp_select").change(function(){
			var pp=parseInt($(this).find("option:selected").val());
			if(pp<0){
				location=document.URL.split("?")[0];
				return false;
			}
			get_query();
		});
		
		$("#frm-search").submit(function(e){
			e.preventDefault();
			get_query();
		});
	});
	
	
	function get_query(){
			var q =$("#q").val()||"";
			var perPage=$("#pp_select option:selected").val();
			$("#pp").val(perPage);
			var pp =$("#pp").val()||"";
			
			
			var data=[];
			if(q){
				data.push("q="+q);
			}
			
			if((pp)&&(pp!=25)){
				data.push("pp="+pp);
			}
			var param='';
			if(data){
				param="?"+data.join("&");
			}
			var url=document.URL.split("?")[0];
			location=url+param;
	}
</script>





