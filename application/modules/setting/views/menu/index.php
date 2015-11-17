<link rel="stylesheet" type="text/css" href="assets/js/plugin/nestable/nestable.css" />
<?=js_asset("plugin/nestable/jquery.nestable.js");?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/js/plugin/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css" />
<?=js_asset("plugin/bootstrap-iconpicker/js/bootstrap-iconpicker.js");?>


<style>

.nestable{
	max-width:600px!important;
}

.dd_table{
	max-width:600px;
	width:95%;
	position:absolute;
	z-index:20;
	/*padding:0;
	margin:0;*/
	right:0;
}

.dd_table_header{
	width:95%;max-width:600px;
	position:relative;
	z-index:20;
	/*padding:0;
	margin:0;*/
	right:0;
}

.dd-menu-header{
	position:relative!important;
	text-align:center;
	font-weight:bold;
}
.dd_table .dd-menu-text{
	text-align:left!important;
	border-left: 1px solid #E3E3E3;
	width:auto;
}
.dd_table .dd-menu-url{
	border-left: 1px solid #E3E3E3;
	width:150px;
}
.dd_table .dd-menu-class{
	text-align:center;
	border-left: 1px solid #E3E3E3;
	width:100px;
}
.dd_table .dd-menu-action{
	text-align:center;
	border-left: 1px solid #E3E3E3;
	width:65px;
}

.popover{
	z-index:5000;
}
</style>

<? 
	$arrCategory=$this->conn->GetAll("select * from t_menu_category where active=1 order by order_num");
	$sql="select * from t_menu";
	$cat_id=1;
	if(isset($_REQUEST["cat_id"])){ 
		$cat_id=$_REQUEST["cat_id"];
	}
	$sql.=" where id_menu_category=".$cat_id." or 0"; 
	$sql.=" order by order_num";
	$arrMenu=$this->conn->GetAll($sql);
	//pre(buildNestedList($arrMenu));
	$tree=buildTree($arrMenu);
	//printNestedList($tree);
	//buildNestedList($arrMenu);
	//exit();
	function buildTree(Array $data, $parent = 0) {
		$tree = array();
		foreach ($data as $d) {
			if ($d['menu_parent_id'] == $parent) {
				$children = buildTree($data, $d['menu_id']);
				// set a trivial key
				if (!empty($children)) {
					$d['children'] = $children;
				}
				$tree[] = $d;
			}
		}
		return $tree;
	}
	
	function printNestedList($tree,$p=null){
		print "<ul>";
		foreach ($tree as $i => $t):
			print "<li>".$t["menu_id"].$t["menu_text"];
			if (isset($t['children'])):
				printNestedList($t['children'], $t['menu_parent_id']);
			endif;
			print "</li>";
		endforeach;
		print "</ul>";
	}
	
	function buildNestedList($arrMenu,$parent=0){
		print "<ol class='dd-list'>";
		foreach($arrMenu as $x=>$val):
			if($val["menu_parent_id"]==$parent):
				//rendering data
				$data_tmp=array();
				foreach($val as $key=>$value):
					$data_tmp[]="data-".$key."='".$value."'";
				endforeach;
				if(cek_array($data_tmp)):
					$data_str=join(" ",$data_tmp);
				endif;
				$div_str=$val["menu_text"];
				$div_str='<table class="dd_table">
                    	<tr><td>'.$val["menu_text"].'</td><td class="dd-menu-url">'.$val["menu_url"].'</td><td class="dd-menu-class"><i class='.$val["menu_icon"].'></i></td>
				';
				$div_str.="<td class='dd-menu-action tc'>
					<a href='#' class='menu_edit blue'>
					<i class='icon-pencil bigger-130'></i>
					</a>
					<a href='#' class='menu_delete red'>
						<i class='icon-trash bigger-130'></i>
					</a>
					</td>";
				
				$div_str.='</tr></table>';
				
				/*
				$div_str="<div class='menu-text pull-left'>".
								$val["menu_text"]
						  ."</div";
				$div_str.="<div class='menu-url pull-right'>".
								$val["menu_url"]
						  ."</div";
				*/
				print " <li class='dd-item' data-id='".$val["menu_id"]."' $data_str>";
				print "<div class='dd-handle'>
					$div_str
					</div>";
				if(has_children($arrMenu,$val["menu_id"])==TRUE):
					buildNestedList($arrMenu,$val["menu_id"]);
				endif;
				print "</li>";
			endif;
		endforeach;
		print "</ol>";
	}
	
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
            <li><a href="#">Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>master">Master</a> <span class="divider"></span></li>
            <li class="active"><?=$this->module_title?></li>
          </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
    
    <h4>Menu</h4>
        <ul class="nav nav-tabs menu_tab">
        	<? if(cek_array($arrCategory)):?>
            <? foreach($arrCategory as $x=>$val):?>
            	<li id="li_<?=$val["id_menu_category"]?>"><a href="#" data-id="<?=$val["id_menu_category"]?>" data-category="<?=$val["category"]?>"><?=$val["category"]?></a></li>
            <? endforeach;?>
            <? endif;?>
        </ul>
        
        <div>
    	<div class="pull-right" style="margin-top:-40px">
        	<span><b>Cetegory :</b></span>
            <div class="btn-group">
        	<a class="btn btn-primary btn-sm btn-category-add"><i class="icon-plus"></i></a>
            <a class="btn btn-default btn-sm btn-category-edit"><i class="icon-pencil"></i></a>
        	</div>
            <a class="btn btn-danger btn-sm btn-category-delete"><i class="icon-remove"></i></a>	
        </div>
        
		</div>
        
        
    </div>
</div>
<br>
<div class="row">
	<div class="col-md-12 col-sm-12">
    			<h4 class="title">Menu 1</h4>
    		
    
                 <div class="btn-toolbar">
                        <div id="nestable-menu" class="btn-group">
                            <button data-action="expand-all" class="btn btn-default btn-xs" type="button"><i class='icon-plus'></i> Expand All</button>
                            <button data-action="collapse-all" class="btn btn-default btn-xs" type="button"><i class="icon-minus"></i> Collapse All</button>
                        </div>
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary btn-xs menu_add"><i class="icon-plus-sign"></i> New</a> 
                        </div>
                        <div class="btn-group">
                        	<button id="save_menu" class="btn btn-xs btn-warning" style="display:none"><i class="icon-save"></i> Save Sort</button>
                        </div>
                  </div>
    </div>
    <?php echo message_box();?>
                 
</div>
<br>

<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
    	<table class="dd_table dd-menu-header">
                    	<tr><td>Title</td><td class="dd-menu-url">Url</td><td class="dd-menu-class">Class</td><td class="dd-menu-action">Action</td></tr>
                    </table>
			        <div id="nestable" class="dd nestable">
                            <? buildNestedList($arrMenu);?>
                    </div>
              	<br>
                
                <form id="frm" method="post" style="display:none" action="<?=$this->module?>save_menu/">
                    <textarea id="nestable-output" name="nestable-output" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"></textarea>
                    <textarea id="nestable2-output" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"></textarea>
                </form>

                <button id="get_json" class="btn btn-default" style="display:none">Get Data</button>
                
		</div><!-- end col menu -->
        
</div><!-- end row-->

<script>
	var cat_id="<?=$_REQUEST["cat_id"]?>"||1;
	$(function(){
		var updateOutput = function(e)
		 {
			 var list = e.length ? e : $(e.target),
			 output = list.data('output');
			 if (window.JSON) {
			 	output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2)); 
			 } else {
			 	output.val('JSON browser support required for this demo.');
			 }
		 };
		
		$('.dd').nestable({
			group:0
		}).on('change', updateOutput);
		
		$('.dd-handle a').on('mousedown', function(e){
			e.stopPropagation();
		});
		
		updateOutput($('#nestable').data('output', $('#nestable-output')));
		
		$("#save_menu").hide();
		
		$("#nestable-menu .btn").click(function(){
			var action=$(this).data("action");
			if(action=="expand-all"){
				$(".dd").nestable("expandAll");
			}
			if(action=="collapse-all"){
				$(".dd").nestable("collapseAll");
			}			
		});
		
		$("#get_json").click(function(){
			updateOutput($('#nestable').data('output', $('#nestable-output')));
		});
		
		$("#save_menu").click(function(){
			$("#frm").submit();
		});
		
		$("#nestable").on("change",function(){
			$("#save_menu").show();
		});
		
		$(".menu_edit").click(function(e){
			e.preventDefault();
			 //var menu_data=$('#nestable').data('output'));
			 $("#menu-form-edit form #id_menu_category").val(cat_id);
			
			 var menu_data=$(this).closest(".dd-item").data();
			 var div_form=$("#menu_form_edit");
			 var form=div_form.find("form");
			 form.find("#menu_text").focus();
			 form.find("#menu_id").val(menu_data.menu_id);
			 form.find("#menu_text").val(menu_data.menu_text);
			 form.find("#menu_url").val(menu_data.menu_url);
			 form.find("#menu_icon").val(menu_data.menu_icon);
			 form.find(".btn_menu_icon").iconpicker('setIcon', menu_data.menu_icon);
			 div_form.modal();
			 $("#menu_text").focus();
			 //$("#menu_form_edit").modal();
		});
		
		$(".menu_delete").click(function(e){
			e.preventDefault();
			 var menu_data=$(this).closest(".dd-item").data();
			 var id=menu_data.id;
			 var url="<?php echo base_url();?><?php echo $this->module;?>/delete_save/"+id;
			 var r = confirm("Are sure to delete this menu?");
			 if (r == true){
			  	location=url;
			 }
		});
		
		
		$(".menu_add").click(function(e){
			e.preventDefault();
			$("#menu-form-add form #id_menu_category").val(cat_id);
			$("#menu-form-add").modal();
			$("#menu_text").focus();
		});
		
		$(".menu_add_save").on("click",function(e){
			e.preventDefault();
			var form=$(this).closest("form");
			var url="<?php echo base_url();?><?php echo $this->module;?>/add_save";
			var dataString=form.serialize()+"&time="+(new Date).getTime();
			if($("#frm").valid()==false){
				return false;
			}
			ajax_form_submit(form,url,dataString);
			
		});
		
		$(".menu_edit_save").on("click",function(e){
			e.preventDefault();
			var form=$(this).closest("form");
			var url="<?php echo base_url();?><?php echo $this->module;?>/edit_save/"+form.data("id");
			var dataString=form.serialize()+"&time="+(new Date).getTime();
			if($("#frm").valid()==false){
				return false;
			}
			ajax_form_submit(form,url,dataString);
			
		});
	});
	
	function ajax_form_submit(form,url,dataString){
			$.ajax({
				 type: "POST",
				 url: url,
				 data: dataString,
				 success: function(msg){
					if($.trim(msg)=="ok"){
						form.find("input").val("");
						form.parents(".modal").modal('hide');
						alert("Data Telah Tersimpan");
						location.reload();
					}else{
						alert("Warning","Proses penyimpanan tidak berhasil,kontak Admin!")
					}	
				}
		
			});
	}
</script>

<!--<a href="#menu-form-add" role="button" class="blue" data-toggle="modal"> Tambah Menu </a>-->

<!-- FORM ADD -->
<div id="menu-form-add" class="modal" tabindex="0">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				&times;
			</button>
			<h4 class="blue bigger">Tambah Menu</h4>
		</div>
		<form method="post" id="frm-add">
			 <input type="hidden" id="id_menu_category" name="id_menu_category" value="" />
			<div class="modal-body overflow-visible">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<label for="form-field-username">Text Menu</label>
							<div>
								<input class="input-md form-control" type="text" id="menu_text" name="menu_text" placeholder="Text Menu" value="" />
							</div>
						</div>
						<div class="form-group">
							<label for="form-field-username">Link URL</label>
							<div>
								<input class="input-md form-control" type="text" id="menu_url" name="menu_url" placeholder="Username" value="" />
							</div>
						</div>
                        
                        <div class="form-group">
							<label for="form-field-username">Icon Class</label>
							<div>
								<input class="input-md form-control" type="text" id="menu_icon" name="menu_icon" placeholder="Icon" value="" />
							</div>
						</div>
                        
                         <div class="form-group">
							<label for="form-field-username">Icon Class</label>
							<div>
                            	<div class="pull-left" style="margin-right:5px">
                            	 <button class="btn btn-default btn_menu_icon" data-target="menu_icon" role="iconpicker"></button></div><div class="pull-left">	<input class="input-md" style="width:400px" type="text" id="menu_icon" name="menu_icon" placeholder="Icon" value="" />
                                 </div>
                                	
							</div>
						</div>
                        
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="menu_add_save btn btn-primary">
					Save changes
				</button>
			</div>
		</form>

	</div>
</div>
</div><!-- END FORM ADD -->



<!-- FORM EDIT -->
<div id="menu_form_edit" class="modal" tabindex="0">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				&times;
			</button>
			<h4 class="blue bigger">Edit Menu</h4>
		</div>
		<form method="post" id="frm-edit">
        	<input type="hidden" id="menu_id" name="menu_id" value="" />
             <input type="hidden" id="id_menu_category" name="id_menu_category" value="" />
            <div class="modal-body overflow-visible">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<label for="form-field-username">Text Menu</label>
							<div>
								<input class="input-md form-control" type="text" id="menu_text" name="menu_text" placeholder="Menu Text" value="" />
							</div>
						</div>
						<div class="form-group">
							<label for="form-field-username">Link URL</label>
							<div>
								<input class="input-md form-control" type="text" id="menu_url" name="menu_url" placeholder="Menu URL" value="" />
							</div>
						</div>
                         <div class="form-group">
							<label for="form-field-username">Icon Class</label>
							<div>
                            	<div class="pull-left" style="margin-right:5px">
                            	 <button class="btn btn-default btn_menu_icon" data-target="menu_icon" role="iconpicker"></button></div><div class="pull-left">	<input class="input-md form-control" style="width:400px" type="text" id="menu_icon" name="menu_icon" placeholder="Icon" value="" />
                                 </div>
                                	
							</div>
						</div><!-- end form group-->
                        
                        
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="menu_edit_save btn btn-primary">
					Save changes
				</button>
			</div>
		</form>

	</div>
</div>
</div><!-- END FORM ADD -->


<!-- FORM EDIT -->
<div id="category-modal" class="modal" tabindex="0">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				&times;
			</button>
			<h4 class="blue bigger">Category</h4>
		</div>
		<form method="post" id="category-form" action="<?=base_url()?><?=$this->module?>category_save">
        	<input type="hidden" id="act" name="act" value="add" />
            <input type="hidden" id="id_menu_category" name="id_menu_category" value="" />
			<div class="modal-body overflow-visible">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<label for="form-field-username">Category</label>
							<div>
								<input class="input-md form-control" type="text" id="category" name="category" placeholder="Menu Text" value="" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="categori_save btn btn-primary">
					Save Category
                 </button>
			</div>
		</form>

	</div>
</div>
</div><!-- END FORM ADD -->



		<script>
	   	$(function(){
				  $('.btn_menu_icon').iconpicker({
                        iconset: 'icon',
                        icon: '',
                        rows: 5,
                        cols: 5,
                        placement: 'top'
                   });   
				   
				 $('.btn_menu_icon').on('change', function(e) {
				 	var id="#"+$(this).data("target");
					$(this).closest("form").find(id).val(e.icon);
                    //console.log(e.icon);
                 });
		    });
	   </script>   
       
       <script>
	   		$(function(){
				
				$(".menu_tab").find("#li_"+cat_id).addClass("active");
				$(".menu_tab a").click(function(e){
					e.preventDefault();
					$(this).closest("ul").find(".active").removeClass("active");
					$(this).closest("li").addClass("active");
					var id=$(this).data("id");
					var url="<?=$this->module?>";
					if(id>1){
						url+="?cat_id="+id;
					}
					location=url;
				});
				
				
				$(".btn-category-add").click(function(e){
					e.preventDefault();
					$("#category-form input").val("");
					$("#category-form #act").val("add");
					
					$("#category-modal").modal();
				});
				
				$(".btn-category-edit").click(function(e){
					 e.preventDefault();
					 var data=$(".menu_tab .active").find("a").data();
					 var div_form=$("#category-modal");
					 var form=div_form.find("#category-form");
					 form.find("#category").focus();
					 form.find("#category").val(data.category);
					 form.find("#id_menu_category").val(data.id);
					 form.find("#act").val("update");
					 $("#category-modal").modal();
				});
				
				$(".btn-category-delete").click(function(e){
					e.preventDefault();
					
					 var url="<?php echo base_url();?><?php echo $this->module;?>/category_delete/"+cat_id;
					 var r = confirm("Are sure to delete category : "+$(".menu_tab .active a").text()+"?");
					 if (r == true){
						location=url;
					 }
				});
				
				$(".categori_save").click(function(e){
					//e.preventDefault();
					$(this).closest("form").submit();
				});
			});
	   </script>          
                
                
                
       <?php
       		//TODO add cat to add form adn edit form
			// cek functionality
	   ?>
