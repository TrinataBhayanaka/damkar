<?php if (is_array($footer_link_list)) { ?>
<?php foreach($footer_link_list as $k=>$v) { ?>
<li class="list-group-item"><a href="linkdir/get_link/<?=$v['idx'];?>" target="_blank"> <?=$v['name'];?></a></li>
<?php }} ?>
