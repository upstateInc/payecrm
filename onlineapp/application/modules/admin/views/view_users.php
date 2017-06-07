<?php 
/* echo "<pre>";
print_r($rec); exit; */

?>

<section class="layout">
	<section class="main-content">
		<div class="content-wrap">
			<div class="wrapper">
			<br/>
			<br/>
			
			
	<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Trade Name</th>
                <th>Business Type</th>
                <th>State</th>
                <th>Owner Name</th>
                <th>Owner Email</th>
                <th>Details</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Business Name</th>
                <th>Trade Name</th>
                <th>Business Type</th>
                <th>State</th>
                <th>Owner Name</th>
                <th>Owner Email</th>
                <th>Details</th>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach($rec as $k=>$v):?>
            <tr>
                <td><?php echo $v['businessName']?> </td>
                <td><?php echo $v['tradeName']?></td>
                <td><?php echo $v['businessType']?></td>
                <td><?php echo $v['corpState']?></td>
                <td><?php echo $v['ownerFName1'] . ' ' .$v['ownerLName1']?></td>
                <td><?php echo $v['email']?></td>
                <td><a href="<?php echo base_url()?>admin/details/<?php echo $v['userId']?>" class="btn btn-primary btn-xs">View details</a> </td>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
    
    
			
			</div>        
		</div> 
	</section>
</section>    


  	