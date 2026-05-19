<?php
class auth
{
    protected $username = [
        'admin' => '123456',
        'tien' => '123456',
    ];

    public function login()
    {
        if (isset($_POST['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (isset($this->username[$username]) && $this->username[$username] === $password) {
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
?>