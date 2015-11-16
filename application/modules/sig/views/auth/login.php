<? if ($status==1) { ?>
<script>window.location.href='<?=BASE_URL;?>ctrl/';</script>
<? } else if ($status==2) { ?>
<script>window.location.href='<?=BASE_URL;?>ctrl/auth';</script>
<? } ?>