<?php if (is_array($list)) { 

  foreach($list as $k=>$v) { 
    $image = ($v['image'])?$v['image']:"blank.png";
    $category = ($v['category']==2)?'<small><span class="label label-important">Pengumuman</span></small>':'';
?>
  <div class="row tab-post"><!-- post -->
    <div class="col-md-3 col-sm-3 col-xs-3">
      <a href="articles/read/<?=$v['idx'];?>">
        <img src="assets/image/pages/<?=$image?>" width="50" height="50" alt="" />
      </a>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-9">
      <a href="articles/read/<?=$v['idx'];?>" class="tab-post-link"><?=$v['title'];?></a>
      <small><?=$v['date_formatted'];?></small>
    </div>
  </div><!-- /post -->

<? }} ?>