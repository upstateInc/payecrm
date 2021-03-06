<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">     
 	
		<div class="form-group">
			<label for="exampleInputEmail1">Module Name</label>
			<input type="text" class="form-control" id="module" name="module" placeholder="Module Name" value="" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Parent</label>
			<select class="form-control" id="parent" name="parent" required>
				<option value="0">Root</option>
				<?php
					$getModules=$this->db->query("select id, module from ".MODULE." where status='Y'");
					foreach($getModules->result() as $val){ ?>				
						<option value="<?php echo $val->id;?>"><?php echo $val->module;?></option>
					<?php	
					}
				?>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Weightage</label>
			<input type="text" class="form-control" id="weightage" name="weightage" placeholder="Module Weightage" value="" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Link</label>
			<input type="text" class="form-control" id="moduleLink" name="moduleLink" placeholder="Module Link" value="" >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Description</label>
			<input type="text" class="form-control" id="moduleDesc" name="moduleDesc" placeholder="Module Description" value="" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Image Class</label>
			<input type="text" class="form-control" id="imageClass" name="imageClass" placeholder="Module Image Class" value="" required>
		</div>	

		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" >Active</option>
				<option value="N" >In-Active</option>
			</select>
		</div>
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
		
		
		
		
		
		
		
		
		