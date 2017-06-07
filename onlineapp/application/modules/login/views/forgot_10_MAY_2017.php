<body class="bg-primary phub-theme">


<?php
$tmp=base_url().'asset/gps1.jpg';


?>
	<div class="cover" style="background:#000;background-image:url(<?php echo "'".$tmp."'";?>);"></div>


<style>
.bg-primary {
   color: #515e72 !important; 
   
}

</style>


    <div class=""></div>




    <div class="center-wrapper ng-scope" data-ng-app="phubapp">
        <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
                <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-3 col-md-1 col-md-offset-4">
                <img src="http://www.payehub.com/img/logo.png" alt="" class="portal-logo">
               <!-- <img src="<?php echo base_url();?>asset/portal-logo.png" alt="" class="portal-logo">-->
                </div>
				
				
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				
                    <section class="panel bg-white no-b" >
                        <ul class="switcher-dash-action">
                            <li><a href="<?php echo base_url();?>login" class="selected">Sign in</a>
                            </li>
                            <li class="active"><a href="#" class="">Forgot Password</a>
                            </li>
                        </ul>
                        <div class="p15">
                        <div class="alert-success"><center><?php if($this->session->flashdata('lostpwd')) echo $this->session->flashdata('lostpwd');?></center></div>
						<div class="alert-danger"><center><?php if($this->session->flashdata('emailnotfound')) echo "Email doesn't exist!";?></center></div>
				
                            <p class="text-center"><font color="#67A2C8">Enter your email address. You will receive a link to reset your password.

</font></p>
                            <!-- form role="form" name="phubfrm" action="<?php //echo base_url();?>login/vemail" method="post" class="ng-pristine ng-valid-email ng-invalid ng-invalid-required" -->
                            
                            
                            <?php echo form_open('login/vemail', array('role'=>"form",'name'=>"phubfrm", 'method'=>"post", 'class'=>"ng-pristine ng-valid-email ng-invalid ng-invalid-required")); ?>
                                
                                <input name="user_name" class="form-control input-lg ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" data-ng-model="frm.username" required="" placeholder="Email address" autofocus="" type="email">
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.email">
			<li class="parsley-required">Not a valid email</li>
		</ul>
		
		
                                <button class="btn btn-primary btn-lg btn-block mt25" type="button" data-ng-click="submit(phubfrm)">Submit</button>
                            <!-- </form> -->
                            <?php echo form_close();?>
                        </div>
                    </section>
           <script>
$("input").keypress(function(event) {
    if (event.which == 13) {
       event.preventDefault();
        $("button").click();
    }
});
</script>         