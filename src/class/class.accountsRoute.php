<?php 
class AccountsRoute{
    private $db;
    public function __construct($param = null){
        $this->db = new Database(DB_HOST, DB_ACCOUNT_USER, DB_INVENTORY_PASS, DB_ACCOUNT_NAME);
        switch($param){
            case 'login':
                if(isset($_SESSION['login'])){
                    new Error404();
                    break;
                }
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'register':
                if(isset($_SESSION['login'])){
                    new Error404();
                    break;
                }
                $this->register();
                break;
            case 'profile':
                if(!isset($_SESSION['login'])){
                    new Error404();
                    break;
                }
                $this->profile();
                break;
            case 'transactions':
                $this->transactions();
                break;
            default:
                new Error404();
                break;
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // hash password
            // $data['password'] = hash('SHA512', $data['email'] . $data['password']);

            $account = new Account();

            $result = $account->loginAccount($_POST['email'], $_POST['password']);

            // $result = $this->db->query_fetch_single('SELECT accountid, email, pass, name FROM users WHERE email = ? AND pass = ?', array($data['email'], $data['password']));
            // if($result){
            //     // redirect to home page
            //     $_SESSION['login'] = true;
            //     $_SESSION['userId'] = $result['accountid'];
            //     header('location: '. __BASE_URL__ . 'home');
            // }
            // else{
            //     $data['error'] = 'Invalid email or password.';
            // }
        }
        
        require_once "src/pages/login.php";
        
    }

    public function logout(){
        session_unset();
        header('location: '. __BASE_URL__);
    }

    public function register(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $reg_result = "_";
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

            $account = new Account();

            $reg_result = $account->registerAccount(
                $_POST['email'],
                $_POST['firstName'] . " " . $_POST['lastName'],
                $_POST['password'],
                $_POST['repeatPassword'],
                $_POST['address'],
                $_POST['contactno'],
                $_POST['sex'],
                $_POST['birthdate'],
            );
        }

        require_once "src/pages/register.php";
        
    }

    public function profile(){
        require_once "src/pages/profile.php";
    }

    public function transactions(){
        require_once "src/pages/transactions.php";
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