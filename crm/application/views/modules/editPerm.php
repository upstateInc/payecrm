<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />
		<div class="form-group">
			<label for="exampleInputEmail1">Module Actions</label>
			<br/>
			<?php 
				$getActions=$this->db->query("select * from t_action where status='Y'");
				foreach($getActions->result() as $valAction){ ?>
					<input type="checkbox" name="action[]" value="<?php echo $valAction->id;?>"/><?php echo $valAction->action;?><br/>
					
					<?php
					$getAdminLevels=$this->db->query("SELECT * FROM t_adminLevel where status='Y'");
					foreach($getAdminLevels->result() as $adminLevels){
						echo $adminLevels->level.'<br/>';
						$getAdminType=$this->db->query("SELECT * FROM t_adminType where status='Y'");
						foreach($getAdminType->result() as $adminType){ ?>
							<input type="checkbox" name="permission[]" value="<?php echo $valAction->id;?>,<?php echo $adminLevels->id;?>,<?php echo $adminType->id;?>"/>
							<?php
							echo $adminType->type.'&nbsp;&nbsp;&nbsp;';
						}
						echo '<br/>';
					}
					echo '<br/>';
					?>
				<?php
				}
			?>
			
		</div>		
		
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		