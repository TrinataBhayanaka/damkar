<? if (!$_SESSION['login']) { ?>
<script>window.location.href='auth/login/';</script>
<? exit; }  ?>

<? if ($delete) { ?>
    <div id="result">
    <div>Proses Delete Berhasil</div>
    </div>
    <script>window.location.href='<?=$module;?>';</script>
<? } else { ?>

<div id="subheader">
    <div class="cmstitle">News / Delete</div>
    <div id="submenu" style="background:#eee">
    <ul>
      <li id="permohonan" class="submenu_a" title="List"><a href="<?=$module;?>"><img src="assets/image/app/list.gif" border="0" align="absmiddle" /></a></li>       
      <li id="permohonan" class="submenu_a" title="Edit"><a href="<?=$module;?>edit/<?=$data['id'];?>"><img src="assets/image/app/edit.gif" border="0" align="absmiddle" /></a></li>       
    </ul>
    </div>
</div>
<div style="padding:10px">
  <form id="fdata" action="<?=$module;?>delete" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="reg_id" value="<?=$_SESSION['s_regid'];?>" />
    <input type="hidden" name="id" value="<?=$data['id'];?>" />
	<div style="background-color:#CC0000; color:#fff; padding:10px; font-size:large">Delete News "<?=$data['title'];?>"?  <button type="submit">Ya</button> <button id="back" type="button">Tidak</button></div>
	<div style="padding:10px; border:1px solid #ccc"><?=$data['content'];?></div>
    <br />
    <br />
  </form>
</table>
</div>
<script>  
    $(document).ready(function () {
		$("li[rel~='cms1']").addClass("mmenuactive");
		$("#button_submit").click(function(e){
			$("#fdata").submit();
			e.preventDefault();
		});
		$("#back").click(function(){
			history.back();
		});
	})
</script>
<? }  ?>