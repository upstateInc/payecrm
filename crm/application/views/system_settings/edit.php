<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />   
      	<div class="form-group">
			<label for="exampleInputEmail1"><strong>Max Sale Allowed</strong>*</label>
			<input type="number" step="any" class="form-control" id="SYSTEMMAXSALESALLOWED" name="SYSTEMMAXSALESALLOWED" placeholder="Max Sale Allowed" required="required" value="<?php echo $query['SYSTEMMAXSALESALLOWED'];?>">
		</div>         

		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Echecking Allowed</strong>*</label>
			<select class="form-control" id="ECHECKINGALLOWED" name="ECHECKINGALLOWED" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['ECHECKINGALLOWED']=="Y"){?> selected="selected"<?php } ?> >Y</option>
				<option value="N" <?php if($query['ECHECKINGALLOWED']=="N"){?> selected="selected"<?php } ?> >N</option>
			</select>
		</div>
  
      	<div class="form-group">
			<label for="exampleInputEmail1"><strong>Authorized Sale Amount</strong>*</label>
			<input type="number" step="any" class="form-control" id="AuthorizedSaleAmount" name="AuthorizedSaleAmount" placeholder="Authorized Sale Amount" required="required" value="<?php echo $query['AuthorizedSaleAmount'];?>">
		</div>

      	<div class="form-group">
			<label for="exampleInputEmail1"> <strong>Search Limit (Customer Support)</strong>*</label>
			<input type="number" class="form-control" id="searchLimit" name="searchLimit" placeholder="Search Limit" required="required" value="<?php echo $query['searchLimit'];?>">
		</div>      	
		<div class="form-group">
			<label for="exampleInputEmail1"> <strong>New Toll Free Support No.</strong>*</label>
			<input type="text" class="form-control" id="newTollFreeNo" name="newTollFreeNo" placeholder="New Toll Free Support No." required="required" value="<?php echo $query['newTollFreeNo'];?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Autorize Page Order</strong>*</label>
			<select class="form-control" id="order_by" name="order_by" required="required">
				<option value="">Select</option>
				<option value="asc" <?php if($query['order_by']=="asc"){?> selected="selected"<?php } ?> >ASC</option>
				<option value="desc" <?php if($query['order_by']=="desc"){?> selected="selected"<?php } ?> >DESC</option>
			</select>
		</div> 
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Mid Selection</strong>*</label>
			<select class="form-control" id="Mid_Selection" name="Mid_Selection" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['Mid_Selection']=="Y"){?> selected="selected"<?php } ?> >High Transactions Balance</option>
				<option value="N" <?php if($query['Mid_Selection']=="N"){?> selected="selected"<?php } ?> >High Transactions Split</option>
			</select>
		</div>		
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
      
		<?php $this->load->view('footer');?>