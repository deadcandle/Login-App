<?php
    // Functie: classdefinitie User 
    // Auteur: Wigmans

    class User {

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
            echo "<br>Username: ".$_SESSION['user']['user_username']."<br>";
            echo "<br>Password: ".$_SESSION['user']['user_password']."<br>";
            echo "<br>Email: ".$_SESSION['user']['user_email']."<br>";
        }

        public function RegisterUser() {
            $status = false;
            $errors=[];
            if ($this->username != "" || $this->password != "") {

                // Check user exist
                $conn = new mysqli("localhost", "root", "123456", "loginapp");
                $result = ($conn -> query("SELECT * FROM users WHERE user_username = '$this->username'"));

                if (mysqli_num_rows($result) > 0) {
                    array_push($errors, "Username bestaat al.");
                } else {
                    // username opslaan in tabel login
                    $result = ($conn -> query("INSERT INTO users (user_username, user_password, user_email) values ('".$this->username."', '".$this->password."', '123456@student.zadkine.nl');"));
                    
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
            $result = ($conn -> query("SELECT * FROM users WHERE user_username = '$this->username' and user_password = '$this->password'")) -> fetch_assoc();
            $this->username = $result["user_username"];
            $this->password = $result["user_password"];

            // Zet de user in de sessie
            session_start();
            $_SESSION["user"] = $result;
            
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