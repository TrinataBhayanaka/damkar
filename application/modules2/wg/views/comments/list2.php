<style>
* {
   /* font-family: "Segoe UI",Arial,Sans-Serif;*/
}
li, ol, ul {
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
}

/* Comments
------------------------------------------------------------ */

#comments,
#respond {
	margin: 0 0 30px;
	overflow: hidden;
}

#comments {
	font-size: 13px;
	line-height: 20px;
}

#author,
#comment,
#email,
#url {
	font-size: 12px;
	margin: 10px 5px 0 0;
	padding: 5px;
	width: 250px;
}

#comment {
	height: 150px;
	margin: 10px 0;
	width: 98%;
}

.ping-list {
	margin: 0 0 40px;
}

.comment-list ol,
.ping-list ol {
	margin: 0;
	padding: 10px;
}

.comment-list li,
.ping-list li {
	font-weight: bold;
	list-style: none;
	margin: 10px 0 0;
	padding: 10px;
}

.comment-list li ul li {
	list-style-type: none;
}

.comment-list p,
.ping-list p {
	font-size: 13px;
	font-weight: normal;
	line-height: 20px;
	margin: 10px 5px 10px 0;
	padding: 0;
	text-transform: none;
}

.comment-list ul.children {
	margin-top: 20px;
}

.comment-list ul.children li.comment  {
	background: #fff;
}

.comment-list cite,
.ping-list cite {
	font-style: normal;
	font-weight: bold;
}

.commentmetadata {
	font-weight:normal;
}

.comment-author { 
	background: #e5e5e5;
	font-size: 12px;
	font-weight: bold;
	padding: 8px 10px 0;
}

.comment-meta { 
	background: #e5e5e5;
	font-size: 12px;
	padding: 0 10px 8px;
}

.nocomments {
	text-align: center;
}

#comments .navigation {
	display: block;
	padding: 0;
}

.bypostauthor {
}

.thread-alt,
.thread-even {
	background: #f5f5f5;
}

.alt,
.depth-1,
.even {
	border: 1px solid #ddd;
}

.comment-list li .avatar {
    background-color: #FFFFFF;
    float: left;
    height: 30px;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 5px;
    margin-top: 0;
    width: 30px;
}

.comment-header a,
.comment-header a:visited {
	color: #c72730;
	text-decoration: none;
}

.comment-header a:hover {
	text-decoration: underline;
}
.reply a,.reply a:visited{
	color: #c72730;
	text-decoration: none;
}

.reply a:hover{
	color: #c72730;
	text-decoration: none;
}



#comments, #respond {
    margin-bottom: 30px;
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    overflow-x: hidden;
    overflow-y: hidden;
}

</style>
<? //$this->load->view("layout/header");?>
<?
	//pre($arrData);
	//$arrData=$this->conn->GetAll("select * from cms_comments where category=4 and post_id=10 order by idx desc");
?>

<? if(cek_array($arrData)):?>
<div id="comments"><h3>Comments</h3>
    <ol class="comment-list">
    	<? build_comment($arrData,0,1)?>
    </ol>
</div>
<? endif;?>

<?
	function build_comment($arrData,$parent=0,$depth=1){?>
    	 <? if($depth>1):?>
            	<ul class="children">
            <? endif;?>	
           
		<? foreach($arrData as $x=>$val):?>
        	<? if ($val['parent_id'] == $parent):?>
            <? $even=$x%2==0?"even":"odd";?>
            	<li class="comment even thread-<?=$even?> depth-<?=$depth?>">
				<div class="comment-header">
                	<div class="comment-author vcard">
                    	<i class="icon-user"></i>&nbsp; <cite class="fn" style="text-transform:uppercase"><?=$val["name"]?> </cite> <span class="says">says:</span>
                    	<div class="help-block">
                    	<?=date("d M Y (H:i)",strtotime($val["created"]));?>
                    </div>
                    </div>
                    
                </div>
                <div class="comment-content" style="padding:0 10px">
				<p><?php echo $val["body"]?></p>
                </div>
                <div class="reply" style="padding:0 10px">
                	<?php echo "<a href='#' class='comments_reply' data-idx='".$val["idx"]."' data-parent='".$parent."' rel='wg/comments/comments_reply/".$val["idx"]."'>Reply</a>" ?>	
                </div>
                <? if(has_children($arrData,$val["idx"])):?>
               		<?	build_comment($arrData,$val["idx"],$depth+1);	?>
                <? endif;?>
              
            </li>
            <? endif;?>
		<? endforeach;?>
          <? if($depth>1):?>
            		</ul>
            	<? endif;?>	
	<?	
	}
?>

<?php
	 function has_children($rows,$id) {
      foreach ($rows as $row) {
        if ($row['parent_id'] == $id)
          return true;
      }
      return false;
    }
?>

<script>
	$(function(){
		$(".comments_reply").click(function(e){
			e.preventDefault();
			var idx=$(this).data("idx");
			$(".div-reply").each(function(){
				if($(this).attr("id")!=idx){
					$(this).remove();
				}
			});
			
			if($("#"+idx).length>0){
				$("#"+idx).hide().remove();
				return false;
			}else{
				$(this).after("<div class='div-reply data_"+idx+"' id='"+idx+"' style='height:500px'>");
				$('.div-reply').load($(this).attr("rel"));
			}
		});
	});
</script>



