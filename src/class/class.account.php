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
        if(!Common::checkValue($dateOfBirth)) return "Birthday is empty";
        if( 
            !Common::checkValue($strPass) ||
            !Common::checkValue($strCPass)
        ) return "Password or Confirm Password is Empty";
        if(!Common::isSex($bSex)) return "This sex is not biologically correct";
        if(!Common::isAddressAllowed($strAddress)) return "This address is not allowed";
        if(!Common::isLegalDate($dateOfBirth)) return "Account is underage, 13 to 122 years old of age are only allowed";
        if(!Common::isPasswordLength($strPass)) return "Password length must be greter than 8 but less than 32";
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
    
    public function changePassword($accountID, $strPass, $strCPass, $isAdmin = false, $strCurrPass = ""){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!$isAdmin)
            if(!Common::checkValue($strCurrPass)) return "Current password is empty";
        if( 
            !Common::checkValue($strPass) ||
            !Common::checkValue($strCPass)
        ) return "Password or Confirm Password is Empty";
        if(!Common::isPasswordLength($strPass)) return "Password length must be greter than 8 but less than 32";
        if($strPass != $strCPass) return "Password or confirm password not the same";

        $result = $this->accountDB->query_fetch_single("SELECT Email FROM users WHERE AccountID = ?", array($accountID));
        if(!is_array($result)) return "Current Registered Email not exists. Contact Administrator";
        $currEmail = $result["Email"];

        if(!$isAdmin){
            $hash_pass = hash("sha512", $currEmail.$strCurrPass);
            $result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE AccountID = ? AND Pass = ?", array($accountID, $hash_pass));
            if(!is_array($result)) return "Current password for verification is wrong";
        }

        $hash_pass = hash("sha512", $currEmail.$strPass);
        $result = $this->accountDB->query("UPDATE users SET Pass = ? WHERE AccountID = ?", array($hash_pass, $accountID));
        if(!$result) return "Change password request not successfully registered for unknown reasons. Contact Administrator";

        return "";

    }

    public function changeRole(){

    }

    public function changeName($accountID, $newName){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!Common::checkValue($newName)) return "Name is empty";
        if($this->nameExists($newName)) return "Name is already registered";

        $result = $this->accountDB->query("UPDATE users SET Name = ? WHERE AccountID = ?", array($newName, $accountID));
        if(!$result) return "Change name request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function changeSex(){

    }

    public function changeEmail($accountID, $newEmail, $currPass){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!Common::checkValue($newEmail)) return "Email is empty";
        if(!Common::checkValue($currPass)) return "Current password is empty";
        if($this->emailExists($newEmail)) return "Email is already registered";

        $result = $this->accountDB->query_fetch_single("SELECT Email FROM users WHERE AccountID = ?", array($accountID));
        if(!is_array($result)) return "Current Registered Email not exists. Contact Administrator";
        $currEmail = $result["Email"];

        $hash_pass = hash("sha512", $currEmail.$currPass);
        $result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE AccountID = ? AND Pass = ?", array($accountID, $hash_pass));
        if(!is_array($result)) return "Current password for verification is wrong";

        $hash_pass = hash("sha512", $newEmail.$currPass);
        $result = $this->accountDB->query("UPDATE users SET Pass = ?, Email = ? WHERE AccountID = ?", array($hash_pass, $newEmail, $accountID));
        if(!$result) return "Change email request not successfully registered for unknown reasons. Contact Administrator";

        return "";
    }

    public function changeAddress($accountID, $newAddress){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!Common::checkValue($newAddress)) return "Address is empty";
        if(!Common::isAddressAllowed($newAddress)) return "This address is not allowed";

        $result = $this->accountDB->query("UPDATE users SET Address = ? WHERE AccountID = ?", array($newAddress, $accountID));
        if(!$result) return "Change address request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 

    }

    public function changeBirth($accountID, $newdateOfBirth){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!Common::checkValue($newdateOfBirth)) return "Birthday is empty";
        if(!Common::isLegalDate($newdateOfBirth)) return "Account is underage, 13 to 122 years old of age are only allowed";

        $result = $this->accountDB->query("UPDATE users SET BirthDate = ? WHERE AccountID = ?", array($newdateOfBirth, $accountID));
        if(!$result) return "Change birthdate request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 

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
		if(!Common::isNameAllowed($name)) return false;
		$result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE name = ?", array($name));
		if(is_array($result)) return true;
		return false;
	}

    public function getAccountList(){
        $result = $this->accountDB->query_fetch("SELECT users.*, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = roleinfo.AccountID;");
        if(is_array($result)) return $result;
    }

    public function getAccountInfo($uid){
        $result = $this->accountDB->query_fetch_single("SELECT users.*, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = ? AND roleinfo.AccountID = ?", array($uid, $uid));
        if(is_array($result)) return $result;
    }

}



?>