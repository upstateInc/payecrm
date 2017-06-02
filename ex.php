<!DOCTYPE html>
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<title>cURL test</title>

<!-- <script
  src="https://code.jquery.com/jquery-3.2.1.slim.js"
  integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg="
  crossorigin="anonymous"></script> -->

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
	
	
<script>
$(document).ready(function()
{
	//alert("hi");
	$.ajax(
	{
		url: 'https://payehub.com/onlineapp/applicationForm/merchant_api/?user_id=3',
		async:true,
        dataType : 'json',
        crossDomain:true,
		success: function ( data )
	    {
			var str = data[0].company_name+'<br/>'+
			data[1].company_email+'<br/>'+
			data[2].company_feedback_email+'<br/>'+
			data[3].company_invoice_email+'<br/>'+
			data[4].company_phonenumber+'<br/>'+
			data[5].company_address+'<br/>'+
			data[6].company_City+'<br/>'+
			data[7].company_State+'<br/>'+
			data[8].company_Zipcode;
			
			$('#val').html(str );
		}
	});
});
</script>
</head>
<body>

Company name: <div id="val"></div>

</body>
</html>