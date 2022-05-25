<?php 
    class User
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function register($data)
        {
            $this->db->query( 'INSERT INTO users (username, email, password, created_at, updated_at) VALUES (:username, :email, :password, :created_at, :updated_at)' );

            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':created_at', date('Y-m-d h:m:s'));
            $this->db->bind(':updated_at', date('Y-m-d h:m:s'));

            if ($this->db->execute()) {
                return true;
            }else {
                return false;
            }
        }

        public function login($email, $password)
        {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashedPassword = $row->password;

            if (password_verify($password, $hashedPassword)) {
                return $row;
            }else {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email)
        {
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email', $email);

            if ($this->db->rowCount() > 0) {
                return true;
            }else {
                return false;
            }
        }
    }