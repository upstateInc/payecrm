<?php
    require_once 'AuthorizeNet.php';
	$sale = new AuthorizeNetAIM('53Sxz4KLV', '3nD58GL7y255L9tq');
	$void_response = $sale->void('60022419858');
    print_r($void_response);
?>