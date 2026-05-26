<?php
    class auth{
        protected $user=[
            'admin' => '123',
            'user' => '123'
        ];
        public function login() {
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                    $_SESSION['username'] = $username;
                    header('Location: /home/index');
                    exit();
                } else {
                    header('Location: /home/login');
                    exit();
                }
            }
        }
    }