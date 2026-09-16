<?php

class UsersController extends Controller
{
    public function index()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $usersModel = $this->call->model('Usersmodel');

        $this->renderIndex($usersModel);
    }

    public function store()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $usersModel = $this->call->model('Usersmodel');

        if ($name === '' || $username === '' || $password === '' || $confirmPassword === '') {
            $this->renderIndex($usersModel, 'All fields are required.', compact('name', 'username'));
            return;
        }
        if ($password !== $confirmPassword) {
            $this->renderIndex($usersModel, 'Passwords do not match.', compact('name', 'username'));
            return;
        }
        if ($usersModel->find_by('username', $username)) {
            $this->renderIndex($usersModel, 'That username is already in use.', compact('name', 'username'));
            return;
        }

        $usersModel->insert([
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        redirect('/users');
    }

    public function edit($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $usersModel = $this->call->model('Usersmodel');
        $user = $usersModel->find($id);
        if (!$user) {
            redirect('/users');
            return;
        }
        $this->call->view('user_form', ['user' => $user, 'error' => '']);
    }

    public function update($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $usersModel = $this->call->model('Usersmodel');
        $user = $usersModel->find($id);
        if (!$user) {
            redirect('/users');
            return;
        }
        $formUser = array_merge($user, compact('name', 'username'));
        if ($name === '' || $username === '') {
            $this->call->view('user_form', ['user' => $formUser, 'error' => 'Name and username are required.']);
            return;
        }
        if ($password !== $confirmPassword) {
            $this->call->view('user_form', ['user' => $formUser, 'error' => 'Passwords do not match.']);
            return;
        }
        $existingUser = $usersModel->find_by('username', $username);
        if ($existingUser && (int) $existingUser['id'] !== (int) $id) {
            $this->call->view('user_form', ['user' => $formUser, 'error' => 'That username is already in use.']);
            return;
        }
        $data = ['name' => $name, 'username' => $username];
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $usersModel->update($id, $data);
        redirect('/users');
    }

    public function delete($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $this->call->model('Usersmodel')->delete($id);
        redirect('/users');
    }

    private function renderIndex($usersModel, $error = '', $old = [])
    {
        $this->call->view('users', ['users' => $usersModel->all(), 'error' => $error, 'old' => $old]);
    }

    private function requireLogin()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            redirect('/login');
            return false;
        }

        return true;
    }
}
