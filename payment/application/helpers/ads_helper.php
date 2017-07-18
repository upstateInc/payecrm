<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
       
	  function show_ads($size,$count)
	  {
			$CI =& get_instance();
			$CI->load->database();
			$CI->db->select('*');
			$CI->db->order_by("id", "RANDOM"); 
			$CI->db->limit($count);
			$CI->db->from('banner');
			$CI->db->where('ad_type', $size);		
			$query = $CI->db->get();
			
			
		echo "<div class='advbanner'>";
            		
            foreach ($query->result() as $adsrow)
            {
                echo '<a><img alt="'.$adsrow->ad_type.'" src="'.base_url().'upload/banner/'.$adsrow->image.'"/></li></a>';
            }
       
         echo  "</div>";
		 
		 
	}

?>