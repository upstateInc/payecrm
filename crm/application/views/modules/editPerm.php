<?php
$thisaction = array();
foreach($thisModuleAction as $k=>$v)
{
	$thisaction[] = $v->actionId;
}
$thepermission = array();
foreach($modulePermissions as $k=>$v)
{
	$thepermission[] = $v->actionId.'-'.$v->adminLevelId.'-'.$v->adminTypeId;
}

#echo "<pre>"; print_r($thepermission); exit;
?>

<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>editPermUpdate" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $obj_module['id']; ?>" />
		<div class="form-group">
			<label for="exampleInputEmail1">Module Actions</label>
			<br/>
<?php 
foreach($Actions as $valAction): 
?>
					<input type="checkbox" name="action[]" value="<?php echo $valAction->id;?>" <?php if(in_array($valAction->id, $thisaction)) echo "checked";?> />&nbsp;<?php echo $valAction->action;?><br/>
<?php
	foreach($AdminLevels as $k=>$adminLevel):
		echo $adminLevel->level.'<br/>';
		
		foreach($AdminTypes as $adminType): ?>
			<label><input type="checkbox" name="permission[]" value="<?php echo $valAction->id;?>,<?php echo $adminLevel->id;?>,<?php echo $adminType->id;?>" <?php if(in_array($adminLevel->id.'-'.$adminLevel->id.'-'.$adminType->id, $thepermission)) echo "checked";?> />
			<?php
				echo $adminType->type.'&nbsp;&nbsp;&nbsp;</label>';
		endforeach;
		echo '<br/>';
	endforeach;
	echo '<br/>';
endforeach; 
?>
			
		</div>		
		
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		