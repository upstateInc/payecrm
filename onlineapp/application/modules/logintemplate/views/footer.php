<div id="bottom-nav"></div>
<div id="footer-details"></div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$( document ).ready(function() 
{
	$('#top-navbar-container-base').load(base_url + '../header.php #base-top-bar-id');
	$('#bottom-nav').load(base_url + '../footerMain.php #bottom');
	$('#footer-details').load(base_url + '../footerMain.php #footer');
	
});

$("input").keypress(function(event) 
{
    if (event.which == 13) 
	{       
        $("button").click();
    }
});
</script>
                 
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-29717607-1', 'auto');
  ga('send', 'pageview');
</script>
	 

<script>
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("button").click();
    }
});
</script>


</body>
</html>