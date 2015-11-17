<div class="box">
            <div class="box-header">
                <h2><i class="icon-folder-close-alt"></i>&nbsp; Latest Articles</h2>
                <!--<div class="box-icon">
                    <a href="widgets.html#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                    <a href="widgets.html#" class="btn-close"><i class="icon-remove"></i></a>
                </div>-->
            </div>
            <div class="box-content">
                <ul class="dashboard-list" style="margin-left:0">
                	<?php if (is_array($list)) { ?>
					  <?php 
                        foreach($list as $k=>$v) { 
                            $image = ($v['image'])?$v['image']:"blank.png";
                            $category = ($v['category']==2)?'<small><span class="label label-important">Pengumuman</span></small>':'';
                      ?>
                      <!--media-->
                      <li style="list-style:none;">
                        <div class="media" style="padding-bottom:0px; margin-top:5px">
                                <div class="pull-right" style="color:grey"><small><?=$v['date_formatted'];?></small></div>
                            <div class="pull-left" style="width:35px">
                                <img src="assets/image/pages/<?=$image;?>" class="avatar media-object" alt="<?=$v['image_title'];?>" style=" width:30px;height:30px;margin:1px" />
                            </div>   
                            <div class='media-body'>
                                <!--<?=$category;?>-->
                                <div>
                                    <a href="admin/articles/edit/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a>
                                </div>
                            </div>
                         </div>
                    </li>
                     <!--end media-->
                     <? }} ?>
                </ul>
            </div>
            <div class="content-stat" style="">
                <a href="admin/articles" class="goto pull-right">View List <i class="icon-chevron-right"></i></a>
                <ul class="inline">
                    <li>
                        <span class="value"><?=$total;?></span>
                        <span class="title">Total</span>
                    </li>
                    <li>
                        <span class="value"><?=$total_published;?></span>
                        <span class="title">Published</span>
                    </li>
                    <li>
                        <span class="value"><?=$total_comments;?></span>
                        <span class="title">Comments</span>
                    </li>
                </ul>
            </div>
        </div>
