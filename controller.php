<?php
    Class Task1 {
        private $database = "users.db";
        public $session_name = "brain-x";
        public $message_types = array(0 => "error", 1 => "success", 2 => "info");

        /**
         * @param string $message The alert message
         * @param int $type The alert type, according to $message_types 
         * @param string $link A link to redirect the user to another action,
         *  e.g login after successful sign up.
         * @param string $link_msg The clickable text for the specified link.
         * @return void Echoes a HTML alert box containing the message and/or link
         */
        function alert($message, $type = 2, $link = "", $link_msg = "") {
            $alert_type = $this->message_types[$type];
            $title = ucfirst($alert_type);

			echo "<div id='modal_background' onclick='closeModal();'>
					<div class='alert alert-$alert_type'>
						<span class='closebtn' onclick='closeModal();'>&times;</span>
                        <p>
                            <span class='alert-title'>$title!</span>
                            $message
                        </p>
                        <a href='$link' class='alert-link'>$link_msg</a>
					</div>
				</div>";
        }

        /**
         * @param string $username Account username
         * @param string $password Account password
         * @return json containing status of the login, true if successful
         * Uses sessions
         */
        function signIn($username, $password) {
            $db = file_get_contents($this->database);
            $db_contents = json_decode($db, true);

            if (!empty($db_contents) && $this->userExists($username)) {
                $saved_pass = $db_contents["$username"]["password"];
                if (password_verify($password, $saved_pass)) {
                    $_SESSION[$this->session_name] = md5($username);
                    return $this->sendResponse("Login successful", true);
                } else {
                    return $this->sendResponse("Invalid username or password", false);
                }
            } else {
                $this->signOut();
                return $this->sendResponse("Account not registered");
            }
        }

        /**
         * Unsets a session
         */
        function signOut() {
            @session_start();
			if(isset($_SESSION[$this->session_name])){
				session_unset();
            }	
            return $this->sendResponse("You have been logged out", true);
        }

        /**
         * @param string $email The email address of the new account
         * @param string $username The username for the new account
         * @param string $password Password for new user account
         * - Registers a new user if the username is not already taken.
         * - Hashes the password using BCrypt.
         * - Stores the account as a json object in the flat file database and uses the username as key.
         * @return json A json object based on the sendResponse() function  
         */
        function signUp($email, $username, $password) {
            if (!$this->userExists($username)) {
               
                $pash = password_hash($password, PASSWORD_BCRYPT);
            
                if (!file_exists($this->database)) {
                    $fp = fopen($this->database, 'w'); 
                    fclose($fp);
                }
                $db = file_get_contents($this->database);
                $db_contents = json_decode($db, true);
                
                if (empty($db_contents)){
                    $new_user = array(
                        $username => array(
                            'email' => "$email",
                            'username'=> "$username",
                            'password' => "$pash"
                        )
                    );
                    
                    $db_contents = json_encode($new_user, JSON_FORCE_OBJECT);
                } else if (is_array($db_contents)) {  
                    $new_user = array('email' => "$email", 'password' => "$pash");
                    $db_contents["$username"] = $new_user;
                    $db_contents = json_encode($db_contents, JSON_FORCE_OBJECT);
                }
                
                $fp = fopen($this->database, 'w'); 
                $saved = fwrite($fp, $db_contents); 
                fclose($fp);      
                
                if ($saved) {
                    return $this->sendResponse("Account created", true);
                } else {
                    return $this->sendResponse("Could not register account", false);
                }
            } else {
                return $this->sendResponse("Username already registered", false);
            }
        }

        /**
         * @param string $username the username to be searched for within the database
         * @return bool  Checks if a particular username is registered. Returns true if so.
         * - Could be extended to check if the email address exists...
         */
        function userExists($username) {
            $db = file_get_contents($this->database);
            $db_contents = json_decode($db, true);

            if (!empty($db_contents)) {
                if (array_key_exists($username, $db_contents)) {
                    return true;
                }
            }
            return false;
        }

        /**
         * @param string $message The response message, if any. e.g "Username already registered"
         * @param boolean $status The status of the response
         * @return json Returns a json object of the message and the status
         */
        function sendResponse($message = "No message", $status = false) {
            if ($message === null) $message = 'No message';
            if ($status === null) $status = false;
      
            return json_encode(
              array(
                'message' => $message,
                'status' => $status
              )
            );      
        }

        /**
         * @param json $response A json object from the sendResponse() function
         * @return array An associative array of the response's status and message
         */
        function getResponse($response) {
            return json_decode($response);
        }
    }
?>