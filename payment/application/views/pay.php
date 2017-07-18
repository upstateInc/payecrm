<?php $this->load->view('header');?>
<body>
<section id="pricePlans">

 	 <div class="text-center well well-sm">
     <h1><?php echo COMPANYNAME; ?><br/>
     <small>Let us help you take care of your Training and Support</small></h1>
     <h2>For more information, please call us at <strong><?php echo COMPANYPHONE; ?></strong></h2>
     </div>

	<form role="form" id="payment" method="POST" action="<?php echo base_url();?>payment/insertPay" >
  		<div class="form-group">
            <label for="exampleInputEmail1">Select Product</label>
            <select class="form-control" required name="product" id="product">
              <option> Select Product</option>
             <?php
			 foreach($ResultProduct->result() as $product_row) {
				$productName 				= $product_row->productName;
				$productPrice 				= $product_row->productPrice;
				$productDescription 			= $product_row->productDescription;
				$ProductSupscriptionPeriod  = $product_row->ProductSupscriptionPeriod;
				$ProductSupscriptionPeriod	= $ProductSupscriptionPeriod/30;?>
                    <option value="<?php echo $product_row->id;?>"><?php echo $product_row->productName.' - '.$product_row->ProductSupscriptionPeriod.' Days - '.$productDescription.'- $'.$product_row->productPrice;?></option>

			<?php } ?> 
            </select>
        </div>
        
        
        <div class="form-group">
            <label for="exampleInputEmail1">Amount</label>
            <input name="price" id="price" type="text" class="form-control" placeholder="Amount " required>
        </div>
  
  		<div id="summery"></div>
   
        <div class="form-group">
        <button type="submit" class="btn btn-warning btn-block">Proceed Next</button>
        </div>
    
    
   
    
    
</form>
    
    </section>
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {			
            $("#product").change(function(event){
				var data = {
				  "id": $('#product').val()
				};
				data = $(this).serialize() + "&" + $.param(data);
				$.ajax({
				  type: "POST",
				  dataType: "json",
				  url: "<?php echo base_url();?>pay/product_summery", //Relative or absolute path to response.php file
				  data: data,
				  success: function(data) {
					$("#summery").html(
					  data["msg"]
					);
					
					$('#price').val(data["price"])
					
				  }
				});
            });				
         });
      </script>
