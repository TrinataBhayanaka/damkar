<div class="subheader">
    <div class="container subheader-inner">
    	<h1>Articles</h1>
    </div>
</div>
<div class="container" style="margin-bottom:20px">

<div class="row-fluid">
<div class="span8 content-page">
    	<ul class="breadcrumb" style="margin-left:0; margin-top:-10px">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="articles">Articles</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

    <div class="row-fluid">
        <div class="span12">
          <h3 class="sub" style="border-bottom:2px solid #aaa">Index</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
          <?php if (is_array($news_list)) { ?>
          <?php 
		  	foreach($news_list as $k=>$v) { 
		  		$image = ($v['image'])?$v['image']:"blank.png";
				$others = preg_split("/#/",$v['others']);
				$author = str_replace("Author: ","",$others[0]);
				$ref = str_replace("Reference/Source : ","",$others[1]);
				$author = ($others[0])?', '.$others[0]:'';
		  ?>
          <!--media-->
          <div class="media ">
            <div class="pull-left" style="width:130px">
                <img src="assets/image/pages/<?=$image;?>" class="avatar media-object" alt="2013" style=" width:120px;height:120px;margin:1px" />
            </div>   
            <div class='media-body'>
                <div class="pull-left" style="color:grey"> <i class="icon-time"></i> <?=$v['date_formatted'];?><?=$author;?></div><br />
                <div>
                    <h5 class="media-heading"><a href="articles/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
            	
                    <div><?=$v['clip'];?>...</div>   
                    <a href="articles/read/<?=$v['idx'];?>" class="news">read more &raquo;</a>                   
                </div>
            </div>
         </div>
         <!--end media-->
         <? }} ?>
      </div>
    </div>
    <br />
	<div class="table-nav table-nav-border-top">
			<div class="pull-left text">Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries</div>            
            <div class="pull-right"><?=$paging;?></div>
            <!--<div class="pull-right"><?=$perpage;?></div>
            <div class="pull-right">Rows/page: </div>-->
        </div>
</div><!--end span8-->
<div class="span4 right-page">
  <!-- AddThis Button BEGIN --
    <div class="addthis_toolbox addthis_default_style" style="width:350px; margin-bottom:50px">
    <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4d9b20db5979ef32" class="addthis_button_compact">Share</a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_5"></a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_facebook_like" fb:like:action="recommend" fb:like:layout="button_count"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4d9b20db5979ef32"></script>
    !-- AddThis Button END -->
	<div style="height:15px"></div>
	<? modules::load('wg/web')->incident();?>
    
    <? modules::load('wg/web')->news_pages();?>
</div>
</div>

</div>
