<?php
    require_once 'AuthorizeNet.php';
	$sale = new AuthorizeNetAIM('53Sxz4KLV', '3nD58GL7y255L9tq');
	$capture_response = $sale->priorAuthCapture('60022420312');
    print_r($capture_response);
?>