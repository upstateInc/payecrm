<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
      
      <div class="row">
          <div class="col-md-9">
          	<div class="clearfix">
            <div class="pull-right"><a href="<?php echo base_url(); ?>customer/all-customers" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> List all customer</a></div>
              </div><br/>  
            
            <div class="well">
            <?php foreach ($result_customer->result() as $row){ ?>
        
                <h1><?php echo $row->name; ?> <?php  if($this->session->userdata('ADMIN_TYPE')!='teamlead'){ ?><small>Customer ID: <?php echo $row->pin; ?></small><?php } ?></h1>
                <h4>Registered By: 
                 <?php
                    foreach ($result_agent->result() as $result_agent_row)
                    {
                        if($row->agentId == $result_agent_row->id){
                        echo $result_agent_row->aliasName.' ('.$result_agent_row->name.')';
                        }
                    }
                    ?>
                </h4>
                
                <?php  if($this->session->userdata('ADMIN_TYPE')=='tech'){ ?>
                <h4>Email: <a href="javascript:;" id="email_<?php echo $this->encryption->encode($row->id); ?>" onclick="ShowEmail(this.id,'<?php echo $this->encryption->encode($row->id); ?>');">*****@****.com</a></h4>
                <?php } ?>
                
                <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                <h4>Email: <?php echo $row->email; ?></h4>
                <?php } ?>
                
                <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                <h4>Phone: <?php echo $row->phone; ?></h4>
                <?php } ?>
                
                <?php  if($this->session->userdata('ADMIN_TYPE')=='tech'){ ?>
                <h4>Phone: <a href="javascript:;" id="phn_<?php echo $this->encryption->encode($row->id); ?>" onclick="ShowPhone(this.id,'<?php echo $this->encryption->encode($row->id); ?>');">*****<?php echo substr($row->phone, -5); ?></a></h4>
                <?php } ?>
                
               
             
               
                <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin' or $this->session->userdata('ADMIN_TYPE')=='tech'){ ?>
                <h4>Address: <?php echo $row->address; ?>, <?php echo $row->city; ?>, <?php echo $row->state; ?>-<?php echo $row->zip; ?>, <?php echo $row->country; ?></h4> 
                    
            <?php }} ?>
            </div>
            
           <div role="tabpanel">
           	  <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#all_invoice" aria-controls="all_invoice" role="tab" data-toggle="tab">All Invoice</a></li>
                <li role="presentation"><a href="#all_case" aria-controls="all_case" role="tab" data-toggle="tab">All Case</a></li>
              </ul>
 
            
            <div class="tab-content">
            
                <div role="tabpanel" class="tab-pane active" id="all_invoice">
                <?php if ($result_invoice->num_rows() > 0){ ?>
                <h3>All Invoice</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
                          <th>Inv. Date</th>
                          <th>Inv. ID</th>
                          <th>Sale By</th>
                          <th>Product</th>
                          <th>Sold Price</th>
                          <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                          <th>Card</th>
                          <?php } ?>
                          <th>Total Case</th>
                          <th></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($result_invoice->result() as $invoice_row){ ?>
                        
                        <tr>
                          <td>Reg Date: <?php echo date("d M y",strtotime($invoice_row->rec_crt_date)); ?>
                          <br />Exp Date:
                          <?php
                            foreach ($result_product->result() as $product_row)
                            {
                                if($invoice_row->productId == $product_row->id){
                                    
                                    if( floor($product_row->ProductSupscriptionPeriod) == 1) {
                                        echo "One time";
                                        
                                        $date = strtotime( date("Y-m-d", strtotime($product_row->rec_crt_date))) ;
                                    
                                        
                                        $date = new DateTime($invoice_row->rec_crt_date);
                                        $date->modify("+".$product_row->ProductSupscriptionPeriod." day");
                                        $expdate =  $date->format("d M y");
                                    }
                                    
                                    if( ($product_row->ProductSupscriptionPeriod) > 1) { 
                                    $date = strtotime( date("Y-m-d", strtotime($product_row->rec_crt_date))) ;
                                    
                                        
                                    $date = new DateTime($invoice_row->rec_crt_date);
                                    $date->modify("+".$product_row->ProductSupscriptionPeriod." day");
                                    echo $expdate =  $date->format("d M y");
    
    
                                        //echo $endOfCycle = date('d M y',strtotime('+'.$product_row->ProductSupscriptionPeriod.' days',$date));
                                        //echo date("d M y", strtotime("+1 year"));
                                    }
                                    
                                
                                }
                            }
                          ?>
                          
                          <?php
                          
                             $now = time(); // or your date as well
                             $customer_expire_date = strtotime($expdate);
                             
                             if($now < $customer_expire_date){
                             $datediff =  $customer_expire_date - $now;
                             echo '<span class="label label-warning">Expiring in '.floor($datediff/(60*60*24)).' Days</span>';
                             }
                             
                             if($now > $customer_expire_date){
                             echo '<span class="label label-danger">Expired</span>';
                             }
                             
                             
                          ?>
                          
                          
                          </td>
                          <td><?php echo $invoice_row->invoice_id; ?></td>
                          <td>
                            <?php
                            foreach ($result_agent->result() as $result_agent_row)
                            {
                                if($invoice_row->salesAgentId == $result_agent_row->id){
                                echo $result_agent_row->aliasName.' ('.$result_agent_row->name.')';
                                }
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            foreach ($result_product->result() as $product_row)
                            {
                                if($invoice_row->productId == $product_row->id){
                                echo $product_row->productName.' - $'.$product_row->productPrice.'';
                                }
                            }
                            ?>
                          </td>
                          <td>$<?php echo $invoice_row->grossPrice; ?></td>
                          
                          <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin' and $invoice_row->cardNo!= ''){ ?>
                          <td><?php echo str_repeat("x", (strlen($invoice_row->cardNo) - 4)). substr($invoice_row->cardNo,-4,4) ; ?></td>
                          <?php } ?>
                          
                         
                          
                          <td>
                          <?php
                            foreach ($result_product->result() as $product_row)
                            {
                                if($invoice_row->productId == $product_row->id){
                                $number_of_support = $product_row->no_of_support;
                                }
                            }
                            $given_support = $this->common_model->countAll('t_case',array('customerID' => $invoice_row->customerId,'productID' => $invoice_row->productId));
                            ?>
                          
                          <?php echo $given_support.' of '.$number_of_support; ?>
                          </td>
                          <td>
                          
                          <?php if ( strtotime($expdate) > time()){ //If expired ?> 
                          <?php  if( (($number_of_support)+3) > $given_support){ // If Extended Support Reached ?>
                                <?php  if( $number_of_support <= $given_support){ // If Support Reached ?>
                          <button type="button" class="btn btn-default btn-sm"  onclick="ConfirmCaseOpen();">Add Case</button>
                                
                                <script>
                                 
                                function ConfirmCaseOpen()
                                    {
                                      var x = confirm("Maximum case for this customer has been reached. However you can open three more cases, but try to pitch the customer. Are you sure you want create case?");
                                      if (x) {
                                          AddCaseDetails('<?php echo $this->encryption->encode($invoice_row->customerId); ?>','<?php echo $this->encryption->encode($invoice_row->productId); ?>');
                                           $('#add_case').modal('show');
                                          return true;
                                      }
                                      else
                                        {
                                         return false;
                                        }
                                    }
                                </script>
                                
                                <?php } ?>
                                
                                <?php  if( $number_of_support > $given_support){  ?>
                          <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_case" onclick="AddCaseDetails('<?php echo $this->encryption->encode($invoice_row->customerId); ?>','<?php echo $this->encryption->encode($invoice_row->productId); ?>');">Add Case</button>
                                <?php } ?>
                                
                          <?php } ?>
                          <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                <?php } ?>
				</div>        
           
            
            	<div role="tabpanel" class="tab-pane" id="all_case">
				<?php if ($result_case->num_rows() > 0){ ?>
                <h3>All Cases</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
                          <th width="46">Case #</th>
                          <th width="108">Related Product</th>
                          <th width="521">Case title</th>
                        <!--  <th>Case description</th>-->                      
                            <th width="67">Opend By</th>
                           <th width="42">Status</th>
                           <th width="6"></th>
                         </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($result_case->result() as $case_row){ ?>
                        
                        <tr>
                          <td><?php echo $case_row->case_identity; ?></td>
                          
                          <?php
                            foreach ($result_product->result() as $product_row)
                            {
                                if($case_row->productID == $product_row->id){
                                $productName = $product_row->productName;
                                }
                            }
                            ?>
                           <td><?php echo $productName; ?></td>
                          <td>
                          <?php echo $case_row->case_title; ?><br/>
                          <?php if($case_row->mac_id == ''){ ?>
                          <b>Device MAC ID: <small> Not available</small></b><br/>
                          <?php } ?>
                        
                        <?php if($case_row->mac_id != ''){ ?>
                        <b>Device MAC ID: <small><?php echo $case_row->mac_id;  ?></small></b><br/>
                        <?php } ?>
                        
                        <?php if($case_row->manufacturer_name == ''){ ?>
                        <b>Device Manufacturer: <small> Not available</small></b>
                        <?php } ?>
                        
                        <?php if($case_row->manufacturer_name != ''){ ?>
                        <b>Device manufacturer: <small><?php echo $case_row->manufacturer_name;  ?></small></b>
                        <?php } ?>
                          </td>
                          <td>
                          <?php
                            foreach ($result_agent->result() as $result_agent_row)
                            {
                                if($case_row->opend_by == $result_agent_row->id){
                                echo $result_agent_row->aliasName.' ('.$result_agent_row->name.')';
                                }
                            }
                            ?>
                          </td>
                          <td>
                            <?php if( $case_row->case_status == 1 ) { echo 'Open';} ?>
                             <?php if( $case_row->case_status == 0 ) { echo 'Closed';} ?>
                          </td>
                          <td><a href="<?php echo base_url().'cases/case-details?case='.$this->encryption->encode($case_row->caseID); ?>" class="btn btn-default btn-sm">Details</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                <?php } ?>
                </div>
                
            </div>
      
          </div>
          </div>
          
          <div class="col-md-3">
   
          <div class="form-group"><textarea id="note" class="form-control" placeholder="Enter customer note"></textarea></div>
          <div class="form-group"><button type="button" class="btn btn-info btn-xs btn-block" onclick="AddNote();">Add note</button></div>
          
          <div id="notedata">
          
          
          
          </div>
          
          </div>
          
      </div>
      
      
      
      
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

	     
        
        <!-- Add Case Modal -->
        
        
        <!-- Add Product Type -->
        <div class="modal fade" id="add_case" tabindex="-1" role="dialog" aria-labelledby="add_case" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Case</h4>
              </div>
              
               <form role="form" action="<?php echo base_url(); ?>cases/add-case" method="POST">
               <div class="modal-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Case title*</label>
                    <input type="text" class="form-control" id="case_title" name="case_title" placeholder="Enter case title" required="required">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Device MAC/Unique ID*</label>
                    <input type="text" class="form-control" id="mac_id" name="mac_id" placeholder="MAC ID/Unique identifier" >
                    <small>Please input here customer device MAC ID or An Unique identifier.</small>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Device manufacturer name*</label>
                    <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" placeholder="Device manufacturer name" >
                    <small>Please input here customer device manufacturer name.</small>
                  </div>
                  
                 <!--div class="form-group">
                   <label for="exampleInputEmail1">Case description*</label>
                   <textarea name="case_description" class="form-control" id="case_description" placeholder="Enter case description" required="required"></textarea>
                  </div-->
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save case</button>
              </div>
              <input type="hidden" id="customerID" name="customerID" />
              <input type="hidden" id="productID" name="productID" />
              </form>
              
            </div>
          </div>
        </div>
        
        
        
       
        <script>
				$(document).ready(function() {
					AddNote();
				});
		
			function AddNote(){
				$.post( 
				 "<?php echo base_url(); ?>customer/note",
				 { customerID:'<?php echo $this->input->get("id"); ?>',note:$("#note").val() },
				 function(data) {
					$('#notedata').html(data);
					$("#note").val('');
				 }
			  );
			}
			
			function AddCaseDetails(customerID,productID){
				$("#customerID").val(customerID);
				$("#productID").val(productID);
			}
			
		</script>
        
        
        <script>
			
			
			  function ShowPhone(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_phone",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			  
			  function ShowEmail(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_email",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			 
		 
			$(document).ready(function() {
				if(location.hash) {
					$('a[href=' + location.hash + ']').tab('show');
				}
				$(document.body).on("click", "a[data-toggle]", function(event) {
					location.hash = this.getAttribute("href");
				});
			});
			$(window).on('popstate', function() {
				var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
				$('a[href=' + anchor + ']').tab('show');
			});
			
		</script>
       
        
		<?php $this->load->view('footer');?>