<?php 
    class Users extends Controller
    {
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        // Login for users
        public function login()
        {
            if (isLoggedIn()) {
                header('Location: /posts');
            }

            $data = [
                'title' => 'Вход',
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => '',
            ];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = trim(htmlspecialchars($value, ENT_QUOTES));
                    $data[$key] = $_POST[$key];
                }

                // Email validation
                if (empty($data['email'])) {
                    $data['emailError'] = 'Email не может быть пустым!';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Email не похож на email!';
                }

                // Password validation
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Пароль не может быть пустым!';
                }elseif(strlen($data['password']) < 4) {
                    $data['passwordError'] = 'Пароль не может быть короче 4 символов!';
                }

                if (empty($data['emailError']) && empty($data['passwordError'])) {
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                        header('Location: /posts');
                    }else {
                        $data['passwordError'] = 'Неправильный email или пароль!';
                    }
                }
            }


            $this->view('/users/login', $data);
        }

        public function createUserSession($user)
        {
            session_start();

            $_SESSION = (array)$user;
            unset($_SESSION['password']);

        }

        // Registration for users
        public function register()
        {
            if (isLoggedIn()) {
                header('Location: /posts');
            }

            $data = [
                'title' => 'Регистрация',
                'email' => '',
                'username' => '',
                'password' => '',
                'emailError' => '',
                'usernameError' => '',
                'passwordError' => '',
            ];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = trim(htmlspecialchars($value, ENT_QUOTES));
                    $data[$key] = $_POST[$key];
                }

                // Email validation
                if (empty($data['email'])) {
                    $data['emailError'] = 'Email не может быть пустым!';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Email не похож на email!';
                }else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['emailError'] = 'Такой email уже занят!';
                    }
                }

                // Username validation
                $nameValidation = "/^[a-zA-z0-9]*$/";

                if (empty($data['username'])) {
                    $data['usernameError'] = 'Логин не может быть пустым!';
                }elseif(!preg_match($nameValidation, $data['username'])) {
                    $data['usernameError'] = 'Логин может содержать только цифры и латинские буквы!';
                }

                // Password validation
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Пароль не может быть пустым!';
                }elseif(strlen($data['password']) < 4) {
                    $data['passwordError'] = 'Пароль не может быть короче 4 символов!';
                }

                // Check errors and register
                if (empty($data['emailError']) && empty($data['usernameError']) && empty($data['passwordError'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if($this->userModel->register($data)) {
                        header('Location: /posts');
                    }else {
                        die('Что-то не так');
                    }
                }
            }

            $this->view('/users/register', $data);
        }

        // Users logout
        public function logout()
        {
            if (isLoggedIn()) {
                session_unset();
            }

            header('Location: /users/login');
        }
    }