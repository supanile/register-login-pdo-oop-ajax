<?php 

    include_once "connection.php";

    class Websystem {

        private $db;

        public function __construct() {
            $this->db = connectDB();
        }

        public function registerUser($name, $email, $password) {
            try {

                // Check if email already exists
                $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    echo json_encode([
                        'message' => 'Email already exists',
                        'status' => 400,
                        'success' => false
                    ]);
                    return;
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
                $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password]);

                echo json_encode([
                    'message' => 'Registration successfully!',
                    'status' => 200,
                    'success' => true
                ]);

            } catch(PDOException $e) {
                echo json_encode([
                    'message' => 'A server error occured',
                    'status' => 500,
                    'success' => false
                ]);
            }
        }

        public function loginUser($email, $password) {
            try {

                $stmt = $this->db->prepare("SELECT id, email, password FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['userId'] = $user['id'];
                        echo json_encode([
                            'message' => 'User login successfully',
                            'status' => 200,
                            'success' => true
                        ]);
                    } else {
                        echo json_encode([
                            'message' => 'Invalid email or password',
                            'status' => 400,
                            'success' => false
                        ]);
                    }
                } else {
                    echo json_encode([
                        'message' => 'Email does not exist.',
                        'status' => 400,
                        'success' => false
                    ]);
                }

            } catch(PDOException $e) {
                echo json_encode([
                    'message' => 'A server error occured',
                    'status' => 500,
                    'success' => false
                ]);
            }
        }

        public function displayData() {
            try {

                $userData = $this->db->prepare("SELECT * FROM users WHERE id = :id");
                $userData->execute([':id' => $_SESSION['userId']]);
                return $userData->fetch(PDO::FETCH_ASSOC);

            } catch(PDOException $e) {
                echo json_encode([
                    'message' => 'A server error occured',
                    'status' => 500,
                    'success' => false
                ]);
            }
        }

    }


?>