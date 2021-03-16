<?php 
class Accounts{
    private $db;
    public function __construct($param = null){
        $this->db = new Database(DB_HOST, DB_ACCOUNT_USER, DB_INVENTORY_PASS, DB_ACCOUNT_NAME);
        switch($param){
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'register':
                $this->register();
                break;
            case 'profile':
                $this->profile();
                break;
            default:
                new Error404();
                break;
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'error' => ''
            ];
            // hash password
            $data['password'] = hash('SHA512', $data['email'] . $data['password']);

            $result = $this->db->query_fetch_single('SELECT accountid, email, pass, name FROM users WHERE email = ? AND pass = ?', array($data['email'], $data['password']));
            if($result){
                // redirect to home page
                $_SESSION['login'] = true;
                $_SESSION['userId'] = $result['accountid'];
                header('location: '. __BASE_URL__ . 'home');
            }
            else{
                $data['error'] = 'Invalid email or password.';
            }
        }
        
        require_once "src/pages/login.php";
        
    }

    public function logout(){
        session_unset();
        header('location: '. __BASE_URL__);
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'email' => trim($_POST['email']),
                'name' => trim($_POST['firstName']) . ' ' . trim($_POST['lastName']),
                'password' => trim($_POST['password']),
                'birthdate' => trim($_POST['birthdate']),
                'sex' => trim($_POST['sex']),
                'address' => trim($_POST['address']),
                'contactno' => trim($_POST['contactno']),
                'repeatPassword' => trim($_POST['repeatPassword']),
            ];

            $error = [];

            // validate name
            if(empty($_POST['firstName'])){
                array_push($error, 'Please enter first name.');
            }

            if(empty($_POST['lastName'])){
                array_push($error, 'Please enter last name.');
            }

            // Validate username on letters/numbers
            if(empty($data['email'])){
                array_push($error, 'Please enter email address.');
            }
            else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                array_push($error, 'Please enter a valid email.');
            }
            else{
                // check if email exists
                if($this->findUserByEmail($data['email'])){
                    array_push($error, 'Email is already taken.');
                }
            }

            $passwordValidation = "/.*[0-9].*/i";
            $contactValidation = "/^[0-9]*$/";

            // validate password on length and numeric values
            if(empty($data['password'])){
                array_push($error, 'Please enter password.');
            }
            else if(strlen($data['password']) <= 8 || strlen($data['password']) >= 32){
                array_push($error, 'Password length must be greater than 8 but less than 32.');
            }
            else if(!preg_match($passwordValidation, $data['password'])){
                echo $data['password'];
                array_push($error, 'Password must have at least 1 numeric value.');
            }

            // Validate repeat password
            if(empty($data['repeatPassword'])){
                $data['repeatPassword'] = 'Please confirm password.';
            }
            else {
                if($data['password'] != $data['repeatPassword']){
                    array_push($error, 'Passwords do not match, please try again');
                }
            }

            //validate birthday and if legal
            if(empty($data['birthdate'])){
                array_push($error, 'Please enter date of birth.');
            }
            else{
                if(!$this->isLegalDate($data['birthdate'])){
                    array_push($error, 'Must be 13+ years old.');
                }
            }

            // validate address
            if(empty($data['address'])){
                array_push($error, 'Please enter address.');
            }

            // validate sex
            if(!($data['sex'] == '0' || $data['sex'] == '1')){
                array_push($error, 'Please select valid sex.');
            }

            // Validate contact number
            if(empty($data['contactno'])){
                array_push($error, 'Please enter contact number');
            }
            else if(!preg_match($contactValidation, $data['contactno'])){
                array_push($error, 'Please enter valid contact number');
            }

            // make sure that errors are empty
            if(count($error) == 0){

                // Hash password
                $data['password'] = hash('SHA512', $data['email'] . $data['password']);
                $this->registerUser($data);
            }
        }

        require_once "src/pages/register.php";
        
    }

    public function profile(){
        require_once "src/pages/profile.php";
    }

    public function findUserByEmail($email){
        $result = $this->db->query_fetch_single('SELECT accountid, name, email, pass, address FROM users WHERE email = ?' , array($email));

        return $result;
    }

    public function registerUser($data){
        // change this please
        $result = $this->db->query('INSERT INTO users (email, name, pass, address, contactno, birthdate, sex)
            VALUES(?, ?, ?, ?, ?, ?, ?)', 
            array($data['email'], $data['name'], $data['password'], $data['address'], $data['contactno'], $data['birthdate'], $data['sex']));

        return $result;
    }

    public function isLegalDate($date){
        $_date = explode("-", $date);
        $age = (date("md", date("U", mktime(0, 0, 0, $_date[1], $_date[2], $_date[0]))) > date("md")
            ? ((date("Y") - $_date[0]) - 1)
            : (date("Y") - $_date[0]));
        # Jeanne Calment oldest human in recorded history with age of 122
        return($age >= 13 && $age <= 122);
    }
}

?>