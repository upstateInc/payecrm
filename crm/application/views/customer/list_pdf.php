<table id="tbl_content_area" width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr><td height="1px"></td></tr>
	<tr>
      <td align="center" valign="middle" bgcolor="#FFFFFF" style="border:1px dotted #999999;" height="100%">
	  	 <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
		  <tr>
            <td style="width:100%;" valign="top" align="left">
                <div class="sub_heading">
                    <table width="100%">
                        <tr>
                          <td align="left" style="padding-top:10px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="td_tab_main" width="171" align="center">
                                            List of <?php echo $list_title; ?></td>
                                        <td width="173"></td>
                                        <td width="611" align="right" valign="middle">&nbsp;</td>
                                    </tr>
                              </table>
                              <table width="100%" style="border: 1px solid rgb(153, 153, 153);" cellpadding="3" cellspacing="0" >
                                  <tr>
                                      <td width="10%" align="left"  class="td_tab_main" style="padding-left:0px;">
                                          Name
                                      </td>
									  <td width="10%" align="left" class="td_tab_main" style="padding-left:0px;">
                                          Type
                                      </td>
                                      <td width="20%" align="left"  class="td_tab_main" style="padding-left:0px;">
                                          Email
                                      </td>
									  <td width="15%" align="left"  class="td_tab_main" style="padding-left:0px;">
                                          Country
                                      </td>
									  <td width="10%" align="left"  class="td_tab_main" style="padding-left:0px;">
                                          Student Type
                                      </td>
                                      <td width="10%" align="left" class="td_tab_main" style="padding-left:0px;">
                                          Username
                                      </td>
                                      <td width="10%" align="left" class="td_tab_main" style="padding-left:0px;">
                                          Password
                                      </td>                                    
                                      <!-- <td width="10%" align="center" class="td_tab_main" style="padding-left:0px;">
                                          Active
                                      </td> -->
                                  </tr>
								  <?php
								   if($query_users->num_rows()>0)
								   {
									   foreach($query_users->result() as $row_users)
                            		   {
								   ?>
									<tr>
                                      <td align="left" class="columnDataGrey"><?php echo $row_users->name; ?></td>
                                      <td align="left" class="columnDataGrey"><?php echo ucwords($row_users->type); ?></td>
                                      <td align="left" class="columnDataGrey"><?php echo $row_users->email; ?></td>
									  <td align="left" class="columnDataGrey"><?php echo $row_users->printable_name; ?></td>
									   <td align="left" class="columnDataGrey"><?php if($row_users->course=='fulltime'){ echo "Full Time";}else{ echo "Part Time"; } ?></td>
									  <td align="left" class="columnDataGrey"><?php echo $row_users->username; ?></td>
									  <td align="left" class="columnDataGrey">
									  <?php 
										  $pw = $row_users->password;
											for($i=0;$i<2;$i++){
											$pw = base64_decode($pw);
											} echo $pw;?>
									  </td>
                                      <!-- <td align="center" class="columnDataGrey">
									  <?php 
									  if($row_users->status == '1') echo "Yes"; 
									  else echo "No";
									  ?>
                                      </td> -->
                                  </tr>
                                 <?php
									   }
								   }
								   else
								   {
								   ?>
                                  <tr>
                                    <td align="center" colspan="7">
                                        No admin users found
                                    </td>
                                  </tr>
                                 <?php
								   }
								   ?>
                                 
                              </table>
                            </td>
                    </tr>
                </table>
                </div>
            </td>
		  </tr>
		 </table>
	  </td>
    </tr>
	<tr><td height="1px;"></td></tr>
  </table>
