<?php

class Account{

    function __construct() {
        $this->accountDB = new Database("127.0.0.1", "root", "", "account");
	}

    public function registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth){
        if(!Common::checkValue($strEmail)) return "Email is empty";
        if(!Common::checkValue($strName)) return "Name is empty";
        if(!Common::checkValue($strContactNo)) return "Contact No. is empty";
        if(!Common::checkValue($strAddress)) return "Address is empty";
        if(!Common::checkValue($bSex)) return "Sex is empty";
        if( 
            !Common::checkValue($strPass) ||
            !Common::checkValue($strCPass)
        ) return "Password or Confirm Password is Empty";
        if(!Common::isSex($bSex)) return "This sex is not biologically correct";
        if(!Common::isAddressAllowed($strAddress)) return "This address is not allowed";
        if(!Common::isLegalDate($dateOfBirth)) return "Account is underage, 13 to 122 years old of age are only allowed";
        if($this->emailExists($strEmail)) return "Email is already registered";
        if($this->nameExists($strName)) return "Name is already registered";
        if($this->contactNoExists($strContactNo)) return "Contact No is already registered";
        if($strPass != $strCPass) return "Password or confirm password not the same";
        
            
        $hash_pass =  hash("sha512", $strEmail.$strPass);

        $result = $this->accountDB->query("INSERT INTO users(Email, Name, Pass, Address, ContactNo, Sex, BirthDate) VALUES(?, ?, ?, ?, ?, ?, ?)", array($strEmail, $strName, $hash_pass, $strAddress, $strContactNo, $bSex, $dateOfBirth));
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";

        return ""; 
    }

    public function validateAccount(){

    }
    
    public function changePassword($strPass, $strCPass){
        if( 
            !Common::checkValue($strPass) ||
            !Common::checkValue($strCPass)
        ) return "Password or Confirm Password is Empty";

    }

    public function changeRole(){

    }

    public function changeName(){

    }

    public function changeSex(){

    }

    public function changeEmail(){

    }

    public function changeAddress(){

    }

    public function changeContactNo(){

    }

    public function contactNoExists($contact){
        if(!Common::isContactNo($contact)) return false;
        $result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE contactno = ?", array($contact));
		if(is_array($result)) return true;
		return false;
    }

    public function emailExists($email) {
		if(!Common::isEmail($email)) return false;
		$result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE email = ?", array($email));
		if(is_array($result)) return true;
		return false;
	}

    public function nameExists($name) {
		if(!Common::isAlpha($name)) return false;
		$result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE name = ?", array($name));
		if(is_array($result)) return true;
		return false;
	}

    public function getAccountList(){
        $result = $this->accountDB->query_fetch("SELECT users.*, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = roleinfo.AccountID;");
        if(is_array($result)) return $result;
    }

}



?>