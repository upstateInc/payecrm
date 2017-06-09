<?php
class Mail_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}
	
	public function mail_content($username,$mailContent) {
		/*$sql = "SELECT * FROM ".SOCIALMEDIA." WHERE status = 'Y' order by order_id ASC" ;
		$query = $this->db->query($sql);*/
		//$row = $query->row_array(); 

		$msg = '<html>
<body>
<p>&nbsp;</p>
<table width="700px;" align="center" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div style="width:100%; max-height:10px; overflow:hidden; position:relative; font-size:18px; font-weight:bold; color:#FF6600;"> 
<span style=" position:absolute; left:180px; top:0;width:220px;  border-bottom: 100px solid #dadee6;
 border-left: 55px solid transparent;
 border-right: 60px solid transparent; z-index:-1;"></span>
<span style="float:left;width:220px;border-bottom: 80px solid #2e69b3;border-right: 60px solid transparent;"></span> 
<span style="float:right;width: 156px;border-top: 120px solid #ff6c00;border-left: 80px solid transparent;"></span> </div></td>
  </tr>
  <tr>
    <td colspan="2">'.$mailContent.'
    </td>
  </tr>
  <tr>
    <td colspan="2">
    
        <div style="width:100%; max-height:10px; overflow:hidden; position:relative;">
        <span style=" position:absolute; left:30px; top:0;width:100px; height:10px; background:#dadee6; z-index:-1;"></span>
    <span style="float:left;width:30px;border-bottom: 80px solid #ff6c00;border-right: 60px solid transparent;"></span>
    
<span style="float:right;width:520px;border-top: 120px solid #235491;border-left: 80px solid transparent;"></span></div>    </td>
  </tr>
  <tr>
    <td colspan="2"><p align="center"></p></td>
  </tr>
</table>
<p>&nbsp;</p>

</body>
</html>
';
	
	return $msg;

	}

	
	
	
} // end of class