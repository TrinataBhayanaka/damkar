<div style="height:135px; background-color:#eee">
    <div class="container" style="font-size:medium; height:135px; background:url(assets/image/sub_header_bg.png) left center no-repeat">
    	<h1>News</h1>
    </div>
</div>
<!--<div class="container" style="font-size:medium">

      <h3 class="sub">ESIRS</h3>
      Discover how Blackboard can help you transform the educational experience within every step of the student lifecycle. Get the technology and expertise you need to meet your institution's goals.
</div>-->
<div class="container" style="margin-bottom:20px">
<div class="row-fluid">
<div class="span8">
    <div class="row-fluid">
        <div class="span11">
          <h3 class="sub" style="border-bottom:2px solid #9e2525">Index</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span11">
          <?php if (is_array($news_list)) { ?>
          <?php 
		  	foreach($news_list as $k=>$v) { 
		  		$image = ($v['news_image'])?$v['news_image']:"blank.png";
		  ?>
          <!--media-->
          <div class="media ">
            <div class="pull-left" style="width:70px">
                <img src="assets/image/news/<?=$image;?>" class="avatar media-object" alt="2013" style=" width:65px;height:65px;margin:1px" />
            </div>   
            <div class='media-body'>
                <div class="pull-right" style="color:grey"> <i class="icon-time"></i> <?=$v['date_formatted'];?></div>
                <div>
                    <h5 class="media-heading"><?=$v['title'];?></h5>
                    <div><?=$v['news_clip'];?>...</div>   
                    <a href="news/<?=$v['idx'];?>/<?=str_replace(" ","_",$v['title']);?>" class="news">read more &raquo;</a>                   
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
            <div class="pull-right"><?=$perpage;?></div>
            <div class="pull-right">Rows/page: </div>
        </div>
</div><!--end span8-->
<div class="span4">
  <h3 class="sub" style="border-bottom:0px solid #9e2525">Submit</h3>
	<div class="alert alert-error">
  <p>Accident or incident notification Submit online and phone</p>
  <p><a class="btn btn-danger" href="#">Submit &raquo;</a></p>
</div>  
  
     <ul class="nav nav-tabs nav-stacked" style="font-size:large">
        <li><a href="#"><i class="icon-ban-circle "></i> Confidential Report</a></li>
        <li><a href="#"><i class="icon-eye-open"></i> Safety Watch</a></li>
        <li><a href="#"><i class="icon-globe"></i> Peta Interaktif</a></li>
    </ul>
    <br />
 	<img src="assets/image/contact.png" /><br />
</div>
</div>

</div>
