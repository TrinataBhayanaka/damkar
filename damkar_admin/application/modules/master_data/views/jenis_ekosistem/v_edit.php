<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<!--<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="assets/js/plugin/ckeditor4.4.2/ckeditor.js"></script>
<script type="text/javascript" src="assets/js/plugin/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<!-- Place inside the <head> of your HTML -->

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
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?> <small> Edit </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>/jenis_ekosistem">Master Data</a> <span class="divider"></span></li>
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
                <!--  
                 <li>
                    <a href="<?=$this->module?>view/<?=$id?>">
              
                        <span class="block text-center">
                            <i class="icon-search"></i> 
                        </span>
                       	View <?=$this->module_title?>
                    </a>
                </li>
                -->
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

	<?php echo message_box();?>
	<div class="row-fluid">
		<ul class="nav nav-tabs" id="news-tab">
		   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-edit"></i> Edit</a></li>
	<!--   <li><a href="#tab-view" class="a_view"><i class="icon-eye-open"></i> View</a></li>
		   <li><a href="#tab-comments" class="a_view"><i class="icon-comments-alt"></i> Comments</a></li>-->
		</ul>
	<!--tab content-->
	<form id="frm" action="<?php echo $this->module;?>edit/<?=$id?>" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="act" id="act" value="update"/>
	
<div class="tab-content">
		
<div id="tab-edit" class="tab-pane active">    
    <div class="row">
	    <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                <!-- ID Hidden -->
                    <input type="hidden" id="idx" name="idx" style="color: red" class="form-control input-xs required" value="<?=$data['idx'];?>" readonly />
                </div>
                <div class="col-md-8">
                    <label>ID Jenis Ekosistem</label>
                    <input type="text" id="id_jenis_ekosistem" name="id_jenis_ekosistem" class="form-control input-xs required" value="<?=$data['id_jenis_ekosistem'];?>" />
                </div>
               
              <!--  
				<div class="row">
                     <div class="col-md-4">
						<br>
                        
                       
                     </div>
                </div>
               -->
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-8">
                         <label>Jenis Ekosistem</label>
                    	 <input type="text" id="jenis_ekosistem" name="jenis_ekosistem" class="form-control input-xs required" value="<?=$data['jenis_ekosistem'];?>" />
                    </div>
                  	
                  
                    <div class="col-md-8">
                    <label>Order Num</label>
                    <input type="text" id="order_num" name="order_num" class="form-control input-xs required" value="<?=$data['order_num'];?>" />
                	</div>
                	
                </div>
            </div>
        </div>
    </div>
    <br />
   
     	<div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn">Cancel</button>
    	</div>
	
    <br />
</div>
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
			$("#id_propinsi_1").select2({'placeholder':"--Pilih Propinsi 1--"});
			$("#id_propinsi_2").select2({'placeholder':"--Pilih Propinsi 2--"});
			$(".id_kabupaten").select2({'placeholder':"--Pilih Propinsi 2--"});
			
			
			setInterval(function(){
				var id_propinsi_1=$("#id_propinsi_1").find("option:selected").val();
				var propinsi_1=$("#id_propinsi_1").find("option:selected").text();
				
				var id_propinsi_2=$("#id_propinsi_2").find("option:selected").val();
				var propinsi_2=$("#id_propinsi_2").find("option:selected").text();
				
				if((id_propinsi_1!="")&&(id_propinsi_2!="")){
					$("#add_batas").show();
				}else{
					$("#add_batas").hide();
				}
			},500)
			
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
			
			$("#add_batas").click(function(e){
				e.preventDefault();
				var id_propinsi_1=$("#id_propinsi_1").find("option:selected").val();
				var propinsi_1=$("#id_propinsi_1").find("option:selected").text();
				
				var id_propinsi_2=$("#id_propinsi_2").find("option:selected").val();
				var propinsi_2=$("#id_propinsi_2").find("option:selected").text();
				
				$("table.batas_wilayah tbody").append("<tr><td class='no'></td><td class='propinsi_1'></td><td class='propinsi_2'></td><td><a href='/remove_batas' class='remove_batas'><i class='icon-remove red'></i></a></td></tr>");
				$("table.batas_wilayah tbody tr:last").find(".propinsi_1").load("<?=$this->module?>get_kab_kota/"+id_propinsi_1+"/1"+"/?time="+new Date().getTime(),function(){
					$("table.batas_wilayah tbody tr:last").find(".id_kabupaten_1").select2({placeholder:"--Pilih Kabupaten--"});
				});
				
				$("table.batas_wilayah tbody tr:last").find(".propinsi_2").load("<?=$this->module?>get_kab_kota/"+id_propinsi_2+"/2"+"/?time="+new Date().getTime(),function(){
					$("table.batas_wilayah tbody tr:last").find(".id_kabupaten_2").select2({placeholder:"--Pilih Kabupaten--"});
				});
				
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
				
				//$("#propinsi").val(selected);
				//$("#kab_kota").val("");
				/*
				$("#id_kab_kota1").load("<?=$this->module?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
					$("#kd_bps_kab_kota").select2({placeholder:"--Pilih Kabupaten--"});
				});
				*/
				
				//$("table.batas_wilayah thead").find(".propinsi_1").text(selected);
				$("table.batas_wilayah tbody").find(".propinsi_1").load("<?=$this->module?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
					$(".id_kabupaten").select2({placeholder:"--Pilih Kabupaten--"});
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
<script>  
$(document).ready(function () {
	$('#dp3').datepicker().on('changeDate', function(ev){
		$('#dp3').datepicker('hide');
	});
	var act_link="<?=$this->module?>";		
	$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
	$("#fdata").validate({ignore:[]});
	$(".f_req").remove();
	$(".required").each(function(i){
		$(this).parent().find("label:first-child").append(" <span class='f_req'>*</span>");
	});
	$("#button_submit").click(function(e){
		$("#fdata").submit();
		e.preventDefault();
	});
	
	/*var config = {
		toolbar:
		  [
			 ['Undo', 'Redo', '-', 'SelectAll'],
			 ['Styles','Format', 'Bold', 'Italic', 'Underline','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			 ['Image','Table'],
			 ['Link', 'Unlink'], 
			 ['Source'],
		  ]
	};
	$('textarea#news_content' ).ckeditor(config);*/
	$('#news-tab a:first').tab('show');
	$('#news-tab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		$("#title-view").html($("#title").val());
		$("#news_clip-view").html($("#news_clip").val());
		$("#news_content-view").html("").html($("textarea#news_content").val());
	});
});

//Uploader
$(function(){
	var ufile=false;
	var dfile=<?=($data['image'])?"true":"false";?>;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickfiles',
		container: 'imgcontainer',
		multi_selection: false,
		url: "<?=base_url()?>test.php",
		max_file_size : '200kb',
		resize: {
			width: 200,
			height: 200,
			crop: true
		},
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
	
	uploader.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		if (dfile) {
			$('#preview').html("");
			$('#canvas_view').html("");
		}
		if (ufile) {
			uploader.removeFile(ufile);
			$('#preview').html("");
			$('#canvas_view').html("");
		}
		$.each(files, function(i,file){
			ufile = file.id;
			$("#image_name").val(file.name);
			var img = new mOxie.Image();
	
			img.onload = function() {
				this.embed($('#preview').get(0), {
					width: 200,
					height: 200,
					crop: true
				});
				$('#canvas_view').css({margin:"2px 10px 10px 2px"});
				$('#canvas_view').css({width:200,height:200});
				this.embed($('#canvas_view').get(0), {
					width: 200,
					height: 200,
					crop: true
				});
			};
	
			img.onembedded = function() {
				this.destroy();
			};
	
			img.onerror = function() {
				this.destroy();
			};
	
			img.load(this.getSource());        
			
		});
	});
	uploader.bind('Error', function(up, err) {
		alert("Error: " + err.code + " -" + err.message/* +  (err.file ? ", File: " + err.file.name : "")*/);
		up.refresh(); // Reposition Flash/Silverlight
	});
	var x = false;
	uploader.bind('FileUploaded', function() {
		//if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
			x=true;
			$('#fdata').submit();
		//}
	});
	$('#fdata').submit(function(e) {
		// Files in queue upload them first
		if (uploader.files.length > 0) {
			
			uploader.start();
		} else {
			x = true;
		}
		//	alert('You must at least upload one file.');
	
		if (!x) return false;
	});    
    
});
</script>
<? //$this->load->view("active_menu");?>