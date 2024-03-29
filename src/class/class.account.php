<?php

class Account{
    
    function __construct() {
        $this->accountDB = new Database("127.0.0.1", "root", "", "account");
	}

    public function registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth){      
        if(!empty($ret = Common::validateEmail($strEmail))) return $ret;
        if($this->emailExists($strEmail)) return "Email is already registered";
        if(!empty($ret = Common::validatePassword($strPass, $strCPass))) return $ret;
        if(!empty($ret = Common::validateName($strName))) return $ret;
        if(!empty($ret = Common::validateAddress($strAddress))) return $ret;
        if(!empty($ret = Common::validateContactNo($strContactNo))) return $ret;
        if($this->contactNoExists($strContactNo)) return "Contact No is already registered";
        if(!empty($ret = Common::validateSex($bSex))) return $ret;
        if(!empty($ret = Common::validateDate($dateOfBirth))) return $ret;

        $hash_pass =  hash("sha512", $strEmail.$strPass);

        $result = $this->accountDB->query("INSERT INTO users(Email, Name, Pass, Address, ContactNo, Sex, BirthDate) VALUES(?, ?, ?, ?, ?, ?, ?)", array($strEmail, $strName, $hash_pass, $strAddress, $strContactNo, $bSex, $dateOfBirth));
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";

        return ""; 
    }

    public function loginAccount($strEmail, $strPass, $isRemember = false /* Todo if still have time lols */){
        if(!empty($ret = Common::validateEmail($strEmail))) return $ret;

        $hash_pass =  hash("sha512", $strEmail.$strPass);
        $result = $this->accountDB->query_fetch_single("SELECT users.AccountID, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = roleinfo.AccountID WHERE Email = ? AND Pass = ?", array($strEmail, $hash_pass));
        if(!is_array($result)) return "Login Failed";

        $accountInfo = $this->getAccountInfo(intval($result["AccountID"]));
        if(!is_array($accountInfo)) return "System Error! Contact Administrator";
        if(Common::getRoleName(intval($accountInfo["RoleID"])) == "BANNED_USER")
            return "This account is banned from this website.";

        $_SESSION['login'] = true;
        $_SESSION['userId'] = $result['AccountID'];
        $_SESSION['roleId'] = $result['RoleID'];

        header("Location: " . __BASE_URL__ . "home");
        die();
    }

    public function logoutAccount(){
        session_unset();
        header("Location: ".__BASE_URL__);
        die();
    }
    
    public function changePassword($accountID, $strPass, $strCPass, $isAdmin = false, $strCurrPass = ""){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!$isAdmin)
            if(!Common::checkValue($strCurrPass)) return "Current password is empty";
        if(!empty($ret = Common::validatePassword($strPass, $strCPass))) return $ret;

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

    public function changeRole($accountID, $newRole){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!empty($ret = Common::validateRole($newRole))) return $ret;

        $result = $this->accountDB->query("UPDATE roleinfo SET RoleID = ? WHERE AccountID = ?", array($newRole, $accountID));
        if(!$result) return "Change role request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 
        
    }

    public function changeName($accountID, $newName){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!empty($ret = Common::validateName($newName))) return $ret;

        $result = $this->accountDB->query("UPDATE users SET Name = ? WHERE AccountID = ?", array($newName, $accountID));
        if(!$result) return "Change name request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function changeSex($accountID, $newSex){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!empty($ret = Common::validateSex($newSex))) return $ret;

        $result = $this->accountDB->query("UPDATE users SET Sex = ? WHERE AccountID = ?", array($newSex, $accountID));
        if(!$result) return "Change sex request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function changeEmail($accountID, $newEmail, $currPass){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!empty($ret = Common::validateEmail($newEmail))) return $ret;
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
        if(!empty($ret = Common::validateAddress($newAddress))) return $ret;

        $result = $this->accountDB->query("UPDATE users SET Address = ? WHERE AccountID = ?", array($newAddress, $accountID));
        if(!$result) return "Change address request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 

    }

    public function changeBirth($accountID, $newdateOfBirth){
        if(!Common::checkValue($accountID)) return "AccountID is weird why it's empty!?";
        if(!empty($ret = Common::validateDate($newdateOfBirth))) return $ret;

        $result = $this->accountDB->query("UPDATE users SET BirthDate = ? WHERE AccountID = ?", array($newdateOfBirth, $accountID));
        if(!$result) return "Change birthdate request not successfully registered for unknown reasons. Contact Administrator";

        return ""; 

    }

    public function changeContactNo($accountID, $newContactNo){
        if(!empty($ret = Common::validateContactNo($newContactNo))) return $ret;
        if($this->contactNoExists($newContactNo)) return "Contact No is already registered";

        $result = $this->accountDB->query("UPDATE users SET ContactNo = ? WHERE AccountID = ?", array($newContactNo, $accountID));
        if(!$result) return "Change contact number request not successfully registered for unknown reasons. Contact Administrator";

        return "";
    }

    public function contactNoExists($contact){
        $result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE contactno = ?", array($contact));
		if(is_array($result)) return true;
		return false;
    }

    public function emailExists($email) {
		$result = $this->accountDB->query_fetch_single("SELECT * FROM users WHERE email = ?", array($email));
		if(is_array($result)) return true;
		return false;
	}

    public function getAccountList(){
        $result = $this->accountDB->query_fetch("SELECT users.*, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = roleinfo.AccountID;");
        if(is_array($result)) return $result;
    }

    public function getUserRole($uid){
        $result = $this->accountDB->query_fetch_single("SELECT RoleID FROM roleinfo WHERE AccountID = ?", array($uid));
        if(is_array($result)) return $result;
    }

    public function getAccountInfo($uid){
        $result = $this->accountDB->query_fetch_single("SELECT users.*, roleinfo.RoleID FROM users INNER JOIN roleinfo ON users.AccountID = ? AND roleinfo.AccountID = ?", array($uid, $uid));
        if(is_array($result)) return $result;
    }

    public function getAccountName($uid){
        $result = $this->accountDB->query_fetch_single("SELECT Name FROM users WHERE AccountID = ?", array($uid));
        if(is_array($result)) return $result;
    }

}



?>