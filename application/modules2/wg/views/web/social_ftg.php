<? $url = 'http://'.$_SERVER['HTTP_HOST'];  $uri=$_SERVER['REQUEST_URI']; ?>
<? $style = 'padding:20px 0 15px' ?>
	<div class="clearfix" style="background:transparent; border-top:1px solid #ccc; <?=$style?> ">
		<div style="margin-top:5px; width:110px" class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>        
        <a class="twitter-share-button"
          href="https://twitter.com/share">
        Tweet
        </a>
        <script>
        window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
        </script>
        <div class="g-plusone" data-size="medium"></div>
    </div>