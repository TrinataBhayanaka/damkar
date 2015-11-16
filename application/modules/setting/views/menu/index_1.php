<link rel="stylesheet" type="text/css" href="assets/js/plugin/nestable/nestable.css" />
<?=js_asset("plugin/nestable/jquery.nestable.js");?>

fdasfasdfsa
<? 
	//debug();
	//debug();
	$arrMenu=$this->conn->GetAll("select * from t_menu order by order_num");
	//debug();
	//pre(buildNestedList($arrMenu));
	
	$tree=buildTree($arrMenu);
	printNestedList($tree);
	
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
				print " <li class='dd-item' data-id='".$val["menu_id"]."'>";
				print "<div class='dd-handle'>".$val["menu_text"]."</div>";
				if(has_children($arrMenu,$val["menu_id"])==TRUE):
					buildNestedList($arrMenu,$val["menu_parent_id"]);
				endif;
				print "</li>";
			endif;
		endforeach;
		print "</ul>";
	}
	
	
?>
<div class="row">
<div class="col-md-12">
            <menu id="nestable-menu">
                <button data-action="expand-all" class="btn btn-primary" type="button">Expand All</button>
                <button data-action="collapse-all" class="btn btn-primary" type="button">Collapse All</button>
            </menu>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div id="nestablexx" class="cdd nestable">
                        <? buildNestedList($arrMenu);?>
                	</div>
              </div>  

        </div>
</div>
</div>
 <h3>Serialised output for each list</h3>
 <form id="frm" method="post" action="<?=$this->module?>save_menu/">
    <textarea id="nestable-output" name="nestable-output" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"></textarea>
    <textarea id="nestable2-output" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"></textarea>
</form>
<button id="get_json">Get Data</button>
<button id="save_menu">Save</button>
<script>
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
			group:1
		}).on('change', updateOutput);
		
		updateOutput($('#nestable').data('output', $('#nestable-output')));
		
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
	});
</script>