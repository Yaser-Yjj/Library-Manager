<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            $this->session->set([
                'userId'     => $user['id'],
                'userName'   => $user['name'],
                'userEmail'  => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('admin/dashboard'))->with('success', 'Welcome back, Admin!');
            }
            return redirect()->to(base_url('books'))->with('success', 'Login successful!');
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'user',
        ];

        if ($this->request->getPost('password') !== $this->request->getPost('password_confirm')) {
            return redirect()->back()->with('error', 'Passwords do not match.')->withInput();
        }

        if ($this->userModel->insert($data)) {
            return redirect()->to(base_url('auth/login'))->with('success', 'Registration successful! Please login.');
        }

        return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('auth/login'))->with('success', 'You have been logged out.');
    }
}

