<?php
		$getModuleName=str_replace("_","-",$this->router->fetch_class());
		//echo $getModuleName;
		$getModulePermissionDetails = $this->db->query("select a.id as moduleId, a.module, a.parent, a.weightage, a.moduleLink, a.moduleDesc, a.imageClass
			from t_module as a 
			left join t_moduleAction as b on a.id = b.moduleId 
			left join t_action as c on b.actionId=c.id 
			left join t_adminModuleAction as d on b.id=d.moduleActionId 
			where 
			a.status='Y' and 
			b.status='Y' and 
			c.status='Y' and 
			d.status='Y' and 
			d.adminTypeId='".$this->session->userdata('ADMINTYPE')."' and 
			d.adminLevelId='".$this->session->userdata('ADMINLEVEL')."' and 
			b.actionId='1' and
			a.moduleLink='".$getModuleName."'
			order by a.weightage asc
		");
		//print_r($getModulePermissionDetails);
		//$this->db->last_query();
		/*if($getModulePermissionDetails->num_rows() < 1){
			redirect(base_url().'dashboard');	 
		}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CRM</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url();?>fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url();?>css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="<?php echo base_url();?>css/icheck/flat/green.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/nprogress.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
			
				<a href="<?php echo base_url();?>" class="site_title"><img src="<?php echo base_url();?>images/logo.png" alt=""> <span>Payehub CRM</span></a>

          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
			<?php if($this->session->userdata('ADMIN_IMG')==""){?>
              <img src="<?php echo base_url();?>images/profile.png" alt="..." class="img-circle profile_img">
						<?php }else { ?>
				<a href="<?php echo base_url();?>" class="site_title"><img src="<?php echo base_url().FLD_PROFILE_IMAGE.'thumb/'.$this->session->userdata('ADMIN_IMG');?>" alt=""> <span>Payehub CRM</span></a>				
			<?php } ?>  
            </div>
            <div class="profile_info">
              <span><?php echo $this->session->userdata('ADMIN_FNAME').' '.$this->session->userdata('ADMIN_LNAME');?></span>
              <!--h2>Dev</h2-->
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
			<?php $this->load->view('menu');?>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <!--<div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div> -->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <?php /*if($this->session->userdata('ADMIN_IMG')==""){?>
					<img src="<?php echo base_url();?>images/profile.png" alt="..." >
				<?php }else { ?>
					<a href="<?php echo base_url();?>" class="site_title"><img src="<?php echo base_url().FLD_PROFILE_IMAGE.'thumb/'.$this->session->userdata('ADMIN_IMG');?>" alt=""></a>				
				<?php }*/ ?>
				  <!--img src="<?php echo base_url();?>images/profile.png" alt=""-->Settings
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  
                  <li><a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <!--a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a-->
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/profile.png" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>WDevelopers</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/profile.png" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>WDevelopers</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/profile.png" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>WDevelopers</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/profile.png" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>WDevelopers</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->


      <!-- page content -->
      <div class="right_col" role="main">
      
      <div class="page-title" style="border-bottom:1px solid #CCC;">
              <div class="">
					<div class="col-md-3 col-sm-12 col-xs-12">
					<?php 
						$moduleQuery=$this->db->query("select * from t_module where moduleLink='".$getModuleName."'")->row();						
					?>
                	<h3><?php echo $moduleQuery->module; 
						if ($this->router->method!='index'){
							if ($this->router->method=='pop'){
								echo ' - View'; 
							}else{
								echo ' - '.ucfirst(str_replace('_', ' ',$this->router->method)); 
							}
						}
						?>
					</h3>
                 </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                    <div id="msgDiv" class="alert alert-success fade in" style="display:none;">
                    </div>
                    <div id="errMsgDiv" class="alert alert-danger" style="display:none;">
                    </div>
                 </div> 
                 <div class="col-md-3 col-sm-12 col-xs-12">
                	<h3>&nbsp;</h3>
                 </div> 
              </div><div class="clearfix"></div>
              </div>
		<script type="text/javascript">
			jQuery( document ).ready(function() {
				/*jQuery(".<?php echo $this->namefile;?>").addClass("active");*/
				$('#msgDiv').delay(5000).fadeOut('slow', function() {})
				$('#errMsgDiv').delay(5000).fadeOut('slow', function() {})
				$("form").submit(function(){
					$("#msgDiv").show("");
					$('#msgDiv').html('Request Sent..Waiting For Response. Please be patient.');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {})
				});
				$( "[name='select_report']" ).change(function() {
					$("#msgDiv").show("");
					$('#msgDiv').html('Request Sent..Waiting For Response. Please be patient.');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {})
				});
				$( ".table" ).addClass( "table-striped table-bordered table-hover .table-condensed" );
			});
		</script> 