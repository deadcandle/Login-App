<?php
    // Functie: classdefinitie User 
    // Auteur: Wigmans

    class User{

        // Eigenschappen 
        public $username;
        public $email;
        private $password;
        
        function SetPassword($password) {
            $this -> password = $password;
        }
        function GetPassword() {
            return $this -> password;
        }

        public function ShowUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
        }

        public function RegisterUser() {
            $status = false;
            $errors=[];
            if($this->username != "" || $this->password != "") {

                // Check user exist
                if(true){
                    array_push($errors, "Username bestaat al.");
                } else {
                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1
                    
                    $status = true;
                }
                            
                
            }
            return $errors;
        }

        function ValidateUser() {
            $errors=[];

            if (empty($this->username)) {
                array_push($errors, "Invalid username");
            } else if (empty($this->password)) {
                array_push($errors, "Invalid password");
            }

            // Test username > 3 tekens en < 50 tekens
            
            return $errors;
        }

        public function LoginUser() {

            // Connect database
            $conn = new mysqli("localhost", "root", "123456", "loginapp");

            // Zoek user in de table user
            $result = $conn -> query("SELECT * FROM users WHERE user_username = '$this->username'");

            // Zet de user in de sessie
            session_start();
            $_SESSION["user"] = $result -> fetch_assoc();
            
            return true;
        }

        // Check if the user is already logged in
        public function IsLoggedin() {
            if (isset($_SESSION["user"])) {
                return true;
            }
            return false;
        }

        public function GetUser($username) {
            
		    // Doe SELECT * from user WHERE username = $username
            if (false) {
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
            } else {
                return NULL;
            }   
        }

        public function Logout() {
            session_start();
            
            // remove all session variables / destroy the session
            session_destroy();
            
            header('location: index.php');
        }


    }

    

?>