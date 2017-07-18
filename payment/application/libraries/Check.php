<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name: Check.class.php
 * Description: This file will use for empty/validity/string match etc purpose
 * Author: Satyen Rudra
 * Email : satyen@matrixnmedia.com
**/


class Check {
	
	/* 
	Name: checkEmpty
	Purpose: Check if the value has been put in the required field
	Parameter : $controlName=required text box name like first_name,$labelName= Lable like First Name
	return: string 
	*/
	
	public function checkEmpty($controlName,$labelName) {
		$ctrlCount = strstr($controlName,"##");
		$labelCount = strstr($labelName,"##");
		$message = '';
		if($ctrlCount!="" && $labelCount!="") { //For Multiple Integer Values
			$controlNameArray = explode("##",$controlName);
            $labelNameArray = explode("##",$labelName);
			for($i=0;$i<count($controlNameArray);$i++) {
				 if(trim($controlNameArray[$i]) == "" || trim($controlNameArray[$i]) == "<br />" || trim($controlNameArray[$i]) == "0") {  // <br /> and 0 for editor
				// if(trim($controlNameArray[$i]) == "" || trim($controlNameArray[$i]) == "<br />" ) {
					$message.= ucwords($labelNameArray[$i]).' Cannot be left Blank.<br />';
				 }
			}
		}
		else {
			 if($controlName == "") {
				$message.= ucwords($labelName).' Cannot be left Blank.<br />';
			 }
		}
		return $message;
	}
	// end of checkEmpty

	/*
	 Name : checkEmail
     Purpose: This function will check if a email id is valid
     Parameter : File name, Lable name
     return : string  
	*/
	public function checkEmail($emailString,$labelEmail) {
		$emailstr = strstr($emailString,",");
		$labelemail = strstr($labelEmail,",");
		$message = '';
        $email_filter = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i" ;
		if($emailstr != "" && $labelemail != "")  { //For Multiple Integer Values
			$emailStringArray = explode(",",$emailString);
			$labelEmailArray = explode(",",$labelEmail);
			for($i=0;$i<count($emailStringArray);$i++) {
				if(!(preg_match($email_filter,$emailStringArray[$i]))) {
					$message.= ucwords($labelEmailArray[$i])." is not a valid Email Address."."<br>";	
				}
			}
         
		}
		else {
			if(!(preg_match($email_filter,$emailString))) {
				$message.= ucwords($labelEmail)." is not a valid Email Address."."<br>";
			}
		}
		return $message;
	}

     /*
     Name : FilecheckEmpty
     Purpose: This function will check empty for uploaded file and the Type also
     Parameter : File name, Lable name,uploaded file type
     return : string  
     */
     public function FilecheckEmpty($file_name,$lable_name,$uploaded_file_type) {
         $tmp_message = '';
         if($uploaded_file_type == 'image') {
			 $allow_file_type = array("image/gif","image/pjpeg","image/x-jg","image/x-png","image/png","image/jpg","image/jpeg");
             $allow_file_type_lable = "GIF/JPEG/JPG/PNG"; 
             /*$allow_file_type = array("image/jpg","image/jpeg","image/pjpeg");
             $allow_file_type_lable = "JPEG/JPG";*/
         }
         if($uploaded_file_type == 'zip') {
           $allow_file_type = array("application/x-zip-compressed","application/zip");
           $allow_file_type_lable = "ZIP";
         }
		 //echo "<br>Tmp Name = ".$file_name['tmp_name'];
         if(is_file($file_name['tmp_name'])) {
			 if(!in_array($file_name['type'],$allow_file_type)) {
				$tmp_message = ' Please upload '.$allow_file_type_lable.' for '.$lable_name.'<br />';  
			 }
         }
         else {
           $tmp_message = $lable_name.' Cannot be left Blank.<br />'; 
         }
         return $tmp_message ;
     }

	   
	  /*
     Name : checkFileType
     Purpose: This function will check file
     Parameter : File name, Lable name,uploaded file type
     return : string   $image_file_name['tmp_name']
     */
	public function checkFileType($file_name,$lable_name,$uploaded_file_type) {
		$tmp_message = '';
        if($uploaded_file_type == 'image') {
           $allow_file_type = array("image/gif","image/pjpeg","image/x-jg","image/x-png","image/png","image/jpg","image/jpeg");
           $allow_file_type_lable = "GIF/JPEG/JPG/PNG";
        }
        if($uploaded_file_type == 'zip') {
           $allow_file_type = array("application/x-zip-compressed","application/zip");
           $allow_file_type_lable = "ZIP";
        }
		if(!in_array($file_name['type'],$allow_file_type)) {
			$tmp_message = ' Please upload '.$allow_file_type_lable.' for '.$lable_name.'<br />';  
		}
		return $tmp_message ;
	}

	
	
	/*
	Name : checkWidthHeight
	Purpose : This function will check the size of a image (Wisth X Height)
	Parameter : File name , Allowed file W X H
	Ruturn : string
	*/
	public function checkWidthHeight($file_name,$allowed_W,$allowed_H) {
		$tmp_message = '';
		list($width, $height, $type, $attr) = getimagesize($_FILES[$file_name]['tmp_name']);
		if($allowed_W != '') {
			if($width > $allowed_W) {
				$tmp_message = 'Width cannot be greater than '.$allowed_W. ' px.<br />';
			}
		}
		if($allowed_H != '') {
			if($height > $allowed_H) {
				$tmp_message = 'Hieght cannot be greater than '.$allowed_H. ' px.<br />';
			}
		}
		return $tmp_message ;
	}
	// end of checkWidthHeight()

	/* 
	Name: twoStringMatch
	Purpose: Check if two supplied string match
	Parameter : str1 and str2
	return: int [Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal. ]
	*/
	public function twoStringMatch($str1,$str2) {
		 $com = strcmp($str1,$str2);
		 return $com;
	}
	
	/*
	Name: checkURL
	Purpose: Check if a URL is a valid or not
	Parameter : $urlString =  name of the testbox like site_url ,$labelurl= Lable like Site URL
	return: string 
	*/

	public function checkURL($urlString,$urlLabel) {
		$tmp_message = '';
		$urlstr = strstr($urlString,",");
		$labelstr = strstr($urlLabel,",");
		if($urlstr != "" && $labelstr != "") { //For Multiple Integer Values
			$urlStringArray = explode(",",$urlString);
			$urlLabelArray = explode(",",$urlLabel);
			for($i=0;$i<count($urlStringArray);$i++) {
				if (!(eregi("^((ht|f)tp://)((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:\?\.-]*)*)$",$urlStringArray[$i]))) {
					$urlStringArray[$i]="http://".$urlStringArray[$i];
				}
				if (!(eregi("^((ht|f)tp://)((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:\?\.-]*)*)$",$urlStringArray[$i]))) {
					$tmp_message.= (ucwords($urlLabelArray[$i])).' is not a valid url Address.<br />';
					$urlStringArray[$i] = "";
				}
			}
		}
		else {
			if (!(eregi("^((ht|f)tp://)((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:\?\.-]*)*)$",$urlString))) {
				$urlString="http://".$urlString;
			}
			if (!(eregi("^((ht|f)tp://)((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:\?\.-]*)*)$",$urlString))) {
				$tmp_message.= (ucwords($urlLabel)).' is not a valid url Address.<br />';
				$urlString="";
			}
		}
		return $tmp_message;
	} // end of checkURL
	
	public function testing() {
		$msg = "This is test message.";
		return $msg;
		
	}

}
// End of class Check
?>