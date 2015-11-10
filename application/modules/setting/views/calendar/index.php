<style>
	.table-calendar td{
		height:100px !important;
		width:100px !important;
	}
	
	.prev-month-date,.next-month-date{
		background-color:#F6F6F6;
		
	}
</style>
<div class="row">
<div class="col-md-2">
	<ul class="nav nav-tabs nav-stacked">
          <li class="active"><a href="javascript:void()">Calendar</a></li>
          <li><a href="<?=base_url()?><?=$this->module?>upload_data">Upload Hari Libur</a></li>
        </ul>
</div>
<div class="col-md-7">
<?php echo portlet_simple_start();?>
<? echo $print_calendar;?>
<?php echo portlet_simple_end();?>
</div>
<div class="col-md-3">
<table class='table table-condensed table-event' width="100%">
<thead><tr><th style="width:80px">Action</th><th style="width:150px">Tanggal</th><th>Nama</th></tr></thead>
<? foreach($data_libur as $x=>$val):
	$val["tanggal"]=date("Y-m-d",strtotime($val["tanggal"]));
	$data_libur_per_id[$val["id"]]=$val;
	?>
	 <tr data-id='<?=$val["id"]?>'>
     <td>
     	<a class="calendar-edit-event" href="javascript:void(0)"><i class="icon-pencil"></i></a>
        <a class="calendar-delete-event red" href="javascript:void(0)"><i class="icon-remove"></i></a>
     </td>
     <td data-date='<?=date("Y-m-d",strtotime($val["tanggal"]))?>'><?=date2indo($val["tanggal"])?></td>
     <td>
	 	<?=$val["name"]?>
      </td>
      </tr>
<? endforeach;?>
</table>
</div></div>


<!-- FORM ADD -->
<div id="div-form-add" class="modal" tabindex="0">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				&times;
			</button>
			<h4 class="blue bigger">Update Tanggal</h4>
		</div>
		<form method="post" id="frm-add">
        	 <input type="hidden" id="act" name="act" value="add">
             <input type="hidden" id="id" name="id" value="">
			 <input type="hidden" id="tanggal" name="tanggal" value="" />
			 <div class="modal-body overflow-visible">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<label for="form-field-username">Nama</label>
							<div>
								<input class="input-md form-control" type="text" id="name" name="name" placeholder="Nama" value="" />
							</div>
						</div>
						
                        
					</div>
				</div>
                <div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<label for="form-field-username">Keterangan</label>
							<div>
								<textarea class="input-md form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
							</div>
						</div>
						
                        
					</div>
				</div>
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="add_save btn btn-primary">
					Save changes
				</button>
			</div>
		</form>

	</div>
</div>
</div><!-- END FORM ADD -->



<script>
	var data_libur=<?=json_encode($data_libur_per_id);?>||[];
	$(function(){
		$("td").mouseover(function(){
			$(this).find(".calendar-edit").show();
		}).mouseout(function(){
			$(this).find(".calendar-edit").hide();
		});
		
		$(".calendar-edit").click(function(e){
			e.preventDefault();
			var tanggal=$(this).closest("td").data("date");
			$("#frm-add").find("#tanggal").val(tanggal);
			$("#frm-add").find("#keterangan").val("");
			$("#frm-add").find("#name").val("");
			$("#frm-add").find("#act").val("add");
			$("#div-form-add").modal();
			//$("#name").focus();
			
		});
		
		$(".calendar-edit-event").click(function(e){
			e.preventDefault();
			//var tanggal=$(this).closest("td").data("date");
			var id=$(this).closest("tr").data("id");
			var data_event=data_libur[id];
			$("#frm-add").find("#act").val("update");
			$("#frm-add").find("#tanggal").val(data_event.tanggal);
			$("#frm-add").find("#id").val(data_event.id);
			$("#frm-add").find("#name").val(data_event.name);
			$("#frm-add").find("#keterangan").val(data_event.keterangan);
			$("#div-form-add").modal();
			$("#name").focus();
			
		});
		
		
		
		$(".add_save").on("click",function(e){
			e.preventDefault();
			var form=$(this).closest("form");
			var url="<?php echo base_url();?><?php echo $this->module;?>";
			if(form.find("#act").val()=="add"){
				url=url+"/add_save";
			}
			
			if(form.find("#act").val()=="update"){
				url=url+"/edit_save";
			}
			var dataString=form.serialize()+"&time="+(new Date).getTime();
			if($("#frm-add").valid()==false){
				return false;
			}
			ajax_form_submit(form,url,dataString);
			
		});
		
		$(".calendar-delete-event").click(function(e){
			e.preventDefault();
			 var that=$(this).closest("tr");
			 var id=that.data("id");
			 var url="<?php echo base_url();?><?php echo $this->module;?>delete_save/"+id;
			 var r = confirm("Are sure to delete this event?");
			 if (r == true){
			  	$.get(url,function(msg){
					if($.trim(msg)=="ok"){
						//that.remove();
						location.reload();
					}else{
						alert("Warning","Proses penyimpanan tidak berhasil,kontak Admin!")
					}
				});
			 }
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
						//alert("Data Telah Tersimpan");
						location.reload();
					}else{
						alert("Warning","Proses penyimpanan tidak berhasil,kontak Admin!")
					}	
				}
		
			});
	}
</script>


<script>
	$(function(){
		var act_link="<?=substr(trim($this->module), 0, -1);?>";	
		$(".menu-bar").find("li.active").removeClass("active");
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").addClass("active");
		//$(".menu-bar").find("a[href*='"+act_link+"']").css("color","red");
	});
</script>

<script>
	/*
	$(document).ready(function(){
			callCalendar('calendar.php');
			$('body').delegate('.ajax-navigation', 'click', function(e){
				e.preventDefault();
				callCalendar($(this).attr('href'));
			});
		});
		function callCalendar(url) {
			$.get(url,function(data){
				$('.calendar').html(data);
			});
		}
	*/
</script>