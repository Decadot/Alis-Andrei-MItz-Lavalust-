<?php

class MembersController extends Controller
{
    public function index()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $memberModel = $this->call->model('MembersModel');
        $members = $memberModel->all();

        $this->call->view('members', ['members' => $members, 'error' => '', 'success' => '']);
    }

    public function store()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $memberModel = $this->call->model('MembersModel');

        if ($name === '' || $username === '' || $password === '' || $confirm_password === '') {
            $members = $memberModel->all();
            $this->call->view('members', ['members' => $members, 'error' => 'All fields are required.', 'success' => '']);
            return;
        }

        if ($password !== $confirm_password) {
            $members = $memberModel->all();
            $this->call->view('members', ['members' => $members, 'error' => 'Passwords do not match.', 'success' => '']);
            return;
        }

        $memberModel->insert([
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        redirect('/members');
    }

    public function edit($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $memberModel = $this->call->model('MembersModel');
        $member = $memberModel->find($id);

        if (!$member) {
            redirect('/members');
            return;
        }

        $this->call->view('member_form', ['member' => $member, 'error' => '', 'success' => '']);
    }

    public function update($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $memberModel = $this->call->model('MembersModel');
        $member = $memberModel->find($id);

        if (!$member) {
            redirect('/members');
            return;
        }

        if ($name === '' || $username === '') {
            $this->call->view('member_form', ['member' => $member, 'error' => 'Name and username are required.', 'success' => '']);
            return;
        }

        if ($password !== '' || $confirm_password !== '') {
            if ($password !== $confirm_password) {
                $this->call->view('member_form', ['member' => $member, 'error' => 'Passwords do not match.', 'success' => '']);
                return;
            }
        }

        $data = [
            'name' => $name,
            'username' => $username,
        ];

        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $memberModel->update($id, $data);
        redirect('/members');
    }

    public function delete($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $memberModel = $this->call->model('MembersModel');
        $memberModel->delete($id);
        redirect('/members');
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
