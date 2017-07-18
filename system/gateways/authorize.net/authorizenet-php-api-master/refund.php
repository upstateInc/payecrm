<?php
    require_once 'AuthorizeNet.php';
	$sale = new AuthorizeNetAIM('53Sxz4KLV', '3nD58GL7y255L9tq');
	$refund_response = $sale->credit('60022420312', '4.99', '5424000000000015');
    print_r($refund_response);
?>