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

	public static function isLegalDate($date){
		$_date = explode("-", $date);
		$age = (date("md", date("U", mktime(0, 0, 0, $_date[1], $_date[2], $_date[0]))) > date("md")
			? ((date("Y") - $_date[0]) - 1)
			: (date("Y") - $_date[0]));
		# Jeanne Calment oldest human in recorded history with age of 122
		return($age >= 13 && $age <= 122);
	}

	public static function isContactNo($string){
		return (bool)preg_match("/^[0-9+]+$/", $string);
	}

	public static function isAlphaNumeric($string){
		return (bool)preg_match("/^[0-9a-zA-Z]+$/", $string);	
	}

	public static function isAddressAllowed($string){
		return (bool)preg_match("/^[0-9a-zA-Z\s,#-]+$/", $string);	
	}

	public static function isAlpha($string){
		return (bool)preg_match("/^[a-zA-Z]+$/", $string);
	}

	public static function isNameAllowed($string){
		return (bool)preg_match("/^[a-zA-Z\s.]+$/", $string);
	}

	public static function isPasswordLength($string){
		return (bool)(strlen($string) > 8 && strlen($string) < 32);
	}

	public static function isEmail($string, $exclude=""){
		if(self::textHit($string, $exclude)) return false;
		return (bool)preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i", $string);
	}

	public static function isSex($value){
		return (bool)($value == 0 || $value == 1);
	}

	public static function isUnsignedNumber($integer){
		return (bool)preg_match("/^\+?[0-9]+$/",$integer);
	}

	public static function getRoleName($value){
		/*
			// USER ROLE
			define("BANNED_USER", -1);
			define("NORMAL_USER", 0);
			define("INVENTORY_USER", 1);
			define("FINANCIAL_USER", 2);
			define("ADMIN_USER", 3);
		*/
		switch($value){
			case -1:
				return "BANNED_USER";
			case 0:
				return "NORMAL_USER";
			case 1:
				return "INVENTORY_USER";
			case 2:
				return "FINANCIAL_USER";
			case 3:
				return "ADMIN_USER";
			default:
				return "BANNED_USER";
		}
	}
}


?>