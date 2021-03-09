<?php 

class Accounts{
    private $db;
    public function __construct($param = null){
        $this->db = new Database(DB_HOST, DB_ACCOUNT_USER, DB_INVENTORY_PASS, DB_ACCOUNT_NAME);
        switch($param){
            case 'login':
                $this->login();
                break;
            case 'register':
                $this->register();
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

            if($this->db->query_fetch_single('SELECT email, pass FROM users WHERE email = ? AND pass = ?', array($data['email'], $data['password']))){
                // redirect to home page
                header('location: '. __BASE_URL__ . 'home');
            }
            else{
                $data['error'] = 'Invalid email or password.';
            }

            if(empty($data['error'])){
                header('location: '. __BASE_URL__ . 'home/success');
            }
        }
        
        require_once "src/pages/login.php";
        
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'name' => trim($_POST['firstName']) . ' ' . trim($_POST['lastName']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'address' => trim($_POST['address']),
                'contactno' => trim($_POST['contactno']),
                'repeatPassword' => trim($_POST['repeatPassword']),
                'firstNameError' => '',
                'lastNameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'repeatPasswordError' => '',
                'addressError' => '',
                'contactError' => ''
            ];

            // validate name
            if(empty($data['firstName'])){
                $data['firstNameError'] = 'Please enter first name.';
            }

            if(empty($data['lastName'])){
                $data['lastNameError'] = 'Please enter last name.';
            }

            // Validate username on letters/numbers
            if(empty($data['email'])){
                $data['emailError'] = 'Please enter email address.';
            }
            else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailrError'] = 'Please enter a valid email.';
            }
            else{
                // check if email exists
                if($this->findUserByEmail($data['email'])){
                    $data['emailError'] = 'Email is already taken.';
                }
            }

            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            $contactValidation = "/^[0-9]*$/";

            // validate password on length and numeric values
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter password.';
            }
            else if(strlen($data['password'] < 6)){
                $data['passwordError'] = 'Password must be at least 8 characters.';
            }
            else if(!preg_match($passwordValidation, $data['password'])){
                $data['passwordError'] = 'Password must have at least 1 numeric value.';
            }

            // Validate repeat password
            if(empty($data['repeatPassword'])){
                $data['repeatPassword'] = 'Please confirm password.';
            }
            else {
                if($data['password'] != $data['repeatPassword']){
                    $data['repeatPasswordError'] = 'Passwords do not match, please try again';
                }
            }

            if(empty($data['address'])){
                $data['addressError'] = 'Please enter address.';
            }

            // Validate contact number
            if(empty($data['contactno'])){
                $data['contactError'] = 'Please enter contact number';
            }
            else if(!preg_match($contactValidation, $data['contactno'])){
                $data['contactError'] = 'Please enter valid contact number';
            }

            // make sure that errors are empty
            if(empty($data['emailError']) && empty($data['passwordError']) && 
            empty($data['repeatPasswordError']) && empty($data['contactError'])){

                // Hash password
                $data['password'] = hash('SHA512', $data['email'] . $data['password']);
                
                if($this->registerUser($data)){
                    // redirect to login page
                    header('location: '. __BASE_URL__ . 'accounts/login');
                }
                else{
                    die('Something went wrong');
                }
            }
        }

        require_once "src/pages/register.php";
        
    }

    public function findUserByEmail($email){
        $result = $this->db->query_fetch_single('SELECT accountid, name, email, pass, address FROM users WHERE email = ?' , array($email));

        return $result;
    }

    public function registerUser($data){
        // change this please
        $result = $this->db->query('INSERT INTO users (email, name, pass, address, contactno)
            VALUES(?, ?, ?, ?, ?)', array($data['email'], $data['name'], $data['password'], $data['address'], $data['contactno']));

        return $result;
    }
}

?>