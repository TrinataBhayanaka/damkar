<!--<div class="row-fluid">
<div class="span12">
<h4 class="heading">List Komentar</h4>
<ul>
	<?php foreach($arrData as $x=>$val):?>
    	<li><?=$val["name"]?>: <?=$val["body"]?> <a href="#" class="comments_reply" rel="<?=$this->module?>comments_reply/<?=$val["idx"]?>">Reply</a></li>
    <?php endforeach;?>
</ul>
</div></div>-->

<style>

.comment .media img {
    height: 54px;
    position: relative;
    top: 3px;
    width: 54px;
}
.comment h4.media-heading {
    position: relative;
}
.comment h4.media-heading span {
    color: #777777;
    font-size: 12px;
    position: absolute;
    right: 0;
    top: 3px;
}
.comment h4.media-heading span a {
    color: #72C02C;
}


</style>

<div class="row-fluid">
<div class="span12">
<div class="comment">
<?=message_box();?>
<?=$comment_list?>
</div>
</div></div>

<? /*
<div class="comment">
<h3 class="color-green">Comments</h3>
<div class="media">
            	<a href="#" class="pull-left">
                    <img alt="" src="assets/img/sliders/elastislide/2.jpg" class="media-object">
                </a>
                <div class="media-body">
                <h4 class="media-heading">Media heading <span>5 hours ago / <a href="#">Reply</a></span></h4>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

                    <hr>

                    <!-- Nested media object -->
                    <div class="media">
                        <a href="#" class="pull-left">
                            <img alt="" src="assets/img/sliders/elastislide/5.jpg" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading <span>17 hours ago / <a href="#">Reply</a></span></h4>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        </div>
                    </div><!--/media-->

                    <hr>

                    <div class="media">
                        <a href="#" class="pull-left">
                            <img alt="" src="assets/img/sliders/elastislide/11.jpg" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading <span>2 days ago / <a href="#">Reply</a></span></h4>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        </div>
                    </div><!--/media-->
                </div>
            </div>
</div>*/
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
				$(this).closest('div').find(".comments-body:first").after("<div class='div-reply data_"+idx+"' id='"+idx+"' style='height:500px'>");
				$('.div-reply').load($(this).attr("rel"));
			}
		});
	});
</script>