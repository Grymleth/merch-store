<?php

class Common {

	private static function textHit($string, $exclude=""){
		if(empty($exclude)) return false;
		if(is_array($exclude)){
			foreach($exclude as $text){
				if(strstr($string, $text)) return true;
			}
		}else{
			if(strstr($string, $exclude)) return true;
		}
		return false;
	}

    public static function checkValue($value) {
		if((@count($value)>0 and !@empty($value) and @isset($value)) || $value=='0') {
			return true;
		}
	}

	public static function isContactNo($string){
		return (bool)preg_match("/^[0-9+]+$/", $string);
	}

	public static function isAlphaNumeric($string){
		return (bool)preg_match("/^[0-9a-zA-Z]+$/", $string);	
	}

	public static function isAlpha($string){
		return (bool)preg_match("/^[a-zA-Z]+$/", $string);
	}

	public static function isPasswordLength($string){
		if((strlen($string) < 8 || strlen($string) > 32)) {
			return false;
		} else {
			return true;
		}
	}

	public static function isEmail($string, $exclude=""){
		if(self::textHit($string, $exclude)) return false;
			return (bool)preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i", $string);
	}
}


?>