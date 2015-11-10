<!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
      <script>
         /* scroll to top when clicked on navbar */
         $(".navbar > .container").on("click", function(e){
         $('html,body').animate({scrollTop:0},'slow');
         });
         /* brand logo click */
         $(".navbar-brand").on("click",function(){
         $("#home").addClass("active").siblings().removeClass("active");
         $("#tabs > li").removeClass("active");
         });
         /* make list-group selectable */
         $(".list-group>a").on("click", function(){
         $(this).addClass("active").siblings().removeClass("active");
         });
         /* auto select list-group item on scroll */
         $(document).scroll(function(){
         $('.section').each(function(){
         var position = $(document).scrollTop() - $(this).offset().top;
         if(position < 30 && position > -115) {
         $($('a[href$='+$(this).attr("id")+']')).click();
         }
         });
         });
         /* set hash on tab select */
         $('#tabs a').click(function() {
         window.location.hash = $(this).attr("href");
         $(document).scrollTop(0);
         $(".list-group > a").removeClass("active");
         });
         $(document).ready(function(){
         if(window.location.hash !== ""){
         /* open tab based on hash value */
         if($('#tabs > li > a[href="'+window.location.hash+'"]').length){
         $('#tabs > li > a[href="'+window.location.hash+'"]').tab('show');
         setTimeout(function(){$(document).scrollTop(0)}, 200);
         }
         /* open tab and section based on hash value */
         if($('.list-group > a[href="'+window.location.hash+'"]').length){
         var tab = $('.list-group > a[href="'+window.location.hash+'"]').closest(".tab-pane").attr("id");
         $('a[href="#'+tab+'"]').tab('show');
         $('.list-group > a[href="'+window.location.hash+'"]').click();
         setTimeout(function(){$(document).scrollTop($(window.location.hash).offset().top)}, 200);
         }
         }
         });
      </script>
   </body>
</html>