<?php 
	$q=$this->input->get_post("q",TRUE);
	$q=$q?$q:"";
?>

                         	<div class='input-append'>
                              <input class="input" id="q" name="q"  type="text" value="<?=$q?>" placeholder="Search..." />
                              <button type="submit" class='add-on btn'><i class="icon-search"></i>&nbsp;Search</button>
                              <button type="reset" class='add-on  btn  btn-danger' id="search-reset"><i class="icon-refresh"></i>&nbsp;Reset</button>
                             </div>
                         
                         <script>	
						 	$(function(){
								$("#search-reset").click(function(){
									location=document.URL.split("?")[0];
								});
								
								/*
								$("#frm-search").submit(function(){
									var str="";
									$("#frm-search input").each(functionm(){
										$str+=$.trim($(this).val());
									});
									$("#frm-search select").each(functionm(){
										$str+=$.trim($(this).val());
									});
									
									return false;
									var q=$("#q").val();
									
									q=$.trim(q);
									if(q==""){
										location="<?=base_url()?><?=$this->module?>";
										return false;
									}
								});
								*/
								
							});
						 </script>