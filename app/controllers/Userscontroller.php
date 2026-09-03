<?php

class UsersController extends Controller
{
    public function index()
    {
        $users_model = $this->call->model('UsersModel');

        $users = $users_model->all();

        $this->call->view('users', ['users' => $users]);
    }
}