<?php 
if(count($_POST) > 0)
{
	$conn = mysql_connect("localhost","payecrm_master","UvzeTkMp*(yy");
	mysql_select_db("payecrm_master") or die(mysql_error());
		
	$company_email = $_POST[1]['company_email'];
	
	$str = '';
	$postData = $_POST;
	foreach($postData as $k=>$v)
	{
		foreach($v as $k1=>$v1)
		{
			$str .= "`".$k1 ."`='$v1', ";
		}
	}
	
	$qry = "SELECT count(id) AS cnt, id FROM `t_merchant` WHERE company_email = '".$company_email."'";
	$res = mysql_query($qry);
	$res = mysql_fetch_object($res);
	
	#error_log(print_r($res->cnt, 1));
	
	if($res->cnt > 0) //Update
	{
		$str_qry = "UPDATE `t_merchant` SET ";
		$str_qry .= substr($str, 0, -2);
		$str_qry .= " WHERE id=" . $res->id;
	}	
	else // Insert
	{
		$str_qry = 'INSERT INTO `t_merchant` SET ';
		$str_qry .= substr($str, 0, -2);
	}		 
	#error_log($str_qry);	
	mysql_query($str_qry);
	mysql_close($conn);
}