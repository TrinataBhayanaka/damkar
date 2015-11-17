<div class="box">
            <div class="box-header">
                <h2><i class="icon-link"></i>&nbsp; Links</h2>
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
                      <li style="list-style:none">
                        <div class="media" style="padding-bottom:0px; margin-top:5px">
                                <div class="pull-right" style="color:grey"><small><?=$v['date_formatted'];?></small></div>
                            <div class="pull-left" style="width:135px" title="Category">
                                <small><?=$v['category_name'];?></small>
                            </div>  
                            <div class="pull-left" style="width:35px">
                                <img src="assets/image/pages/<?=$image;?>" class="avatar media-object" alt="<?=$v['image_title'];?>" style=" width:30px;height:30px;margin:1px" />
                            </div>   
                            <div class="pull-left" style="width:35px" title="Num of Click">
                                <?=intval($v['click_count']);?>
                            </div> 
                            <div class='media-body'>
                                <!--<?=$category;?>-->
                                <div>
                                    <a href="admin/link_manager/edit/<?=$v['idx'];?>" class="news-title"><?=$v['name'];?></a> 
                                </div>
                            </div>
                         </div>
                    </li>
                     <!--end media-->
                     <? }} ?>
                </ul>
            </div>
            <div class="content-stat" style="">
                <a href="admin/link_manager" class="goto pull-right">View List <i class="icon-chevron-right"></i></a>
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
                        <span class="value"><?=$total_active;?></span>
                        <span class="title">Active</span>
                    </li>
                </ul>
            </div>
        </div>
