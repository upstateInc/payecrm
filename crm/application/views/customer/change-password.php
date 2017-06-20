<?php $this->load->view('admin/header'); ?>
<ol class="breadcrumb">
	<li><a href="<?php echo base_url().'admin/dashboard'?>">Dashboard</a></li>
    <li class="active">Administrator/Change Password</li>
</ol>

<div style="margin-top:80px; margin-bottom:100px;" class="row">
	<div class="col-md-8 col-md-offset-2">
	
			<?php
			if($this->session->flashdata('message_error')!="")
			{
			?>
              <div class="alert alert-danger msg_error"><strong><?php echo $this->session->flashdata('message_error'); ?></strong></div>
            <?php
			}
			if($this->session->flashdata('message_success')!="")
			{
			?>
              <div class="alert alert-success msg_success"><strong><?php echo $this->session->flashdata('message_success'); ?></strong></div>
            <?php
			}
			?>
	
	<script language="javascript">
			$(document).ready(function(){
				$("#frm_admin_user").validate({
					rules: {
						old_password: { 
							required: true,
							minlength: 5
						},
						password: {
							required: true,
							minlength: 5
						},
						cpassword: { 
							equalTo: "#password"
						}
					},
					messages: {
						old_password: { 
							required: "<br>Please provide current password." ,
							minlength: "<br>Password should be minimum of 5 characters."
						},
						password: {
							required: "<br>Please provide new password.",
							minlength: "<br>Admin password should be minimum of 5 characters."
						},
						cpassword: { 
							equalTo: "<br>Please confirm admin password."
						}
					}						
				});
			});
		</script>
	
    	<div style="text-align:left;" class="well well-sm"><strong><i class="fa fa-check"></i> Required Field</strong></div>
        <form class="form-horizontal" id="frm_admin_user" name="frm_admin_user" method="post" action="<?=base_url().$this->viewfolder.'update-password'?>">                   
				<div class="form-group">
                <label class="col-md-3 control-label">Old Password:</label>
                <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-check"></i></div>
				  <input id="old_password" name="old_password" placeholder="Old Password" required="true" type="password" class="form-control" value="" />
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">New Password:</label>
                <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-check"></i></div>
				  <input id="password" name="password" placeholder="New Password" required="true" type="password" class="form-control" value="" />
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Confirm Password:</label>
                <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-check"></i></div>
				  <input id="cpassword" name="cpassword" placeholder="Confirm Password" required="true" type="password" class="form-control" value="" />
                </div>
                </div>
              </div>
               <div class="form-group">
                <div class="col-md-9 col-sm-offset-3 pull-right">
				<input name="change_id" type="submit" class="btn btn-default" value="Submit" />         
                </div>
              </div>
        </form>
        
    </div>
</div>

<!--table id="tbl_content_area" width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td height="1px"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF" style="border:1px dotted #999999;" height="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
        <tr>
          <td style="width:75%;" valign="top" align="center">
            <?php
			if($this->session->flashdata('message_error')!="")
			{
			?>
          	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="msg_error"  >
            <tr>
              <td><?php echo $this->session->flashdata('message_error'); ?></td>
            </tr>
            </table>
            <?php
			}
			if($this->session->flashdata('message_success')!="")
			{
			?>
            <table width="100%" border="0" cellpadding="5" cellspacing="0" class="msg_success"  >
            <tr>
              <td><?php echo $this->session->flashdata('message_success'); ?></td>
            </tr>
            </table>
            <?php
			}
			?>
            <table width="90%" border="0" cellspacing="0" cellpadding="0" style="margin-top:40px;">
              <tr>
                <td width="110" class="td_tab_main" align="center" valign="middle">Change Password</td>
                <td align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
            <table width="90%" border="0" cellspacing="0" cellpadding="10" style="border:1px solid #999999;">
              <tr>
                <td align="center" valign="middle">
                	<script language="javascript">
						$(document).ready(function(){
							$("#frm_admin_user").validate({
								rules: {
									old_password: { 
										required: true,
										minlength: 5
									},
									password: {
										required: true,
										minlength: 5
									},
									cpassword: { 
										equalTo: "#password"
									}
								},
								messages: {
									old_password: { 
										required: "<br>Please provide current password." ,
										minlength: "<br>Password should be minimum of 5 characters."
									},
									password: {
										required: "<br>Please provide new password.",
										minlength: "<br>Admin password should be minimum of 5 characters."
									},
									cpassword: { 
										equalTo: "<br>Please confirm admin password."
									}
								}						
							});
						});
					</script>
                	<form id="frm_admin_user" name="frm_admin_user" method="post" action="<?=base_url().$this->viewfolder.'update-password'?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="7">
                      <tr>
                        <td width="140" align="right" valign="middle" class="field_title"><span style="color:#8B0000;">*</span>&nbsp;<strong>Old Password : </strong></td>
                        <td align="left" valign="middle"><input id="old_password" name="old_password" type="password" class="textfield" style="width:200px;" value="" /></td>
                      </tr>
                      <tr>
                        <td width="140" align="right" valign="middle" class="field_title"><span style="color:#8B0000;">*</span>&nbsp;<strong>New Password : </strong></td>
                        <td align="left" valign="middle"><input id="password" name="password" type="password" class="textfield" style="width:200px;" value="" /></td>
                      </tr>
                      <tr>
                        <td width="140" align="right" valign="middle" class="field_title"><span style="color:#8B0000;">*</span>&nbsp;<strong>Confirm Password : </strong></td>
                        <td align="left" valign="middle"><input id="cpassword" name="cpassword" type="password" class="textfield" style="width:200px;" value="" /></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="7">
                      <tr>
                        <td width="140" align="right" valign="middle">&nbsp;</td>
                        <td width="80" align="left" valign="middle"><input name="bttn" id="bttn" type="submit" class="button" value="Submit" /></td>
                        <td align="left" valign="middle">&nbsp;</td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="1px;"></td>
  </tr>
</table-->
<?php $this->load->view('admin/footer'); ?>