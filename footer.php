

	<!-- Footer -->
   <footer>
      <div class="container">
      <div class="row">
        <div class="col-sm-4 copyright">
     
            Copyright 2017 -<strong> &copy; PayeCRM</strong> &nbsp;&nbsp; |  &nbsp;&nbsp; All Rights Reserved 
            
           
        </div>
          <div class="col-sm-7 flink">
           <a href="faq.php">Faq's</a> |  
           <a href="terms-of-service.php">Terms of Service</a> | 
           <a href="privacy-statement.php">Privacy Statement</a> |
           <a href="request-demo.php">Request Demo</a> |
           <a href="sitemap.php">Sitemap</a> |
           <a href="contact-us.php">Contact Us</a>
          </div>
      </div>  <!-- / .row -->
    </div>
    </footer>

    <!-- Copyright -->
     <!-- / .container -->   


    <!-- JavaScript
    ================================================== -->
<!-- JS Global -->
    <script src="build/js/jquery.min.js"></script>
    <script src="build/js/bootstrap.min.js"></script>
    <script src="build/js/range-slider.js"></script>
    
    <!-- JS Plugins -->
    <!--<script src="build/js/scrolltopcontrol.js"></script>-->
    
	<script>
    $(function() {
      $('#demo').submit(function(event) {
        var form = $(this);
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: form.serialize()
        }).done(function() {
          // Optionally alert the user of success here...
		  $('#DemoModalDiv').modal('hide');
		  alert('We have received your request and we will get back to you soon');
		  
        }).fail(function() {
          // Optionally alert the user of an error here...
		  alert('error');
        });
        event.preventDefault(); // Prevent the form from submitting via the browser.
      });
    });
    </script>

  </body>

<!-- Mirrored from www.checkcrm.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Apr 2017 10:20:47 GMT -->
</html>