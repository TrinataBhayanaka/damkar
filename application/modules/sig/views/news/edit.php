<? if (!$_SESSION['login']) { ?>
<script>window.location.href='auth/login/';</script>
<? exit; }  ?>

<? if ($process) { ?>
    <div id="result">
    <div>Proses Berhasil</div>
    </div>
    <script>window.location.href='<?=$module;?>';</script>
<? } else { ?>
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.content",
	plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor"
        ],

        toolbar1: "code | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media | inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',
});

</script>

<div id="subheader">
    <div class="cmstitle">News / Edit</div>
    <div id="submenu" style="background:#eee">
    <ul>
      <li id="permohonan" class="submenu_a" title="List"><a href="<?=$module;?>"><img src="assets/image/app/list.gif" border="0" align="absmiddle" /></a></li>       
      <li id="permohonan" class="submenu_a" title="Delete"><a href="<?=$module;?>delete/<?=$data['id'];?>"><img src="assets/image/app/delete.gif" border="0" align="absmiddle" /></a></li>  
      <li>&nbsp;</li>     
      <li id="permohonan" class="submenu_a" title="Save"><a href="#" id="button_submit"><img src="assets/image/app/save.png" border="0" align="absmiddle" /></a></li>       
    </ul>
    </div>
</div>
<div style="padding:10px">
  <form id="fdata" action="<?=$module;?>edit" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="reg_id" value="<?=$_SESSION['s_regid'];?>" />
    <input type="hidden" name="id" value="<?=$data['id'];?>" />
    <table>
      
      <tr>
        <td valign="top">
        <table cellpadding="4" cellspacing="0">
        <tr>
              <td class="formdata_header" colspan="2" width="120">Title</td>
             </tr>
             <tr>
              <td colspan="2"><input id="title" name="title" type="text" maxlength="150" style="width:99%" class="required" rel="Judul Berita" value="<?=$data['title'];?>" /></td>
          </tr>
         <tr>
              <td class="formdata_header" width="120">Change Image</td>
              <td class="formdata_header">Headline</td>
             </tr>
             <tr>
              <td><input type="hidden" name="MAX_FILE_SIZE" value="<?=$max_newsfoto_size;?>" /><input id="fotohead" type="file" name="file[]" size="30" style="width:290px" /></td>
          	<td><label for="label" style="display:inline-block">
              <input id="label" name="is_headline" type="radio" value="1" />
              Ya</label>
                <label for="label" style="display:inline-block">
                  <input id="label" name="is_headline" type="radio" value="0" checked="checked" />
                  Tidak</label></td>
          </tr>
            <tr>
              <td class="formdata_header" colspan="2" valign="top">Clip</td>
            </tr>
            <tr>
              <td colspan="2"><textarea name="clip" style="width:99%; height:60px" class="required" rel="Potongan Berita"><?=$data['clip'];?></textarea></td>
          </tr>
            <tr>
              <td class="formdata_header" colspan="2">Content</td>
            </tr>
              <td colspan="2">
              <textarea name="content" style="width:370px; height:250px" class="required content" rel="Berita"><?=$data['content'];?></textarea>
            <br />
            <?
				$checked=($data['status'])?" checked":"";
			?>
            <label for="publish_news"><input id="publish_news" name="status" type="checkbox" value="1"<?=$checked;?> /> Publish</label>            </td>
            </tr>
        </table>        </td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
      </tr>
    </table>
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
	})
</script>
<? }  ?>