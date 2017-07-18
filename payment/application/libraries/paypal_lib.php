<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


// ------------------------------------------------------------------------

class Paypal_Lib {

    var $last_error;            
    var $ipn_log;

    var $ipn_log_file;
    var $ipn_response;    
    var $ipn_data = array();
    var $fields = array();

    var $submit_btn = '';
    var $button_path = '';
    
    var $CI;
    
    function Paypal_Lib()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->helper('form');
        $this->CI->load->config('paypallib_config');
        
        //$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        $this->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';//ptr teste
        $this->last_error = '';
        $this->ipn_response = '';

        $this->ipn_log_file = $this->CI->config->item('paypal_lib_ipn_log_file');
        $this->ipn_log = $this->CI->config->item('paypal_lib_ipn_log'); 
        
        $this->button_path = $this->CI->config->item('paypal_lib_button_path');
        
        $this->add_field('rm','2');              // Return method = POST
        $this->add_field('cmd','_xclick');

        $this->add_field('currency_code', $this->CI->config->item('paypal_lib_currency_code'));
        $this->add_field('quantity', '1');
        $this->button('Pay Now!');
    }

    function button($value)
    {
        // changes the default caption of the submit button
        $this->submit_btn = form_submit('pp_submit', $value);
    }

    function image($file)
    {
        $this->submit_btn = '<input type="image" name="add" src="' . site_url($this->button_path .'/'. $file) . '" border="0" />';
    }


    function add_field($field, $value) 
    {
        $this->fields[$field] = $value;
    }

/*    function paypal_auto_form() 
    {

        echo '<html>' . "\n";
        echo '<head><title>Processing...</title></head>' . "\n";
        echo '<body>' . "\n";
        echo '<center>';
        echo '<table style="margin-top:200px;"><tr>';
        echo '<td><img src="'.base_url().'assets/images/loadingAnimation.gif" /></td>';
        echo '<tr><td>'.$this->button('Click here...').'</td></tr>';
        echo '</tr></table>';
        echo  $this->paypal_form('paypal_auto_form');
        echo '</center></body></html>';
		
    }*/


	function paypal_auto_form() 
	{
		// this function actually generates an entire HTML page consisting of
		// a form with hidden elements which is submitted to paypal via the 
		// BODY element's onLoad attribute.  We do this so that you can validate
		// any POST vars from you custom form before submitting to paypal.  So 
		// basically, you'll have your own form which is submitted to your script
		// to validate the data, which in turn calls this function to create
		// another hidden form and submit to paypal.

		$this->button('Click here if you\'re not automatically redirected...');

		echo '<html>' . "\n";
		echo '<head><title>Processing Payment...</title></head>' . "\n";
		echo '<body onLoad="document.forms[\'paypal_auto_form\'].submit();">' . "\n";
		echo '<p>Please wait, your order is being processed and you will be redirected to the paypal website.</p>' . "\n";
		echo $this->paypal_form('paypal_auto_form');
		echo '</body></html>';
	}

    function paypal_form($form_name='paypal_form') 
    {
        $str = '';
        $str .= '<form method="post" action="'.$this->paypal_url.'" name="'.$form_name.'"/>' . "\n";
        foreach ($this->fields as $name => $value)
            $str .= form_hidden($name, $value) . "\n";
        $str .= '<p>'. $this->submit_btn . '</p>';
        $str .= form_close() . "\n";

        return $str;
    }
    
    function validate_ipn()
    {
        $url_parsed = parse_url($this->paypal_url);          
        $post_string = '';     
        if ($_POST)
        {
            foreach ($_POST as $field=>$value)
            { 
                $value = str_replace("\n", "\r\n", $value);
                $this->ipn_data[$field] = $value;
                $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
            }
        }
        
        $post_string.="cmd=_notify-validate"; // append ipn command

        $fp = fsockopen('ssl://www.sandbox.paypal.com',443,$err_num,$err_str,30);
        if(!$fp)
        {
            $this->last_error = "fsockopen error no. $errnum: $errstr";
            $this->log_ipn_results(false);         
            return false;
        } 
        else
        { 
            fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n"); 
            fputs($fp, "Host: $url_parsed[host]\r\n"); 
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
            fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
            fputs($fp, "Connection: close\r\n\r\n"); 
            fputs($fp, $post_string . "\r\n\r\n"); 
            while(!feof($fp))
                $this->ipn_response .= fgets($fp, 1024); 

            fclose($fp); // close connection
        }

        if (eregi("VERIFIED",$this->ipn_response))
        {
            $this->log_ipn_results(true);
            return true;         
        } 
        else 
        {
            $this->last_error = 'IPN Validation Failed.';
            $this->log_ipn_results(false);    
            return false;
        }
    }

    function log_ipn_results($success) 
    {
        if (!$this->ipn_log) return;  // is logging turned off?

        $text = '['.date('m/d/Y g:i A').'] - '; 

        if ($success) $text .= "SUCCESS!\n";
        else $text .= 'FAIL: '.$this->last_error."\n";

        $text .= "IPN POST Vars from Paypal:\n";
        foreach ($this->ipn_data as $key=>$value)
            $text .= "$key=$value, ";

        $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;

        $fp=fopen($this->ipn_log_file,'a');
        fwrite($fp, $text . "\n\n"); 

        fclose($fp);  // close file
    }


    function dump() 
    {
        ksort($this->fields);
        echo '<h2>ppal->dump() Output:</h2>' . "\n";
        echo '<code style="font: 12px Monaco, \'Courier New\', Verdana, Sans-serif;  background: #f9f9f9; border: 1px solid #D0D0D0; color: #002166; display: block; margin: 14px 0; padding: 12px 10px;">' . "\n";
        foreach ($this->fields as $key => $value) echo '<strong>'. $key .'</strong>:    '. urldecode($value) .'<br/>';
        echo "</code>\n";
    }

}

?>  