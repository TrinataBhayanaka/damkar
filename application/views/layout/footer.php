<!-- FOOTER -->
      <footer id="footer">
        

        <div class="copyright">
          <div class="container">
            &copy; Copyright 2015 Kebencanaan, All rights reserved
          </div>
        </div>
      </footer>
      <!-- /FOOTER -->

    </div>
    <!-- /wrapper -->

    <!-- SCROLL TO TOP -->
    <a href="#" id="toTop"></a>

  </body>
</html>
<script>
$(document).ready(function () {
  var act_link="<?=$this->page_active?>";
  $(".nav-main>li").find('a[href="'+act_link+'"]').parents("li").addClass("active");
  
  $("#q_button").click(function(){
    $("#search_form").submit();
  });
});
</script>