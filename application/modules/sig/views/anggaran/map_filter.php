  <form onsubmit="return false">
  <div class="navfilter">
  <table border="0" width="100%" cellpadding="2">
  <tr>
  <td class="subheader" colspan="3">&nbsp;Wilayah <small class="pull-right">(Provinsi/Kab)</small>:</td>
  </tr>
  <tr>
  <td colspan="3">
    <div id="adm_1">
    <select id="propinsi_list" name="id_propinsi" style="width:100%">
    <option value="0" kode_dagri="" rel="change">INDONESIA</option>
    <?php if (is_array($list_propinsi)) { print_r($list_propinsi); ?> 
    <?php foreach($list_propinsi as $k=>$v) { 
    $selected=($v['kode_wilayah']==$list_propinsi_selected)?" selected":"";
	
	if ($v['parent']!=0) {
		$text = $v['kode_wilayah']." &nbsp; - ". $v['nama_wilayah'];
		$color = "#555";
		$rel = "";
	}
	else {
		$text = $v['kode_wilayah']." - ". $v['nama_wilayah'];
		$rel = "change";
	}
    ?>
    <option style="color:<?php echo $color;?>" value="<?php echo $v['kode_wilayah'];?>" rel="<?php echo $rel;?>" kode_dagri="<?php echo $v['kode_dagri'];?>" bps="<?php echo $v['kode_bps'];?>"<?php echo $selected;?>><?php echo $text;?></option>
    <?php } ?>
    <?php } ?>
    </select>
    </div>  </td>
  </tr>
  <tr style="background:#e7e7e7">
  	<td class="subheader" valign="middle">&nbsp;Indikator:  </td>
    <td width="100" align="right" valign="middle" class="subheader">Tahun</td>
    <td width="70" align="right" valign="bottom">
    <select id="tahun_list" name="tahun_list" style="width:auto; margin-bottom:0">
    <?php if (is_array($tahun_indikator)) {  ?> 
    <?php foreach($tahun_indikator as $k=>$v) { 
    $selected=($v['tahun']==$tahun_indikator_selected)?" selected":"";
    ?>
    <option value="<?php echo $v['tahun'];?>"<?php echo $selected;?>><?php echo $v['tahun'];?></option>
    <?php } ?>
    <?php } ?>
  </select>
    </td>
  </tr>
  <tr>
  <td colspan="3">
<div class="controls">
<?php
if (is_array($indikator)) {
	foreach($indikator as $k=>$v) {
?>

    <label class="radio" title="<?php echo $v['description'];?>">
    <input class="pny" name="sb" type="radio" value="<?php echo $v['colom_nilai'];?>" checked="checked" /> <?php echo $v['kategori'];?>
    </label>
<?php
}
}
?>
</div>  </td>
  </tr>
  <tr>  </tr>
  <tr>
  <td>  </td>
  </tr>
  </table>
  </div>
  
  <div style="padding:5px 10px;">
    <button id="search_submit" class="btn btn-inverse">Submit</button> <button id="reset_data" class="btn btn-inverse">Reset</button>
</div>
</form>
