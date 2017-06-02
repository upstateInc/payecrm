<?php
session_start();
ob_start();

$timezone = "US/Eastern";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//Tables
define('ADMINUSER','t_admin');
