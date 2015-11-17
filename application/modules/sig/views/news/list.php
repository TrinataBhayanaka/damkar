<? if (!$_SESSION['login']) { ?>
<script>window.location.href='auth/login/';</script>
<? exit; }  ?>

<?
$result = ($key)?"Keywords: <strong>".$key."</strong>":"&nbsp;"; 
?>
<div id="subheader">
<div class="cmstitle">News / List</div>
<div id="submenu" style="background:#eee">
<ul>
  <li id="permohonan" class="submenu_a" title="Baru"><a href="<?=$module;?>add"><img src="assets/image/app/new.gif" border="0" align="absmiddle" /></a></li>       
  <li id="refresh" class="submenu" title="Refresh"><a href="<?=$module;?>index/<?=$url_jump;?>"><img src="assets/image/app/refresh.gif" border="0" align="absmiddle" /></a></li>
  <li class="submenu"><span><input type="text" id="key_list" value="<?=$keywords;?>" style="width:180px; border:none; border-bottom:1px dotted #ccc" /> <img src="assets/image/app/search.gif" border="0" align="absmiddle"id="button_list" />&nbsp;</span></li>
</ul>
</div>
</div>
<div style="padding:10px">
<div style="padding-left:12px; font-size:medium;border-bottom:5px solid #ccc"><?=$result;?><div class="content-data-info">Data <?=$data_start;?> - <?=$data_end;?>, Total: <?=$total_rows;?></div></div>
<div id="tabs-0">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbldata">
        <tr>
        <td class="tbldata_header" width="40">&nbsp;</td>
        <td class="tbldata_header" width="20">No.</td>
        <td class="tbldata_header" width="20">&nbsp;</td>
        <td class="tbldata_header forder" width="100" rel="date">Date</td>
        <td class="tbldata_header forder" width="300" rel="title">Title/Judul</td>
        <td class="tbldata_header" >News Clip</td>
        <!--<td class="tbldata_header forder">Alamat</td>-->
        <td class="tbldata_header" width="100">Publish</td>
        </tr>
  <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
  		$tr_color=($k%2)?"#fff":"#fafafa";
		
		$url_edit = $module."edit/".$v['id'];
		$url_delete = $module."delete/".$v['id'];
		
   ?>
            	<tr class="content-data-row" style="background-color:<?=$tr_color;?>">
					<td class="content-data-text" align="center" style="white-space:nowrap">
                        <a href="<?=$url_edit;?>"><img src="assets/image/app/edit.gif" border="0" /></a> 
                        <a href="<?=$url_delete;?>"><img src="assets/image/app/delete.gif" border="0" /></a>
                    </td>               
                    <td><?=($data_start+$k);?></td> 	
                    <td align="center"></td> 	
                    <td class="content-data-title" rel="date_col"><?=$v['date_formatted'];?></td>
                    <td class="content-data-title" rel="title_col"><a href="<?=$url_edit;?>"><?=$v['title'];?></a></td>
                    <td class="content-data-title"><?=$v['clip'];?></td>
                    <td class="content-data-title"><?=$v['status'];?></td>
            	</tr>
        <? } }?>
        </table>

        </td>
      </tr>
    </table>
    </div>
    <br />
    <div class="cmspaging">
		            <div style="float:right; height:40px; width:100%">
	  	<div class="content-data-info">Data <?=$data_start;?> - <?=$data_end;?>, Total: <?=$total_rows;?></div><?=$perpage.$paging;?>
      </div>
    </div>
    <br />
<br />
<br />
</div>
<script>  
	var forder='<?=$forder;?>';
	var dorder='<?=$dorder;?>';
    $(document).ready(function () {
		$("li[rel~='cms1']").addClass("mmenuactive");
		
		$("#button_list").click(function(){
			var key=($("#key_list").val())?$("#key_list").val():'0';
			var prc=$("#page_record").val();
			var order=(forder!='' && dorder!='')?forder+':'+dorder:0;
			window.location.href='<?=$module;?>index/'+key+'/'+order+'/'+prc+'/1';
		});
		
		$("#page_record").live("change",function(){
			$("#button_list").trigger("click");
		});
		
		$(".forder[rel~='<?=$forder;?>']").append('<span style="margin-right:5px; float:right"><img src="assets/image/app/<?=$dorder;?>.gif" align="absmiddle"></span>');
		$("td[rel~='<?=$forder;?>_col']:odd").css('background-color',"#fafafa");
		$("td[rel~='<?=$forder;?>_col']:even").css('background-color',"#f4f4f4");
		$("td[rel~='<?=$forder;?>_col']").css('font-weight',"bold");
		$(".forder").click(function(){
			if (forder==$(this).attr("rel")) {
				dorder=(dorder=='desc')?'asc':'desc';
			}
			else {
				dorder='asc';
			}
			forder=$(this).attr("rel");
			$("#button_list").trigger("click");
		});
    })
</script>