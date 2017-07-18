<?php 
	$this->load->view('header');
	$newCompanyId=COMPANYID;
	if($newCompanyId==""){
		$newCompanyId=$_REQUEST['companyID'];
	}
//print_r($ResultProduct);?>
<body>
<section id="pricePlans">     	
<div class="text-center well well-sm">	
	<h1><?php echo COMPANYNAME; ?><br/>	
	<small>Let us help you take care of your Training and Support</small>
	</h1>	
	<h2>For more information, please call us at <strong><?php echo COMPANYPHONE; ?></strong></h2>	
</div>   
<div class="alert alert-success" id="alert_successShow" style="display:none;">      
	<strong>SUCCESS!</strong> Item has been added to your shopping cart. Continue shopping or goto 
	<strong><a href="<?php echo base_url(); ?>payment?companyID=<?php echo $newCompanyId;?>" style="color:#000;"><u>Checkout Page</u></a></strong>    
</div>       
<ul id="plans">	
	<?php	$productSupscriptionPeriod='';	
	$productSupscriptionPeriodMonths='';	
	if($ResultProduct->num_rows() > 0){
		foreach($ResultProduct->result() as $product_row) {	
		//print_r($product_row);		//exit;		//echo $productSupscriptionPeriod  = $product_row['ProductSupscriptionPeriod'];		$productSupscriptionPeriodMonths	= $product_row->ProductSupscriptionPeriod/30;	?>        
		<li class="plan"> 
			<ul class="planContainer">            
				<li class="title">
					<h2 class="bestPlanTitle"><?php echo $product_row->productName; ?></h2>
				</li>           
				<li class="price">
					<p class="bestPlanPrice" <?php if($product_row->productPrice==0){?> style="background: rgb(92, 184, 92);" <?php } ?>>				<?php if($product_row->productPrice==0){						echo "Free";					}else {echo $product_row->discount.'%';}				?></p>
				</li>            
				<li>			
					<p>				
					<?php if($product_row->productPrice==0){						
						echo "Free Consultation";					
					}else{?>
						<p>
							<strike>Was $<?php //echo round($product_row['productPrice']*((100+$product_row['discount'])/100))						echo round(100/(100-$product_row->discount)*$product_row->productPrice);						?></strike> &nbsp;					
								<strong style="font-size: 22px;">
									<font color="#DD6425">							
										<?php echo '$'.$product_row->productPrice;?>						
									</font>						
								</strong>					
								<?php }	?>			
								<br />&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
								<strong <?php if($product_row->ProductSupscriptionPeriod==0){?> style="font-size: 22px;" <?php } ?>>		
								<?php		//echo $product_row['ProductSupscriptionPeriod'];		if($product_row->ProductSupscriptionPeriod==0 ){			$productSupscriptionPeriodMonthsDisplay  =  '30 Minutes';		}		if( floor($productSupscriptionPeriodMonths) == 0 && $product_row->ProductSupscriptionPeriod>0) {        	$productSupscriptionPeriodMonthsDisplay  =  'One Phone Support Call';		}		 		if( floor($productSupscriptionPeriodMonths) == 1) {        	$productSupscriptionPeriodMonthsDisplay  =   $productSupscriptionPeriodMonths.' Month Phone Support';		}		 		if( floor($productSupscriptionPeriodMonths) > 1) {			 $productSupscriptionPeriodMonthsDisplay  =  $productSupscriptionPeriodMonths.' Months Phone Support';		}		echo $productSupscriptionPeriodMonthsDisplay;		?>		
								</strong>
							</p>            
						</li>		
						<?php if($product_row->ProductSupscriptionPeriod==0 ){?>            
							<li><p>&nbsp; &nbsp; &nbsp;Limited Period Offer</p></li>            
							<li>            
								<ul class="options">                
									<li><span>No payment required!</span></li>            
								</ul>            
							</li>            
							<li></li>            
							<li>            
								<ul class="options">                
									<li><span>No card details required!</span></li>            
								</ul>            
							</li>            
							<li></li>            
							<li>            
								<ul class="options">                
									<li><span>No charges, completely free!</span></li>            
								</ul>            
							</li>          
							<li class="button"></li>            
							<li class="button">
								<a class="btn btn-success" data-target="#requestaCall" data-toggle="modal" href="#">Request a call back</a>
							</li>			
						<?php }else{ ?>			
							<ul class="options">                
								<li>Training and Support Services</li>                
								<li><span>Anytime, Anywhere</span></li>                
								<li><span>Best-in class Solution</span></li>                
								<li><span>Resolution or Money back</span></li>            
							</ul>
							
<!--div class="pull-left "-->			
<li class="button" style="margin-top: 20px;"><a class="btn btn-info " data-target=".myModal" data-toggle="modal" href="#">More Info</a> 

<!--a class="btn btn-primary" href="<?php echo base_url();?>payment?product=<?php echo $product_row->id;?>">Buy Plan</a></li-->			

	<select name="qty_<?php echo $product_row->id; ?>" id="qty_<?php echo $product_row->id; ?>" class="btn btn-default" >			
		<?php for($i=1;$i<=10;$i++){				
			echo '<option>'.$i.'</option>';			
			}?>			
	</select>			

<button type="button" class="btn btn-info" onClick="Add2Cart('<?php echo $product_row->id; ?>',$('#qty_<?php echo $product_row->id; ?>').val(),'<?php echo $product_row->productPrice; ?>','<?php echo $product_row->product; ?>');"><i class="fa fa-plus" aria-hidden="true"></i> CART</button>
</li>
			<?php } ?>			
			<!--/div-->		
			</ul>        
			</li>	<?php } }else{?>	<div class="text-center well well-sm">	<h2 style="color:red;">Record Doesnot Exist</h2>	</div>			<?php		}?>             
			</ul>
			</section>
			
			<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade myModal" role="dialog" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">List of Services</h4></div><div class="modal-body"><ul class="list-group text-center">	<li>Office Training (Word, Excel, Powerpoint, and Outlook)</li>	<li>Browser and Email Training</li>	<li>Training in most PC related areas</li>	<li>Operating Systems &amp; related issues</li>	<li>Internet &amp; Browser Issues</li>	<li>Printers &amp; related softwares issues</li>	<li>Wireless set up related issues</li>	<li>Virus Removal &amp; Protection related issues</li>	<li>Malware Infection Removal</li>	<li>PC Security related issues</li>	<li>Slow PC &amp; related issues</li>	<li>PC Optimization</li>	<li>Anti-Spyware related issues</li>	<li>And many other training and technical issues we can resolve!</li></ul></div><div class="modal-footer"><button class="btn btn-warning" data-dismiss="modal" type="button">Close</button></div></div></div></div><div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="requestaCall" role="dialog" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">Request a call back</h4></div><div class="modal-body clearfix"><div class="col-md-12"><form class="model-form" method="get"><div class="form-group"><label for="Name"><strong>Your name</strong></label> <input class="form-control" id="FullName" placeholder="Enter Your Name" required type="text" /></div><div class="form-group"><label for="exampleInputphone"><strong>Email address</strong></label> <input class="form-control" id="Email" placeholder="Enter Email Address" required type="email" /></div><div class="form-group"><label for="exampleInputEmail1"><strong>Phone number</strong></label> <input class="form-control" id="Phone" placeholder="Enter Phone Number" required type="text" /></div><p class="text-left"><button class="btn btn-primary" id="send" type="submit">Submit</button></p></form></div></div><div class="modal-footer"><a class="btn btn-warning" data-dismiss="modal" href="javascript:;">Close</a></div></div></div></div>
			
			<script type="text/javascript">		
			function Add2Cart(id,qty,price,name){						
				/*$.ajax({			
					url: "<?php echo base_url(); ?>cart/insert",			
					type: "POST",			
					data:  {id:id,qty:qty},			
					success: function(data){				
						//$('#citem').html(data);				
						$("html, body").animate({ scrollTop: 0 }, "slow");				
						$("#alert_success").fadeIn('slow').animate({opacity: 1.0}, 2000).effect("pulsate", { times: 2 }, 1000).fadeOut('slow');			
					},			
					error: function(){} 	        			
				});*/
				$.ajax
				({
					type: "POST",
					url: "<?php echo base_url();?>home/insertCart",
					data: { id:id,qty:qty },
					//dataType: 'json',
					cache: false,
					success: function(data)
					{
						//alert(data);
						/*$("#gatewayID").val(data.gatewayName);
						$("#decriptor").val(data.decriptor);
						$("#decriptorDeclaration").html(data.decriptor);
						$("#decriptorDisplay").html(data.decriptor);
						$("#decriptorDisplay1").html(data.decriptor);
						$("#directory").val(data.directory);
						$("#programName").val(data.programName);*/
						$("html, body").animate({ scrollTop: 0 }, "slow");				
						//$("#alert_success").fadeIn('slow').animate({opacity: 1.0}, 2000).effect("pulsate", { times: 2 }, 1000).fadeOut('slow');
						//if(data!=""){
							$("#alert_successShow").show();
							//alert('ok');
					}
					
					//}
				});				
			}
			</script>
			<?php $this->load->view('footer');