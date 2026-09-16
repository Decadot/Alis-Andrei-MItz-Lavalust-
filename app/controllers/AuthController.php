<?php

class AuthController extends Controller
{
    public function index()
    {
        redirect('/login');
    }

    public function signup()
    {
        $this->call->view('signup', ['error' => '', 'success' => '']);
    }

    public function signupPost()
    {
        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($name === '' || $username === '' || $password === '' || $confirm_password === '') {
            $this->call->view('signup', ['error' => 'All fields are required.', 'success' => '']);
            return;
        }

        if ($password !== $confirm_password) {
            $this->call->view('signup', ['error' => 'Passwords do not match.', 'success' => '']);
            return;
        }

        $userModel = $this->call->model('UsersModel');

        $existingUser = $userModel->find_by('username', $username);
        if ($existingUser) {
            $this->call->view('signup', ['error' => 'Username already exists.', 'success' => '']);
            return;
        }

        $userModel->insert([
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $this->call->view('signup', ['error' => '', 'success' => 'Account created successfully. You can now log in.']);
    }

    public function login()
    {
        $this->call->view('login', ['error' => '', 'success' => '']);
    }

    public function loginPost()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->call->view('login', ['error' => 'Username and password are required.', 'success' => '']);
            return;
        }

        $userModel = $this->call->model('UsersModel');
        $user = $userModel->find_by('username', $username);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->call->view('login', ['error' => 'Invalid username or password.', 'success' => '']);
            return;
        }

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        redirect('/dashboard');
    }

    public function dashboard()
    {
        session_start();

        if (empty($_SESSION['user_id'])) {
            redirect('/login');
            return;
        }

        $this->call->view('dashboard', ['username' => $_SESSION['username']]);
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        redirect('/login');
    }
}
