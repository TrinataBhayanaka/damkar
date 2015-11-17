

<h4 class="heading">List Undang Undang Pembentukan Daerah</h4>

<div class="row">
    <div class="col-md-offset-3 col-md-6">

<div class="input-group">
    <input type="text" placeholder="Search..." class="form-control searchbox search_tbl" id="search_tbl" name="search_tbl">
    <span class="input-group-btn">
    	<button class="btn btn-flat btn-sm" id="search-btn" name="seach" type="submit"><i class="fa fa-search"></i></button>
    </span>
	</div>
</div></div>

<div class="formSep"></div>
<div class="row">
<div class="col-md-12">
<form id="frm_list_hukum" method="post">
        <table id="tbl_uu" class="table table-bordered table-condensed" style="border-collapse:collapse;width:90%">
        	<thead class="box_quote">
            <tr style="height:24px">
           	  <th width="14"><input name="checkall" id="checkall" class="sOption" type="checkbox" /></th>
              <th>UU</th>
              <th>Tentang</th>
            </tr>
            </thead>
            <tbody>
         <?php if(cek_array($arrData)==TRUE):?>
		<?php foreach($arrData  as $x=>$value): ?>
        	<tr>
            	<td style="width:10px"><input name="chk[]" data-id="<?=$value["idx"]?>" data-txt="<?=$value["tentang"]?>" data-no="<?=$value["no_peraturan"]?>" class="cbsel sOption" type="checkbox" value="<?php echo $value["idx"]?>" /></td>
               <td><?php echo $value["no_peraturan"]?></td>
               <td><?php echo "tentang ". $value["tentang"]?></td>
           </tr>
        	
		<? endforeach;?>
         <?php else:?>
        	<tr><td colspan="5" style="height:auto">
                <div class="alert" style="margin-bottom:0">
                  <a class="close" data-dismiss="alert">x</a>
                  Data belum ada!!!
                </div>
            </td>
            </tr>
        <?php endif;?>
        </tbody>
        </table>
        
        <a href="/pilih" class="a_pilih_uu btn btn-primary">Pilih</a>
        
        </form>
        

</div></div>



<script>
	$(function(){
		/*
		var idStr=$("#dasar_id").val();
		alert("test");
		if(idStr!=""){
			var idSplit=idStr.split("|");
			for(i=0;i<idSplit.length;i++){
				$(".cbsel[data-id='"+idSplit[i]+"']").attr("checked","checked");
			}
		}
		*/
	});
</script>