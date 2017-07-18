<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Text Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('my_form_hidden'))
{
	function my_form_hidden($data = '', $value = '', $extra = '')
	{
		$CI =& get_instance();
		$CI->load->helper('form');
		$defaults = array('type' => 'hidden', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

// ------------------------------------------------------------------------