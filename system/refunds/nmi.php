<?php

define("APPROVED", 1);
define("DECLINED", 2);
define("ERROR", 3);

class gwapi {
	function setLogin($username,$password) {
    	$this->login['username'] = $username;
    	$this->login['password'] = $password;
	}
	function doCapture($transactionid) {
		$query  = "";
		// Login Information
		$query .= "username=" . urlencode($this->login['username']) . "&";
		$query .= "password=" . urlencode($this->login['password']) . "&";
		// Transaction Information
		$query .= "transactionid=" . urlencode($transactionid) . "&";
		$query .= "type=capture";
		return $this->_doPost($query);
	}
	function doSale($transactionid) {
		$query  = "";
		// Login Information
		$query .= "username=" . urlencode($this->login['username']) . "&";
		$query .= "password=" . urlencode($this->login['password']) . "&";
		// Transaction Information
		$query .= "transactionid=" . urlencode($transactionid) . "&";
		$query .= "type=sale";
		return $this->_doPost($query);
	}	
	function doVoid($transactionid) {
		$query  = "";
		// Login Information
		$query .= "username=" . urlencode($this->login['username']) . "&";
		$query .= "password=" . urlencode($this->login['password']) . "&";
		// Transaction Information
		$query .= "transactionid=" . urlencode($transactionid) . "&";
		$query .= "type=void";
		return $this->_doPost($query);
	}
	function doRefund($transactionid, $amount = 0){
		$query  = "";
		// Login Information
		$query .= "username=" . urlencode($this->login['username']) . "&";
		$query .= "password=" . urlencode($this->login['password']) . "&";
		// Transaction Information
		$query .= "transactionid=" . urlencode($transactionid) . "&";
		if ($amount>0) {
			$query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
		}
		$query .= "type=refund";
		return $this->_doPost($query);
	}
	function _doPost($query) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://secure.nmi.com/api/transact.php");
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		curl_setopt($ch, CURLOPT_POST, 1);

		if (!($data = curl_exec($ch))) {
			return ERROR;
		}
		curl_close($ch);
		unset($ch);
		//print "\n$data\n";
		$data = explode("&",$data);
		for($i=0;$i<count($data);$i++) {
			$rdata = explode("=",$data[$i]);
			$this->responses[$rdata[0]] = $rdata[1];
		}
		return $this->responses['response'];
	}
}















