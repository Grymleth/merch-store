<?php

class Common {

    public static function checkValue($value) {
		return (bool)((@count($value)>0 and !@empty($value) and @isset($value)) || $value=='0');
	}

	private static function isLegalDate($date){
		$_date = explode("-", $date);
		$age = (date("md", date("U", mktime(0, 0, 0, $_date[1], $_date[2], $_date[0]))) > date("md")
			? ((date("Y") - $_date[0]) - 1)
			: (date("Y") - $_date[0]));
		# Jeanne Calment oldest human in recorded history with age of 122
		return($age >= 13 && $age <= 122);
	}

	private static function isContactNo($string){
		return (bool)preg_match("/^(\+)[0-9]{7,14}+$/", $string);
	}
	
	private static function isDate($string){
		return (bool)preg_match("/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))+$/i", $string);
	}

	private static function isContactNoLength($string){
		return (bool)(strlen($string) >= 8 && strlen($string) <= 15);
	}

	private static function isAlphaNumeric($string){
		return (bool)preg_match("/^[0-9a-zA-Z]+$/", $string);	
	}

	private static function isAddressAllowed($string){
		return (bool)preg_match("/^[0-9a-zA-Z\s,#-]+$/", $string);	
	}

	private static function isAlpha($string){
		return (bool)preg_match("/^[a-zA-Z]+$/", $string);
	}

	private static function isNameAllowed($string){
		return (bool)preg_match("/^[a-zA-Z\s.]+$/", $string);
	}

	private static function isPasswordLength($string){
		return (bool)(strlen($string) >= 8 && strlen($string) <= 32);
	}

	private static function isPasswordAllowed($string){
		return (bool)preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}+$/", $string);
	}

	private static function isEmail($string){
		return (bool)preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i", $string);
	}

	private static function isSex($value){
		return (bool)($value == 0 || $value == 1);
	}

	private static function isUnsignedNumber($integer){
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

    public static function getDeliveryStatus($value){
		/*
			// USER ROLE
			define("BANNED_USER", -1);
			define("NORMAL_USER", 0);
			define("INVENTORY_USER", 1);
			define("FINANCIAL_USER", 2);
			define("ADMIN_USER", 3);
		*/
		switch($value){
			case 1:
				return "PROCESSING";
			case 2:
				return "PACKED";
			case 3:
				return "SHIPPED";
			case 4:
				return "DELIVERED";
            default:
                return "this cannot be";
		}
	}

	public static function validatePassword($strPass, $strCPass){
		if( 
            !self::checkValue($strPass) ||
            !self::checkValue($strCPass)
        ) return "Password or Confirm Password is Empty";
		if(!self::isPasswordLength($strPass)) return "Password length must be greater than or equals 8 but less than or equals 32";
        if(!self::isPasswordAllowed($strPass)) return "Password must be atleast one uppercase letter, one lowercase letter, one number and one special character";
		if($strPass != $strCPass) return "Password or confirm password not the same";

		return "";
	}

	public static function validateEmail($strEmail){
		if(!self::checkValue($strEmail)) return "Email is empty";
		if(!self::isEmail($strEmail)) return "Email is invalid please input your email correctly (eg. abcd.xyz_123@domain.com )";
		

		return "";
	}

	public static function validateName($strName){
		if(!self::checkValue($strName)) return "Name is empty";
		if(!self::isNameAllowed($strName)) return "Name inputted is invalid";

		return "";
	}

	public static function validateAddress($strAddress){
		if(!self::checkValue($strAddress)) return "Address is empty";
		if(!self::isAddressAllowed($strAddress)) return "This address is not allowed";

		return "";
	}

	public static function validateContactNo($strContactNo){
		if(!self::checkValue($strContactNo)) return "Contact No. is empty";
		if(!self::isContactNoLength($strContactNo)) return "Contact No. length must be greater than 8 or less than or equals 15";
        if(!self::isContactNo($strContactNo)) return "Contact No. is invalid please include the country code if not included (eg. +123456789)";
        
		return "";
	}

	public static function validateSex($bSex){
		if(!self::checkValue($bSex)) return "Sex is empty";
		if(!self::isSex($bSex)) return "This sex is not biologically correct";

		return "";
	}

	public static function validateDate($strDate){
		if(!self::checkValue($strDate)) return "Birthday is empty";
		if(!self::isDate($strDate)) return "Birthday is invalid";
        if(!self::isLegalDate($strDate)) return "Account is underage, 13 to 122 years old of age are only allowed";

		return "";
	}

	public static function validateRole($iRole){
		if(!($iRole >= -1 && $iRole <= 3)) return "Invalid role selected";
		
		return "";
	}

    public static function clampInt($value, $min, $max){
        if($value > $max){
            return $max;
        }
        else if($value < $min){
            return $min;
        }
        else{
            return $value;
        }
    }
}


?>