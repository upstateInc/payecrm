<?php $this->load->view('header');?>
 
<?php //$this->load->view('left');

?>

<body id="payment-entry">

<div class="col-md-8  col-md-offset-2" style="padding-left:25px;">
<div class="row">
    <div class="col-md-7"><h2>Complete Your Order and Payment!</h2></div>
    <div class="col-md-5"><h4 class="alert alert-warning center-block text-center" style="color: rgb(138, 109, 59);"><?php echo COMPANYNAME; ?>&nbsp;<span style="color:#8a6d3b; font-size:14px;">Need Help with payments?<br> Call us at <?php echo COMPANYPHONE; ?></span></h4></div>
</div>
<br/>
<div class="row runningContent">
	<form action="<?php echo base_url();?>payment/process" class="form-horizontal" id="payment" method="POST" onSubmit="return SubmitFrm();" role="form">
	<?php 
		$newCompanyId=COMPANYID;
		if($newCompanyId==""){
			$newCompanyId=$_REQUEST['companyID'];
		}
	?>
		<input type="hidden" name="companyID" value="<?php echo $newCompanyId;?>" />
        <div class="col-md-12 order-details img-rounded">
        <fieldset><legend> Order Details <span style="font-size:12px; color:#666;">&nbsp;</span></legend>
        <table>
            <tbody>
            <tr>           
			<td>
            <select name="selectProduct" id="selectProduct" class="form-control" >
            <option value="">Select Product</option>
			<?php
			foreach($ResultProduct->result() as $row) { ?>
				<option value="<?php echo $row->id;?>"><strong><?php echo $row->productName.'  -  $'.$row->productPrice;?></strong></option>
			<?php } ?> 			
            </select>
            </td>
  <td width="2%"></td>
            <td width="15%"><button type="button" id="submit" class="btn btn-primary" onClick="addProduct();">Add</button></td>
            
            </tr>
               
                
            <!--<tr>
            <td>&nbsp;</td>
            </tr>-->
            
                 
            
            </tbody>
            
        </table>
<div id="cartAreaDiv">  
		<?php $this->load->view('cartArea'); ?>        
</div>  
<tr>
				<td>Security Protection</td>
				<td > 
					<select name="securityProtection" id="securityProtection" >
						<option value="0">Select</option>
			         	<option value="1">1 Year</option>
			         	<option value="2">2 Years</option>
			         	<option value="3">3 Years</option>
			         	<option value="4">4 Years</option>
			         	<option value="5">5 Years</option>
					</select>       
				</td>
			</tr>
			<br/>
			<br/>
			<tr>
				<td>Number of Device(s)</td>
				<td>
					<select name="totalDevices" id="totalDevices" >
						<option value="0">Select</option>
			         	<option value="1">1 Device</option>
			         	<option value="2">2 Devices</option>
			         	<option value="3">3 Devices</option>
			         	<option value="4">4 Devices</option>
			         	<option value="5">5 Devices</option>
					</select>
				</td>
			</tr>
			<br/>
			<br/>		
        </fieldset>
		<input type="hidden" name="PaymentType" value="credit_card" >
<fieldset>
	<legend> Payment Option <span style="font-size:12px; color:#666;">&nbsp;</span></legend>
    <table>
        <tbody>        
			<tr>
				<th>Technician ID</th>
				<td><input class="form-control" id="agentid" name="agentid" placeholder="For internal use. This will be provided by the Technician" type="text" <?php if(TECHNICIANIDREQUIRED == 'Y'){?> required <?php } ?> /></td>
			</tr> 
		</tbody> 
    </table>
</fieldset>        			
<fieldset>
<legend> Payment Information <span style="font-size:12px; color:#666;">We never save/record any financial details of customers</span></legend>
	<div class="col-md-12">
    <table>
            <tbody>
				<?php //echo base_url(); ?>
                <table id="paymentInfoSection">
					<?php //$this->load->view('credit_card');?>
                </table>
                
			</tbody>
		</table>
        </div>
</fieldset>
      
                        

<fieldset>


<table width="100%" border="0">

<tr>

<td valign="top">IP Address: <span><?php echo get_client_ip(); ?> <input type="hidden" name="ip" id="ip" value="<?php echo get_client_ip(); ?>" /> </span></td>

<td><div style="text-align: center; margin-top:-17px;">
       	<p class="text-center">
		<?php if(MIDSELECTIONPROCESS=='N'){ ?>
		</p><h4 align="center">This payment will appear on your billing statement as follows:  <br><strong style="color:#900;"><!--?php //echo $gateway_descriptor;?--><span id="descriptorDisplay1"></span></strong></h4>
        <p></p>
		<?php } ?>
		<p align="center">
		</p><h4 class="text-center"><strong style="font-size:14px;">Quality Control &amp; Billing Department</strong></h4><?php echo COMPANYPHONE; ?>
		<h4 class="text-center"><strong><!--?php echo $Gorad_Billing_Number;?--></strong></h4>
		Please call for all billing and customer support inquires.
		<!--<img src="https://www.goradllc.com/images/creditcard-logo1.png" style="align:center;">-->
        <p class="text-center">
		<img style="align:center;" src="https://www.goradllc.com/images/creditcard-logo1.png"/>
	    </p>
		
        </div></td>

<td valign="top" style="text-align:right;">Date: <span><?php echo date("F j, Y");  ?></span></td>


</tr>



</table><br/>



<p class="pull-right" style="margin:0 0 0 0px; padding-bottom:10px;">  <button type="submit" id="submit" class="btn btn-primary btn-lg" >Submit &amp; Confirm</button>

<button type="reset" class="btn btn-default btn-lg">Reset</button></p>
</fieldset>

        </div>


            </form>
        </div>
</div>


<!--script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.min.js"></script-->  
<script type="text/javascript">	
	 function input_onchange(me,maxAllowed){ 
		//alert(me.maxlength);
        if (me.value.length != maxAllowed){
            return;
        }
        var i;
        var elements = me.form.elements;
        for (i=0, numElements=elements.length; i<numElements; i++) {
            if (elements[i]==me){
                break;
            }
        }
        elements[i+1].focus();
    }
	function ChangeCardType(val){
		//alert(val);
		if(val=='AmEx'){
			$("#creditCardInfoSection").load("<?php echo base_url();?>payment/amex");
		}else{			
			$("#creditCardInfoSection").load("<?php echo base_url();?>payment/normalCard");
		}
	}
	function updateItem(id){
		var quantity = jQuery("#quantity"+id).val();
		var price_each = jQuery("#price_each"+id).val();
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url();?>payment/updateItem",
			data: { id: id, quantity:quantity, price_each:price_each },
			success: function(data)
			{
				jQuery("#cartAreaDiv").html(data);
			}
		});
	}
	function removeItem(id){
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url();?>payment/removeItem",
			data: { id: id },
			success: function(data)
			{
				jQuery("#cartAreaDiv").html(data);
			}
		});
	}
	$(document).ready(function() 
		{
			$("#paymentInfoSection").load("<?php echo base_url();?>payment/credit_card");
			//$("#creditCardInfoSection").load("<?php echo base_url();?>payment/normalCard");
		} 
	); 
	function addProduct(){
		//var r=confirm("Are you sure to Add This Product In your Cart?"); 
		//if(r == true){
			var selectProduct = jQuery("#selectProduct").val();
			//alert(selectProduct);
				$.ajax
				({
					type: "POST",
					url: "<?php echo base_url();?>payment/insertCart",
					data: { selectProduct:selectProduct },
					cache: false,
					success: function(data)
					{

						//alert('Product Added To Cart');
						jQuery("#cartAreaDiv").html(data);
					}
				});			
		//}
	}
	function changeSelectProduct(){
		//alert(category);
		//alert($("input[name=productNameSelect]:checked").val());
		var productNameSelect = jQuery("input[name=productNameSelect]:checked").val();
		var categorySelect = jQuery("#categorySelect").val();
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url();?>payment/changeProduct",
			data: { productNameSelect: productNameSelect, categorySelect:categorySelect },
			success: function(data)
			{
				$("#selectProductDiv").html(data);
			}
		});		
	}
	$(document).ready(function () {
		$('#product_name').val("<?php echo $productName; ?> - 1 " );
		//$('#p_name').html("<?php echo $productName; ?> - 1" );
	});
	
   function ChangeText(isoName){
		$('#country').val(isoName);								
	}
	function ChangeState(id){
		$.post( 
			"<?php echo base_url();?>payment/statelist",
			{ countryid: id },
			function(data) {
				$('#statediv').html(data);
			}
		);
	}	

	$('#quantity').change(function () {
		var base_price 	= $('#product_price_each').val();
		var quantity 	= $('#quantity').val();
		var total_price = base_price*quantity;
		//alert(total_price);
		//$('#pr_pr').html('$' + total_price);
		$('#ac_price').html('$' + total_price);
		
		$('#sub_total').html('$' + total_price);
		$('#total').html('$' + total_price);
		
		$('#product_price').val(total_price);
		
		
		$('#product_name').val("<?php echo $productName; ?> - " + quantity);
		//$('#p_name').html("<?php echo $productName; ?> - " + quantity);
	});
		



	
	function ChangeGatewayDetails(val){
			if(val==""){
				$("#descriptorDisplay").html("");
			}
			$.ajax
			({
				type: "POST",
				url: "<?php echo base_url();?>payment/getGatewayDetails",
				data: { id: val },
				dataType: 'json',
				cache: false,
				success: function(data)
				{
					$("#gatewayID").val(data.gatewayName);
					$("#descriptor").val(data.descriptor);
					$("#descriptorDeclaration").html(data.descriptor);
					$("#descriptorDisplay").html(data.descriptor);
					$("#descriptorDisplay1").html(data.descriptor);
					$("#descriptorDisplay1").html(data.descriptor);
					$("#directory").val(data.directory);
					$("#programName").val(data.programName);
				}
			});
	}
	
	function SetCheckNumber(value){
		$("#LableCardNumber").html(value.slice(-4));
		$("#LableCardType").html('<strong>'+$("#bankName").val()+'</strong> Checking Account and check number ');
	}
	
	
	 function SubmitFrm(){
		 if (confirm('Are you sure, you want to make purchase? you can review your payment details by clicking "Cancel" button now or click on "OK" button to proceed ')) {
           document.getElementById('payment').submit();
       } else {
			return false;
       }
	 }

	function changePaymentType(PaymentType){
		$("#descriptorDisplay").html("");
		$.ajax
			({
				type: "POST",
				url: "<?php echo base_url();?>payment/paymentType",
				data: { PaymentType: PaymentType },
				success: function(data)
				{
					$("#PaymentTypeDiv").html(data);
				}
			});
		if(PaymentType=='credit_card'){
			$("#paymentInfoSection").load("<?php echo base_url();?>payment/credit_card");
		}
		if(PaymentType=='echecking'){
			$("#paymentInfoSection").load("<?php echo base_url();?>payment/echecking");	
		}		
	}
	 
   </script>
   <!--script src="<?php echo $base_url; ?>assets/js/bootstrap-datepicker.js"></script>

</body>
</html-->
<?php $this->load->view('footer');?>




